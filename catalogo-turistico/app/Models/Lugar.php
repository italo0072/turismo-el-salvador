<?php

namespace App\Models;

/**
 * Modelo Lugar
 *
 * En este proyecto no se utiliza una base de datos relacional ni Eloquent:
 * la "fuente de datos" es un archivo JSON (storage/app/data/lugares.json).
 * Este modelo se encarga de leer, interpretar y filtrar esos datos,
 * exponiendo un pequeño API interno para que los controladores no tengan
 * que preocuparse por el formato del archivo.
 */
class Lugar
{
    protected static string $rutaJson = 'data/lugares.json';

    /**
     * Devuelve todos los lugares turísticos registrados en el JSON.
     */
    public static function todos(): array
    {
        $ruta = storage_path('app/' . self::$rutaJson);

        if (!file_exists($ruta)) {
            return [];
        }

        $contenido = file_get_contents($ruta);
        $datos = json_decode($contenido, true);

        return $datos['lugares'] ?? [];
    }

    /**
     * Busca un lugar específico por su id.
     */
    public static function buscarPorId(int $id): ?array
    {
        foreach (self::todos() as $lugar) {
            if ((int) $lugar['id'] === $id) {
                return $lugar;
            }
        }

        return null;
    }

    /**
     * Filtra los lugares por categoría (Naturaleza, Playa, Cultura, Arqueología, etc.).
     */
    public static function porCategoria(string $categoria): array
    {
        return array_values(array_filter(
            self::todos(),
            fn ($lugar) => strtolower($lugar['categoria']) === strtolower($categoria)
        ));
    }
}
