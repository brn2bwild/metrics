<?php

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
    return view('eventos.index');
  })->name('eventos.index');

  Route::get('/eventos/{url}', function ($url) {
    $evento = Evento::where('url_evento', $url)->first();
    return view('eventos.editar', compact('evento'));
  })->name('eventos.editar');

  Route::get('/eventos/{url}/atletas', function ($url) {
    $evento = Evento::where('url_evento', $url)->first();
    return view('eventos.atletas', compact('evento'));
  })->name('evento-atletas.index');
});
