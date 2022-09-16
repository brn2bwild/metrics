<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Livewire\Component;

class ListaEventos extends Component
{
  public $busqueda;

  public function render() {
    $buscar = '%'.$this->busqueda.'%';
    return view('livewire.lista-eventos',[
      'eventos' => Evento::where('nombre', 'like', $buscar)
                          ->orderBy('id', 'DESC')
                          ->get()
    ]);
  }
}
