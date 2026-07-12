<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Subcategoria;

class SubcategoriaController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $subcategorias = Subcategoria::with('categoria')
            ->latest()
            ->get();

        return view('admin.subcategorias.index', compact('subcategorias'));
    }

    /**
     * Mostrar formulario
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.subcategorias.create', compact('categorias'));
    }

    /**
     * Guardar subcategoría
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|min:3|max:255',
        ]);

        Subcategoria::create([
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
        ]);

        return redirect()
            ->route('admin.subcategorias.index')
            ->with('success', 'Subcategoría creada correctamente');
    }

    /**
     * Mostrar detalle
     */
    public function show(string $id)
    {
        $subcategoria = Subcategoria::with('categoria')
            ->findOrFail($id);

        return response()->json($subcategoria);
    }

    /**
     * Formulario editar
     */
    public function edit(string $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $categorias = Categoria::all();

        return view(
            'admin.subcategorias.edit',
            compact('subcategoria', 'categorias')
        );
    }

    /**
     * Actualizar subcategoría
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|min:3|max:255',
        ]);

        $subcategoria = Subcategoria::findOrFail($id);

        $subcategoria->update([
            'categoria_id' => $request->categoria_id,
            'nombre' => $request->nombre,
        ]);

        return redirect()
            ->route('admin.subcategorias.index')
            ->with('success', 'Subcategoría actualizada correctamente');
    }

    /**
     * Eliminar subcategoría
     */
    public function destroy(string $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $subcategoria->delete();

        return response()->json([
            'message' => 'Subcategoría eliminada correctamente'
        ]);
    }
}