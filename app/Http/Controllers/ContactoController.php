<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\SolicitudContacto;
use Illuminate\Http\Request;

/**
 * ContactoController
 *
 * Gestiona el formulario de contacto asociado a un lugar turístico:
 * muestra el formulario (create) y procesa/valida/guarda el envío (store).
 */
class ContactoController extends Controller
{
    /**
     * GET /contacto/{id}  ->  Muestra el formulario de contacto para un lugar.
     */
    public function create(int $id)
    {
        $lugar = Lugar::buscarPorId($id);

        if (!$lugar) {
            abort(404, 'Lugar turístico no encontrado.');
        }

        return view('contacto.create', compact('lugar'));
    }

    /**
     * POST /contacto/{id}  ->  Valida y guarda la solicitud de contacto.
     */
    public function store(Request $request, int $id)
    {
        $lugar = Lugar::buscarPorId($id);

        if (!$lugar) {
            abort(404, 'Lugar turístico no encontrado.');
        }

        $datosValidados = $request->validate([
            'nombre'   => 'required|string|max:100',
            'correo'   => 'required|email|max:150',
            'telefono' => 'nullable|string|max:20',
            'mensaje'  => 'required|string|max:1000',
        ]);

        $datosValidados['lugar_id'] = $lugar['id'];
        $datosValidados['lugar_titulo'] = $lugar['titulo'];

        SolicitudContacto::guardar($datosValidados);

        return redirect()
            ->route('lugares.show', $id)
            ->with('exito', 'Tu solicitud fue enviada correctamente. Nos pondremos en contacto contigo pronto.');
    }
}
