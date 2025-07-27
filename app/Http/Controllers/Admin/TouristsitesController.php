<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TouristGallery;
use App\Models\Touristsites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TouristsitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $touristSites = Touristsites::orderByDesc('id')->get();

        return view('admin.tourists.index', compact('touristSites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tourists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'ubicacion' => 'required|string|max:255',
        'coordenadas' => 'nullable|string|max:255',
        'horario' => 'nullable|string|max:255',
        'resumen' => 'required|string|min:20',
        'publicado' => 'required|in:0,1',
        'imagen_destacada' => 'nullable|image|dimensions:min_width=450,min_height=350,max_width=450,max_height=350',
    ], [
        'imagen_destacada.dimensions' => 'La imagen debe tener dimensiones exactas de 450px x 350px',
    ]);

    $touristSite = new Touristsites();

    if ($request->hasFile('imagen_destacada')) {
        $touristSite->imagen_destacada = $request->file('imagen_destacada')->store('sitios', 'public');
    }

    $touristSite->titulo = $request->titulo;
    $touristSite->ubicacion = $request->ubicacion;
    $touristSite->coordenadas = $request->coordenadas;
    $touristSite->horario = $request->horario;
    $touristSite->resumen = $request->resumen;
    $touristSite->publicado = $request->publicado;
    $touristSite->user_id = Auth::id();

    $touristSite->save();

    session()->flash('swal', [
        'icon' => 'success',
        'title' => 'Guardado',
        'text' => 'El sitio turístico se creó correctamente.'
    ]);

    return redirect()->route('admin.tourists.index');
}



    /**
     * Display the specified resource.
     */
    public function show(Touristsites $touristsite)
    {
        return response()->json($touristsite);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $touristSite = Touristsites::findOrFail($id);
        return view('admin.tourists.edit', compact('touristSite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Touristsites $touristSite)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'coordenadas' => 'nullable|string|max:255',
            'horario' => 'nullable|string|max:255',
            'resumen' => 'nullable|string',
            'publicado' => 'required|in:0,1',
            'imagen_destacada' => 'nullable|image|max:2048',
        ]);

        // Si se subió nueva imagen destacada
        if ($request->hasFile('imagen_destacada')) {
            if ($touristSite->imagen_destacada && Storage::disk('public')->exists($touristSite->imagen_destacada)) {
                Storage::disk('public')->delete($touristSite->imagen_destacada);
            }

            $touristSite->imagen_destacada = $request->file('imagen_destacada')->store('sitios/destacadas', 'public');
        }

        // Actualizar manualmente cada campo
        $touristSite->titulo = $request->titulo;
        $touristSite->ubicacion = $request->ubicacion;
        $touristSite->coordenadas = $request->coordenadas;
        $touristSite->horario = $request->horario;
        $touristSite->resumen = $request->resumen;
        $touristSite->user_id = Auth::id();
        $touristSite->publicado = $request->publicado;
        // Si quieres guardar usuario que actualizó (opcional)
        // $touristSite->user_id = Auth::id();

        $touristSite->save();

        // Puedes usar sesión para mostrar mensaje tipo SweetAlert
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'El sitio turístico se actualizó correctamente.',
        ]);

        return redirect()->route('admin.tourists.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Touristsites $touristSite)
    {
        // Eliminar imagen destacada si existe
        if ($touristSite->imagen_destacada && Storage::disk('public')->exists($touristSite->imagen_destacada)) {
            Storage::disk('public')->delete($touristSite->imagen_destacada);
        }

        $touristSite->delete();

        return response()->json(['message' => 'Sitio turístico eliminado exitosamente']);
    }
}
