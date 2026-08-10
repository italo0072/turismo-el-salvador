<?php

namespace App\Models;

/**
 * Modelo SolicitudContacto
 *
 * Persiste las solicitudes enviadas desde el formulario de contacto
 * en un archivo JSON (storage/app/data/solicitudes.json), demostrando
 * el flujo de datos de "escritura": Vista -> Controlador -> Modelo -> Archivo.
 */
class SolicitudContacto
{
    protected static string $rutaJson = 'data/solicitudes.json';

    public static function todas(): array
    {
        $ruta = storage_path('app/' . self::$rutaJson);

        if (!file_exists($ruta)) {
            return [];
        }

        $contenido = file_get_contents($ruta);
        $datos = json_decode($contenido, true);

        return $datos['solicitudes'] ?? [];
    }

    public static function guardar(array $datos): void
    {
        $ruta = storage_path('app/' . self::$rutaJson);

        $solicitudes = self::todas();

        $datos['id'] = count($solicitudes) + 1;
        $datos['fecha'] = date('Y-m-d H:i:s');

        $solicitudes[] = $datos;

        file_put_contents(
            $ruta,
            json_encode(['solicitudes' => $solicitudes], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
}
