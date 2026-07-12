<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $categorias = Categoria::latest()->get();

        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Guardar nueva categoría
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:255',
            'descripcion' => 'nullable|max:500',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('admin.categorias.index')
            ->with('success', 'Categoría creada correctamente');
    }

    /**
     * Mostrar categoría
     */
    public function show(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        return response()->json($categoria);
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar categoría
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:255',
            'descripcion' => 'nullable|max:500',
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('admin.categorias.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Eliminar categoría
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->delete();

        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ]);
    }
}