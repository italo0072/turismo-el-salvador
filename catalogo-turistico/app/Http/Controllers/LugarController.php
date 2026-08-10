<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;

/**
 * LugarController
 *
 * Capa "Controlador" del patrón MVC: recibe la petición HTTP,
 * pide los datos necesarios al Modelo (Lugar) y selecciona
 * la Vista que se debe renderizar con esos datos.
 */
class LugarController extends Controller
{
    /**
     * GET /  ->  Listado de lugares turísticos (con filtro opcional por categoría).
     */
    public function index(Request $request)
    {
        $categoria = $request->query('categoria');

        $lugares = $categoria
            ? Lugar::porCategoria($categoria)
            : Lugar::todos();

        $categorias = collect(Lugar::todos())
            ->pluck('categoria')
            ->unique()
            ->values();

        return view('lugares.index', compact('lugares', 'categorias', 'categoria'));
    }

    /**
     * GET /lugares/{id}  ->  Detalle de un lugar turístico específico.
     */
    public function show(int $id)
    {
        $lugar = Lugar::buscarPorId($id);

        if (!$lugar) {
            abort(404, 'Lugar turístico no encontrado.');
        }

        return view('lugares.show', compact('lugar'));
    }
}
