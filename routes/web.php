<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\LugarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Web - Catálogo Turístico de El Salvador
|--------------------------------------------------------------------------
|
| Cada ruta mapea un verbo HTTP + URI a un método de un Controlador.
| Esta es la primera capa que recibe la petición dentro del ciclo de
| vida de una request en Laravel.
|
*/

Route::get('/', [LugarController::class, 'index'])->name('lugares.index');
Route::get('/lugares/{id}', [LugarController::class, 'show'])->name('lugares.show');

Route::get('/contacto/{id}', [ContactoController::class, 'create'])->name('contacto.create');
Route::post('/contacto/{id}', [ContactoController::class, 'store'])->name('contacto.store');
