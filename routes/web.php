<?php

use App\Http\Controllers\ListaEventosController;
use App\Models\Evento;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador|organizador|usuario']);

Route::get('/usuarios', function() { return view('usuarios.index'); })->name('usuarios.index')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador']);

Route::get('/eventos', function () { return view('eventos-organizador.index'); })->name('eventos.index')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador|organizador']);

Route::get('/eventos/{url}', function ($url) {
  return view('eventos-organizador.editar', [
    'evento' => Evento::where('url_evento', $url)->first()
  ]);
})->name('eventos.editar')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador|organizador']);

Route::get('/eventos/{url}/atletas', function ($url) {
  return view('eventos-organizador.atletas', [
    'evento' => Evento::where('url_evento', $url)->first()
  ]);
})->name('evento-atletas.index')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador|organizador']);

Route::get('/participaciones', function () { return view('eventos-atleta.index'); })->name('participaciones.index')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador|organizador|usuario']);

Route::get('/participaciones/{url}', function($url) {
  return view('eventos-atleta.mostrar', [
    'evento' => Evento::where('url_evento', $url)->first()
  ]);
})->name('participaciones.mostrar')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador|organizador|usuario']);
// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {});

Route::get('/scores/{evento}', function($url) {
  return view('scores-organizador.editar', [
    'evento' => Evento::where('url_evento', $url)->first()
  ]);
})->name('scores.editar')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:administrador|organizador']);

Route::get('/lista-eventos', function () {
  return view('eventos-lista.index');
})->name('lista-eventos.index');

Route::get('/lista-eventos/{url}', function ($url) {
  return view('eventos-lista.mostrar', [
    'evento' => Evento::where('url_evento', $url)->first()
  ]);
})->name('lista-eventos.show');