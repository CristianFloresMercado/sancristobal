<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderByDesc('id')->get();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'resumen' => 'required|string|min:20',
            'publicado' => 'required|in:0,1',
            'titulo' => 'required|string|max:255',
            'autor' => 'nullable|string|max:255',
            'fuente' => 'nullable|string|max:255',
            'imagen' => 'required|image|dimensions:min_width=450,min_height=350,max_width=450,max_height=350',
        ], [
            'imagen.dimensions' => 'La imagen debe tener dimensiones de 450px x 350px',
        ]);
        if ($request->hasFile('imagen')) {
            $img = Storage::put('news', $request->imagen);
        } else {
            $img = null;
        }

        $new = new News();
        $new->titulo = $request->titulo;
        $new->resumen = $request->resumen;
        $new->autor = $request->autor;
        $new->fuente = $request->fuente;
        $new->imagen_destacada = $img;
        $new->publicado = $request->publicado;
        $new->user_id = Auth::id(); // <- Aquí se obtiene el ID del usuario en sesión
        $new->save();


        //Mensaje de alerta 
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '!Bien hecho!',
            'text' => 'La noticia se ha creado correctamente'
        ]);
        //fin de mensaje de alerta
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return response()->json($news);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $news = News::findOrFail($news->id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
{
    $data = $request->validate([
        'resumen' => 'required|string|min:20',
        'publicado' => 'required|in:0,1',
        'titulo' => 'required|string|max:255',
        'autor' => 'nullable|string|max:255',
        'fuente' => 'nullable|string|max:255',
        'imagen' => 'nullable|image|dimensions:min_width=450,min_height=350,max_width=450,max_height=350',
    ], [
        'imagen.dimensions' => 'La imagen debe tener dimensiones de 450px x 350px',
    ]);

    if ($request->hasFile('imagen')) {
        // Borra imagen vieja si existe
        if ($news->imagen_destacada && Storage::disk('public')->exists($news->imagen_destacada)) {
            Storage::disk('public')->delete($news->imagen_destacada);
        }

        // Guarda nueva imagen
        $path = $request->file('imagen')->store('news', 'public');
        $data['imagen_destacada'] = $path;
    }

    $news->update($data);

    // Alerta con SweetAlert
    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Actualizado',
        'text' => 'La noticia se actualizó correctamente.'
    ]);

    return redirect()->route('admin.news.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if ($news->imagen_destacada) {
                Storage::disk('public')->delete($news->imagen_destacada);
            }

            $news->delete();

            return response()->json(['message' => 'Noticia eliminada exitosamente']);
    }
}
