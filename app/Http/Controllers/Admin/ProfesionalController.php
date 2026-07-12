<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profesional;
use Illuminate\Http\Request;
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
                  ->orWhere('sub_especialidad', 'like', "%{$buscar}%");
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
        return view('admin.profesionales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'sub_especialidad' => 'nullable|string|max:255',
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

        Profesional::create($validated);

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
        return view('admin.profesionales.edit', compact('profesional'));
    }

    public function update(Request $request, Profesional $profesional)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'sub_especialidad' => 'nullable|string|max:255',
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

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado!',
            'text' => 'Los datos del profesional fueron actualizados.',
        ]);

        return redirect()->route('admin.profesionales.index');
    }

    public function destroy(Profesional $profesional)
    {
        if ($profesional->foto && \Storage::disk('public')->exists($profesional->foto)) {
            \Storage::disk('public')->delete($profesional->foto);
        }
        if ($profesional->curriculum && \Storage::disk('public')->exists($profesional->curriculum)) {
            \Storage::disk('public')->delete($profesional->curriculum);
        }

        $profesional->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Eliminado!',
            'text' => 'El profesional fue eliminado del registro.',
        ]);

        return redirect()->route('admin.profesionales.index');
    }
}
