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

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified'
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');

  Route::get('/eventos', function () {
    return view('eventos-organizador.index');
  })->name('eventos.index');

  Route::get('/eventos/{url}', function ($url) {
    return view('eventos-organizador.editar', [
      'evento' => Evento::where('url_evento', $url)->first()
    ]);
  })->name('eventos.editar');

  Route::get('/eventos/{url}/atletas', function ($url) {
    return view('eventos-organizador.atletas', [
      'evento' => Evento::where('url_evento', $url)->first()
    ]);
  })->name('evento-atletas.index');

});

Route::get('/lista-eventos', function () {
  return view('eventos-lista.index');
})->name('lista-eventos.index');

Route::get('/lista-eventos/{url}', function ($url) {
  return view('eventos-lista.show', [
    'evento' => Evento::where('url_evento', $url)->first()
  ]);
})->name('lista-eventos.show');