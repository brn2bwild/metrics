<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Registro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EventoParticipacion extends Component
{
  public $evento;
  public $registro;
  public $fecha, $hora;
  public $instagram, $facebook, $url_pagina, $whatsapp;
  public $categoria;

  public function mount() {
    $this->fecha = Carbon::create($this->evento->fecha_hora)->toDateString();
    $this->hora = Carbon::create($this->evento->fecha_hora)->toTimeString();
    $array_redes = json_decode($this->evento->redes_sociales);
    $this->facebook = ($array_redes->facebook) ?? '';
    $this->instagram = ($array_redes->instagram) ?? '';
    $this->whatsapp = ($array_redes->whatsapp) ?? '';
    $this->url_pagina = $this->evento->url_pagina;
    $this->registro = Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->first();
    $this->categoria = $this->registro->categoria->nombre;
  }

  public function render() {
    $this->registro = Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->first();
    return view('livewire.evento-participacion');
  }

  public function guardarCategoria() {
    Validator::make(
      ['categoria' => $this->categoria],
      ['categoria' => 'required|exists:categorias,nombre'],
      [
        'categoria.required' => 'Debes seleecionar una categoría',
        'categoria.exists' => 'La categoría que seleccionaste no existe'
      ]
    )->validate();

    Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->update([
      'id_categoria' => Categoria::where('nombre', $this->categoria)->first()->id
    ]);

    $this->dispatchBrowserEvent('cerrarCategoriasModal');

    $this->dispatchBrowserEvent('swal:modal', [
      'title' => '¡Categoria actualizada!',
      'text' => '',
      'icon' => 'success',
    ]);
  }
}
