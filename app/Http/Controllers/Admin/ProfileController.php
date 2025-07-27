<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_comunidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'alcalde' => 'nullable|string|max:255',
            'telefono_municipal' => 'nullable|string|max:20',
            'direccion_municipal' => 'nullable|string|max:255',
            'hospital_principal' => 'nullable|string|max:255',
            'direccion_hospital' => 'nullable|string|max:255',
            'telefono_hospital' => 'nullable|string|max:20',
            'telefono_bomberos' => 'nullable|string|max:20',
            'telefono_policia' => 'nullable|string|max:20',
            'telefono_emergencia' => 'nullable|string|max:20',
            'horarios_atencion' => 'nullable|string',
            'enlaces_utiles' => 'nullable|string',
        ]);

        $profile = Profile::findOrFail($id);

        $profile->update([
            'nombre_comunidad' => $request->nombre_comunidad,
            'descripcion' => $request->descripcion,
            'alcalde' => $request->alcalde,
            'telefono_municipal' => $request->telefono_municipal,
            'direccion_municipal' => $request->direccion_municipal,
            'hospital_principal' => $request->hospital_principal,
            'direccion_hospital' => $request->direccion_hospital,
            'telefono_hospital' => $request->telefono_hospital,
            'telefono_bomberos' => $request->telefono_bomberos,
            'telefono_policia' => $request->telefono_policia,
            'telefono_emergencia' => $request->telefono_emergencia,
            'horarios_atencion' => $request->horarios_atencion,
            'enlaces_utiles' => $request->enlaces_utiles,
        ]);

        // Alerta SweetAlert vía sesión
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Actualizado!',
            'text' => 'El perfil de la comunidad fue actualizado correctamente.'
        ]);

        return redirect()->route('dashboard');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
