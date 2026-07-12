<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\News;
use App\Models\NoticiaImagen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewController extends Controller
{
    public function index()
    {
        if (auth()->user()->isPeriodista()) {
            $news = News::where('user_id', Auth::id())->orderByDesc('id')->get();
        } else {
            $news = News::orderByDesc('id')->get();
        }

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'resumen' => 'required|string|min:20',
            'publicado' => 'required|in:0,1',
            'titulo' => 'required|string|max:255',
            'autor' => 'nullable|string|max:255',
            'fuente' => 'nullable|string|max:255',
            'video_link' => 'nullable|url|max:255',
            'imagen' => 'required|image|dimensions:min_width=450,min_height=350',
            'imagenes.*' => 'nullable|image|max:4096',
        ], [
            'imagen.dimensions' => 'La imagen debe tener dimensiones minimas de 450px x 350px',
        ]);

        $img = null;
        if ($request->hasFile('imagen')) {
            $img = $request->file('imagen')->store('news', 'public');
        }

        $noticia = News::create([
            'titulo' => $request->titulo,
            'resumen' => $request->resumen,
            'autor' => $request->autor,
            'fuente' => $request->fuente,
            'video_link' => $request->video_link,
            'imagen_destacada' => $img,
            'publicado' => $request->publicado,
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('imagenes')) {
            $orden = 0;
            foreach ($request->file('imagenes') as $imagen) {
                if ($orden >= 9) break;
                $path = $imagen->store('news/galeria', 'public');
                NoticiaImagen::create([
                    'news_id' => $noticia->id,
                    'imagen' => $path,
                    'orden' => $orden,
                ]);
                $orden++;
            }
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '!Bien hecho!',
            'text' => 'La noticia se ha creado correctamente'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'accion' => 'crear',
            'modelo' => 'News',
            'modelo_id' => $noticia->id,
            'detalle' => 'Creó la noticia: ' . $noticia->titulo,
        ]);

        $route = auth()->user()->isPeriodista() ? route('admin.mynews.index') : route('admin.news.index');
        return redirect($route);
    }

    public function show(News $news)
    {
        return response()->json($news->load('imagenes'));
    }

    public function edit(News $news)
    {
        if (auth()->user()->isPeriodista() && $news->user_id !== Auth::id()) {
            abort(403, 'No puedes editar esta noticia.');
        }

        $news = News::with('imagenes')->findOrFail($news->id);
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        if (auth()->user()->isPeriodista() && $news->user_id !== Auth::id()) {
            abort(403, 'No puedes editar esta noticia.');
        }

        $data = $request->validate([
            'resumen' => 'required|string|min:20',
            'publicado' => 'required|in:0,1',
            'titulo' => 'required|string|max:255',
            'autor' => 'nullable|string|max:255',
            'fuente' => 'nullable|string|max:255',
            'video_link' => 'nullable|url|max:255',
            'imagen' => 'nullable|image|dimensions:min_width=450,min_height=350',
            'imagenes.*' => 'nullable|image|max:4096',
        ], [
            'imagen.dimensions' => 'La imagen debe tener dimensiones minimas de 450px x 350px',
        ]);

        if ($request->hasFile('imagen')) {
            if ($news->imagen_destacada && Storage::disk('public')->exists($news->imagen_destacada)) {
                Storage::disk('public')->delete($news->imagen_destacada);
            }
            $data['imagen_destacada'] = $request->file('imagen')->store('news', 'public');
        }

        $data['user_id'] = Auth::id();
        $news->update($data);

        if ($request->hasFile('imagenes')) {
            $orden = $news->imagenes()->count();
            foreach ($request->file('imagenes') as $imagen) {
                if ($orden >= 9) break;
                $path = $imagen->store('news/galeria', 'public');
                NoticiaImagen::create([
                    'news_id' => $news->id,
                    'imagen' => $path,
                    'orden' => $orden,
                ]);
                $orden++;
            }
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'La noticia se actualizó correctamente.'
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'accion' => 'editar',
            'modelo' => 'News',
            'modelo_id' => $news->id,
            'detalle' => 'Editó la noticia: ' . $news->titulo,
        ]);

        $route = auth()->user()->isPeriodista() ? route('admin.mynews.index') : route('admin.news.index');
        return redirect($route);
    }

    public function destroy(News $news)
    {
        if (auth()->user()->isPeriodista() && $news->user_id !== Auth::id()) {
            abort(403, 'No puedes eliminar esta noticia.');
        }

        foreach ($news->imagenes as $imagen) {
            if (Storage::disk('public')->exists($imagen->imagen)) {
                Storage::disk('public')->delete($imagen->imagen);
            }
        }

        if ($news->imagen_destacada && Storage::disk('public')->exists($news->imagen_destacada)) {
            Storage::disk('public')->delete($news->imagen_destacada);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'accion' => 'eliminar',
            'modelo' => 'News',
            'modelo_id' => $news->id,
            'detalle' => 'Eliminó la noticia: ' . $news->titulo,
        ]);

        $news->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Eliminada!',
            'text' => 'La noticia fue eliminada.'
        ]);

        return redirect()->back();
    }

    public function destroyImagen(NoticiaImagen $imagen)
    {
        if (Storage::disk('public')->exists($imagen->imagen)) {
            Storage::disk('public')->delete($imagen->imagen);
        }
        $imagen->delete();

        return response()->json(['message' => 'Imagen eliminada']);
    }
}
