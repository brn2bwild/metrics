<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Carbon\Carbon;
use Livewire\Component;

class MostrarEvento extends Component
{
  public $evento;
  public $fecha_evento, $fecha_creacion;
  public $wods_categoria;

  public function mount() {
    $this->fecha_evento = Carbon::parse($this->evento->fecha_hora)->format('d F Y, h:m a');
    $this->fecha_creacion = Carbon::parse($this->evento->created_at)->diffForHumans();
  }

  public function render() { 
    return view('livewire.mostrar-evento', [
      'redes' => json_decode($this->evento->redes_sociales)
    ]);
  }

  public function verCategoria ($id) {
    // dd($categoria);
    $categoria = Categoria::find($id);
    $this->wods_categoria = $categoria->wods;
  }
}
