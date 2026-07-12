<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Negocio;
use App\Models\NegocioImagen;

class NegocioController extends Controller
{
    public function index()
    {
        $negocios = Negocio::with(['categoria', 'subcategoria'])
            ->latest()
            ->get();

        return view('admin.negocios.index', compact('negocios'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        return view('admin.negocios.create', compact('categorias', 'subcategorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'nullable|exists:subcategorias,id',
            'nombre' => 'required|min:3|max:255',
            'descripcion' => 'nullable',
            'logo' => 'nullable|image|max:2048',
            'foto_principal' => 'nullable|image|max:4096',
            'imagenes.*' => 'nullable|image|max:4096',
            'direccion' => 'nullable|max:255',
            'latitud' => 'nullable',
            'longitud' => 'nullable',
            'telefono' => 'nullable|max:50',
            'whatsapp' => 'nullable|max:50',
            'correo' => 'nullable|email|max:255',
            'sitio_web' => 'nullable|max:255',
            'facebook' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'tiktok' => 'nullable|max:255',
            'horario' => 'nullable|max:255',
            'plan' => 'required|in:none,mensual,anual',
            'publicado' => 'nullable',
        ]);

        $logo = null;
        $fotoPrincipal = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('negocios/logos', 'public');
        }

        if ($request->hasFile('foto_principal')) {
            $fotoPrincipal = $request->file('foto_principal')->store('negocios/principal', 'public');
        }

        $negocio = Negocio::create([
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'descripcion' => $request->descripcion,
            'logo' => $logo,
            'foto_principal' => $fotoPrincipal,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,
            'correo' => $request->correo,
            'sitio_web' => $request->sitio_web,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'horario' => $request->horario,
            'plan' => $request->plan,
            'plan_estado' => 'inactivo',
            'publicado' => $request->has('publicado'),
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('negocios/galeria', 'public');
                NegocioImagen::create([
                    'negocio_id' => $negocio->id,
                    'imagen' => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.negocios.index')
            ->with('success', 'Negocio creado correctamente');
    }

    public function show(string $id)
    {
        $negocio = Negocio::with(['categoria', 'subcategoria'])->findOrFail($id);
        return response()->json($negocio);
    }

    public function edit(string $id)
    {
        $negocio = Negocio::with('imagenes')->findOrFail($id);
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        return view('admin.negocios.edit', compact('negocio', 'categorias', 'subcategorias'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'nullable|exists:subcategorias,id',
            'nombre' => 'required|min:3|max:255',
            'descripcion' => 'nullable',
            'logo' => 'nullable|image|max:2048',
            'foto_principal' => 'nullable|image|max:4096',
            'imagenes.*' => 'nullable|image|max:4096',
            'direccion' => 'nullable|max:255',
            'latitud' => 'nullable',
            'longitud' => 'nullable',
            'telefono' => 'nullable|max:50',
            'whatsapp' => 'nullable|max:50',
            'correo' => 'nullable|email|max:255',
            'sitio_web' => 'nullable|max:255',
            'facebook' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'tiktok' => 'nullable|max:255',
            'horario' => 'nullable|max:255',
            'plan' => 'required|in:none,mensual,anual',
            'publicado' => 'nullable',
        ]);

        $negocio = Negocio::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($negocio->logo && Storage::disk('public')->exists($negocio->logo)) {
                Storage::disk('public')->delete($negocio->logo);
            }
            $negocio->logo = $request->file('logo')->store('negocios/logos', 'public');
        }

        if ($request->hasFile('foto_principal')) {
            if ($negocio->foto_principal && Storage::disk('public')->exists($negocio->foto_principal)) {
                Storage::disk('public')->delete($negocio->foto_principal);
            }
            $negocio->foto_principal = $request->file('foto_principal')->store('negocios/principal', 'public');
        }

        $negocio->update([
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'descripcion' => $request->descripcion,
            'direccion' => $request->direccion,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'telefono' => $request->telefono,
            'whatsapp' => $request->whatsapp,
            'correo' => $request->correo,
            'sitio_web' => $request->sitio_web,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'horario' => $request->horario,
            'plan' => $request->plan,
            'publicado' => $request->has('publicado'),
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('negocios/galeria', 'public');
                NegocioImagen::create([
                    'negocio_id' => $negocio->id,
                    'imagen' => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.negocios.index')
            ->with('success', 'Negocio actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $negocio = Negocio::with('imagenes')->findOrFail($id);

        foreach ($negocio->imagenes as $imagen) {
            if (Storage::disk('public')->exists($imagen->imagen)) {
                Storage::disk('public')->delete($imagen->imagen);
            }
            $imagen->delete();
        }

        if ($negocio->logo && Storage::disk('public')->exists($negocio->logo)) {
            Storage::disk('public')->delete($negocio->logo);
        }
        if ($negocio->foto_principal && Storage::disk('public')->exists($negocio->foto_principal)) {
            Storage::disk('public')->delete($negocio->foto_principal);
        }

        $negocio->delete();

        return response()->json([
            'message' => 'Negocio eliminado correctamente'
        ]);
    }

    public function destroyImagen(NegocioImagen $imagen)
    {
        if (Storage::disk('public')->exists($imagen->imagen)) {
            Storage::disk('public')->delete($imagen->imagen);
        }

        $imagen->delete();

        return response()->json(['message' => 'Imagen eliminada']);
    }
}
