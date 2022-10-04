<?php

namespace App\Http\Livewire;

use App\Models\Registro;
use App\Models\User;
use Livewire\Component;

class ScoresEventoOrganizador extends Component
{
  public $evento;
  public $categoria;
  public $busqueda;
  public $registros;

  // public function mount() {
  //   $usuarios = User::where('name', 'like', '%'.$this->busqueda.'%')->pluck('id')->toArray();
  //   $this->registros = Registro::where('id_evento', $this->evento->id)
  //                             ->whereIn('id_usuario', $usuarios)
  //                             ->orWhere('id_categoria', $this->categoria)
  //                             ->get();
  // }

  protected $listeners = ['buscarCategoria'];

  public function mount() {
    $this->registros = Registro::all();
  }

  public function render() {
    return view('livewire.scores-evento-organizador');
  }
  
  public function buscarCategoria() {
    if($this->categoria != ''){
      $this->registros = Registro::where('id_evento', $this->evento->id)
      // ->whereIn('id_usuario', $usuarios)
      ->where('id_categoria', $this->categoria)
      ->get();
      // dd($this->registros);
    }

    if($this->categoria == ''){
      $this->registros = Registro::all();
    }
  }

  public function buscarNombre() {
    $this->categoria = '';
    $usuarios = User::where('name', 'like', '%'.$this->busqueda.'%')->pluck('id')->toArray();
    $this->registros = Registro::where('id_evento', $this->evento->id)
                              ->whereIn('id_usuario', $usuarios)
                              ->orWhere('nombre_equipo', 'like', '%'.$this->busqueda.'%')
                              ->get();
  }
}
