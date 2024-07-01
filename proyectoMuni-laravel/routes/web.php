<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PrincipalController::class, 'index']);

Route::get('/autoridades', [PrincipalController::class, 'autoridades']);
Route::get('/tipo-autoridad/{slug}', [PrincipalController::class, 'tipoAutoridad']);
Route::get('/autoridad/{slug}', [PrincipalController::class, 'autoridad']);

Route::get('/direcciones', [PrincipalController::class, 'direcciones']);
Route::get('/direccion/{slug}', [PrincipalController::class, 'direccion']);

Route::get('/tramites/{slug}', [PrincipalController::class, 'tramite']);

Route::get('/concejales', [PrincipalController::class, 'concejales']);
Route::get('/concejales/{slug}', [PrincipalController::class, 'concejal']);

Route::get('/paginas/{slug}', [PrincipalController::class, 'paginas']);
Route::get('/personajesHistoricos', [PrincipalController::class, 'listadoPersonajes']);
Route::get('/personajesHistoricos/{slug}', [PrincipalController::class, 'personaje']);

Route::get('/categoriasEmprendedores', [PrincipalController::class, 'categoriasEmprendedores']);
Route::get('/emprendedores/{slug}', [PrincipalController::class, 'listadoEmprendimientos']);
Route::get('/nuevoEmprendimiento', [PrincipalController::class, 'nuevoEmprendimiento']);
Route::get('/emprendimiento', [PrincipalController::class, 'emprendimiento']);
Route::get('/productos', [PrincipalController::class, 'productos']);

Route::get('/categoriasComplejos', [PrincipalController::class, 'categoriasComplejos']);
Route::get('/complejos/{slug}', [PrincipalController::class, 'listaComplejos']);
Route::get('/complejo/{slug}', [PrincipalController::class, 'complejo']);


Route::post('/store_alerta', [PrincipalController::class, 'store_alerta'])->name('store_alert');

Route::post('/store_newlister', [PrincipalController::class, 'store_newlister'])->name('store_newlister');

Route::get('/noticias/{slug?}', [PrincipalController::class, 'noticias']);




Route::get('/nuevoEmprendedor/getCategorias', [PrincipalController::class, 'getCategoriasEmprendimientos']);
Route::get('/validate/existRut/{rut}', [PrincipalController::class, 'getExistRut']);

Route::post('/store_emprende', [PrincipalController::class, 'store_emprende'])->name('store_emprende');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

