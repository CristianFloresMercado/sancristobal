<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tourist;
use App\Models\TurismoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TouristController extends Controller
{
    public function index()
    {
        $touristSites = Tourist::orderByDesc('id')->get();

        return view('admin.tourists.index', compact('touristSites'));
    }

    public function create()
    {
        return view('admin.tourists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'horario' => 'nullable|string|max:255',
            'resumen' => 'required|string|min:20',
            'publicado' => 'required|in:0,1',
            'imagen' => 'required|image|dimensions:min_width=450,min_height=350',
            'imagenes.*' => 'nullable|image|max:4096',
        ], [
            'imagen.dimensions' => 'La imagen debe tener dimensiones minimas de 450px x 350px',
        ]);

        $img = null;
        if ($request->hasFile('imagen')) {
            $img = $request->file('imagen')->store('sitios', 'public');
        }

        $tourist = Tourist::create([
            'titulo' => $request->titulo,
            'ubicacion' => $request->ubicacion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'horario' => $request->horario,
            'resumen' => $request->resumen,
            'publicado' => $request->publicado,
            'imagen_destacada' => $img,
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('imagenes')) {
            $orden = 0;
            foreach ($request->file('imagenes') as $imagen) {
                if ($orden >= 4) break;
                $path = $imagen->store('sitios/galeria', 'public');
                TurismoImagen::create([
                    'tourist_id' => $tourist->id,
                    'imagen' => $path,
                    'orden' => $orden,
                ]);
                $orden++;
            }
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Guardado',
            'text' => 'El sitio turístico se creó correctamente.'
        ]);

        return redirect()->route('admin.tourists.index');
    }

    public function show(Tourist $tourist)
    {
        return response()->json($tourist->load('imagenes'));
    }

    public function edit(Tourist $tourist)
    {
        $tourist = Tourist::with('imagenes')->findOrFail($tourist->id);
        return view('admin.tourists.edit', compact('tourist'));
    }

    public function update(Request $request, Tourist $tourist)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'horario' => 'nullable|string|max:255',
            'resumen' => 'nullable|string',
            'publicado' => 'required|in:0,1',
            'imagen' => 'nullable|image|dimensions:min_width=450,min_height=350',
            'imagenes.*' => 'nullable|image|max:4096',
        ], [
            'imagen.dimensions' => 'La imagen debe tener dimensiones minimas de 450px x 350px',
        ]);

        if ($request->hasFile('imagen')) {
            if ($tourist->imagen_destacada && Storage::disk('public')->exists($tourist->imagen_destacada)) {
                Storage::disk('public')->delete($tourist->imagen_destacada);
            }
            $data['imagen_destacada'] = $request->file('imagen')->store('sitios', 'public');
        }

        $data['user_id'] = Auth::id();
        $tourist->update($data);

        if ($request->hasFile('imagenes')) {
            $orden = $tourist->imagenes()->count();
            foreach ($request->file('imagenes') as $imagen) {
                if ($orden >= 4) break;
                $path = $imagen->store('sitios/galeria', 'public');
                TurismoImagen::create([
                    'tourist_id' => $tourist->id,
                    'imagen' => $path,
                    'orden' => $orden,
                ]);
                $orden++;
            }
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'El sitio turístico se actualizó correctamente.',
        ]);

        return redirect()->route('admin.tourists.index');
    }

    public function destroy(Tourist $tourist)
    {
        foreach ($tourist->imagenes as $imagen) {
            if (Storage::disk('public')->exists($imagen->imagen)) {
                Storage::disk('public')->delete($imagen->imagen);
            }
        }

        if ($tourist->imagen_destacada && Storage::disk('public')->exists($tourist->imagen_destacada)) {
            Storage::disk('public')->delete($tourist->imagen_destacada);
        }

        $tourist->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Eliminado!',
            'text' => 'El sitio turístico fue eliminado.'
        ]);

        return redirect()->back();
    }

    public function destroyImagen(TurismoImagen $imagen)
    {
        if (Storage::disk('public')->exists($imagen->imagen)) {
            Storage::disk('public')->delete($imagen->imagen);
        }
        $imagen->delete();

        return response()->json(['message' => 'Imagen eliminada']);
    }
}
