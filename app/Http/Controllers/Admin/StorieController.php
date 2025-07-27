<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stories = Stories::orderByDesc('id')->get();

        return view('admin.stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'año_ocurrido' => 'nullable|integer|min:1500|max:' . date('Y'),
            'personajes' => 'nullable|string|max:255',
            'resumen' => 'required|string|min:20',
            'publicado' => 'required|in:0,1',
            'imagen_destacada' => 'required|image|dimensions:min_width=450,min_height=350,max_width=450,max_height=350',
        ], [
            'imagen_destacada.dimensions' => 'La imagen debe tener dimensiones exactas de 450px x 350px',
        ]);

        // Guardar la imagen
        if ($request->hasFile('imagen_destacada')) {
            $img = $request->file('imagen_destacada')->store('historias', 'public');
        } else {
            $img = null;
        }

        // Crear la historia
        $story = new Stories();
        $story->titulo = $request->titulo;
        $story->año_ocurrido = $request->año_ocurrido;
        $story->personajes = $request->personajes;
        $story->resumen = $request->resumen;
        $story->publicado = $request->publicado;
        $story->imagen_destacada = $img;
        $story->user_id = Auth::id();
        $story->save();

        // Alerta con SweetAlert
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La historia se ha creado correctamente.'
        ]);

        return redirect()->route('admin.stories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stories $story)
    {
         return response()->json($story);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $story = Stories::findOrFail($id);
        return view('admin.stories.edit', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stories $story)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'año_ocurrido' => 'nullable|integer|min:1500|max:' . date('Y'),
            'personajes' => 'nullable|string|max:255',
            'resumen' => 'required|string|min:20',
            'publicado' => 'required|in:0,1',
            'imagen_destacada' => 'nullable|image|dimensions:min_width=450,min_height=350,max_width=450,max_height=350',
        ], [
            'imagen_destacada.dimensions' => 'La imagen debe tener dimensiones exactas de 450px x 350px',
        ]);

        // Si se subió una nueva imagen
        if ($request->hasFile('imagen_destacada')) {
            // Eliminar la imagen anterior si existe
            if ($story->imagen_destacada && Storage::disk('public')->exists($story->imagen_destacada)) {
                Storage::disk('public')->delete($story->imagen_destacada);
            }

            // Guardar la nueva imagen
            $story->imagen_destacada = $request->file('imagen_destacada')->store('historias', 'public');
        }

        // Actualizar los demás campos
        $story->titulo = $request->titulo;
        $story->año_ocurrido = $request->año_ocurrido;
        $story->personajes = $request->personajes;
        $story->resumen = $request->resumen;
        $story->publicado = $request->publicado;
        $story->user_id = Auth::id(); // por si quieres actualizar el usuario que lo modificó
        $story->save();

        // Alerta con SweetAlert
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'La historia se actualizó correctamente.'
        ]);

        return redirect()->route('admin.stories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stories $story)
    {
        if ($story->imagen_destacada) {
            Storage::disk('public')->delete($story->imagen_destacada);
        }

        $story->delete();

            return response()->json(['message' => 'Noticia eliminada exitosamente']);
    }
}
