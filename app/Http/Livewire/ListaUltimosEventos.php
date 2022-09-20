<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;

class ListaUltimosEventos extends Component
{
  public function render()  {
    return view('livewire.lista-ultimos-eventos',[
      'eventos' => Evento::limit(4)->orderBy('id', 'desc')->get()
    ]);
  }
}
