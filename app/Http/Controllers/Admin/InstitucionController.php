<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Institucion;
use Illuminate\Http\Request;
class InstitucionController extends Controller
{
    public function index()
    {
        $instituciones = Institucion::orderBy('orden')->latest()->paginate(15);
        return view('admin.instituciones.index', compact('instituciones'));
    }
    public function create()
    {
        return view('admin.instituciones.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'horario' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'publicado' => 'nullable|boolean',
            'orden' => 'nullable|integer|min:0',
        ]);
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('instituciones', 'public');
        }
        $validated['publicado'] = $request->boolean('publicado');
        Institucion::create($validated);
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Creada!', 'text' => 'Institución registrada correctamente.']);
        return redirect()->route('admin.instituciones.index');
    }
    public function edit(Institucion $institucion)
    {
        return view('admin.instituciones.edit', compact('institucion'));
    }
    public function update(Request $request, Institucion $institucion)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'horario' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'publicado' => 'nullable|boolean',
            'orden' => 'nullable|integer|min:0',
        ]);
        if ($request->hasFile('imagen')) {
            if ($institucion->imagen && \Storage::disk('public')->exists($institucion->imagen)) {
                \Storage::disk('public')->delete($institucion->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('instituciones', 'public');
        }
        $validated['publicado'] = $request->boolean('publicado');
        $institucion->update($validated);
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Actualizada!', 'text' => 'Institución actualizada correctamente.']);
        return redirect()->route('admin.instituciones.index');
    }
    public function destroy(Institucion $institucion)
    {
        if ($institucion->imagen && \Storage::disk('public')->exists($institucion->imagen)) {
            \Storage::disk('public')->delete($institucion->imagen);
        }
        $institucion->delete();
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Eliminada!', 'text' => 'Institución eliminada.']);
        return redirect()->route('admin.instituciones.index');
    }
}
