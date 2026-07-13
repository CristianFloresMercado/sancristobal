<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Profesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfesionalController extends Controller
{
    public function index(Request $request)
    {
        $query = Profesional::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('especialidad', 'like', "%{$buscar}%")
                  ->orWhere('sub_especialidad', 'like', "%{$buscar}%")
                  ->orWhere('localidad_nacimiento', 'like', "%{$buscar}%")
                  ->orWhere('residencia_actual', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('disponibilidad')) {
            $query->where('disponibilidad', $request->disponibilidad);
        }

        $profesionales = $query->latest()->paginate(12);

        return view('admin.profesionales.index', compact('profesionales'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.profesionales.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'sub_especialidad' => 'nullable|string|max:255',
            'localidad_nacimiento' => 'nullable|string|max:255',
            'residencia_actual' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'horario' => 'nullable|string|max:255',
            'disponibilidad' => 'required|in:disponible,ocupado',
            'experiencia_anios' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|max:2048',
            'curriculum' => 'nullable|mimes:pdf|max:5120',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'publicado' => 'nullable|boolean',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('profesionales/fotos', 'public');
        }

        if ($request->hasFile('curriculum')) {
            $validated['curriculum'] = $request->file('curriculum')->store('profesionales/cv', 'public');
        }

        $validated['publicado'] = $request->boolean('publicado');

        $profesional = Profesional::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'accion' => 'crear',
            'modelo' => 'Profesional',
            'modelo_id' => $profesional->id,
            'detalle' => 'Registró al profesional: ' . $profesional->nombre,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Creado!',
            'text' => 'El profesional fue registrado correctamente.',
        ]);

        return redirect()->route('admin.profesionales.index');
    }

    public function show(Profesional $profesional)
    {
        return view('admin.profesionales.show', compact('profesional'));
    }

    public function edit(Profesional $profesional)
    {
        $this->authorizeAdmin();
        return view('admin.profesionales.edit', compact('profesional'));
    }

    public function update(Request $request, Profesional $profesional)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'sub_especialidad' => 'nullable|string|max:255',
            'localidad_nacimiento' => 'nullable|string|max:255',
            'residencia_actual' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'horario' => 'nullable|string|max:255',
            'disponibilidad' => 'required|in:disponible,ocupado',
            'experiencia_anios' => 'nullable|integer|min:0',
            'foto' => 'nullable|image|max:2048',
            'curriculum' => 'nullable|mimes:pdf|max:5120',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'publicado' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($profesional->foto && \Storage::disk('public')->exists($profesional->foto)) {
                \Storage::disk('public')->delete($profesional->foto);
            }
            $validated['foto'] = $request->file('foto')->store('profesionales/fotos', 'public');
        }

        if ($request->hasFile('curriculum')) {
            if ($profesional->curriculum && \Storage::disk('public')->exists($profesional->curriculum)) {
                \Storage::disk('public')->delete($profesional->curriculum);
            }
            $validated['curriculum'] = $request->file('curriculum')->store('profesionales/cv', 'public');
        }

        $validated['publicado'] = $request->boolean('publicado');

        $profesional->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'accion' => 'editar',
            'modelo' => 'Profesional',
            'modelo_id' => $profesional->id,
            'detalle' => 'Editó al profesional: ' . $profesional->nombre,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado!',
            'text' => 'Los datos del profesional fueron actualizados.',
        ]);

        return redirect()->route('admin.profesionales.index');
    }

    public function destroy(Profesional $profesional)
    {
        $this->authorizeAdmin();

        if ($profesional->foto && \Storage::disk('public')->exists($profesional->foto)) {
            \Storage::disk('public')->delete($profesional->foto);
        }
        if ($profesional->curriculum && \Storage::disk('public')->exists($profesional->curriculum)) {
            \Storage::disk('public')->delete($profesional->curriculum);
        }

        $nombre = $profesional->nombre;

        $profesional->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'accion' => 'eliminar',
            'modelo' => 'Profesional',
            'modelo_id' => null,
            'detalle' => 'Eliminó al profesional: ' . $nombre,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Eliminado!',
            'text' => 'El profesional fue eliminado del registro.',
        ]);

        return redirect()->route('admin.profesionales.index');
    }

    private function authorizeAdmin()
    {
        if (auth()->user()->isRrhh()) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }
    }
}
