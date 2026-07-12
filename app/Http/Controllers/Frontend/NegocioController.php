<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Negocio;
use App\Models\Categoria;

class NegocioController extends Controller
{
    public function index()
    {
        $negocios = Negocio::with([
            'categoria',
            'subcategoria'
        ])
        ->where('publicado', true)
        ->latest()
        ->get();

        $categorias = Categoria::all();

        return view('negocios', compact(
            'negocios',
            'categorias'
        ));
    }
}