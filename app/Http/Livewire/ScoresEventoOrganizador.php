<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Registro;
use App\Models\User;
use Livewire\Component;

class ScoresEventoOrganizador extends Component
{
  public $evento;
  public $categoria;
  public $busqueda;
  public $registros;
  public $atletas = 0;
  public $equipos = 0;
  public $nombre_registro;
  public $categoria_registro;
  public $tipo_categoria;
  public $wods_categoria;

  // public function mount() {
  //   $usuarios = User::where('name', 'like', '%'.$this->busqueda.'%')->pluck('id')->toArray();
  //   $this->registros = Registro::where('id_evento', $this->evento->id)
  //                             ->whereIn('id_usuario', $usuarios)
  //                             ->orWhere('id_categoria', $this->categoria)
  //                             ->get();
  // }

  protected $listeners = ['buscarCategoria'];

  public function mount() {
    $this->registros = Registro::where('id_evento', $this->evento->id)->get();
    foreach($this->registros as $registro) {
      if($registro->nombre_equipo != null){
        $this->equipos++;
      }else{
        $this->atletas++;
      }
    }
  }

  public function render() {
    return view('livewire.scores-evento-organizador');
  }
  
  public function cerrarModalScores() {
    
    $this->dispatchBrowserEvent('cerrarModalScores');
  }

  public function editarScores($registro) {
    $registro_modificar = Registro::where('id_evento', $this->evento->id)
                                  ->where('id', $registro['id'])
                                  ->first();
    // dd($registro_modificar);
    $this->nombre_registro = ($registro_modificar->nombre_equipo) ?: $registro_modificar->usuario->name;
    $this->categoria_registro = $registro_modificar->categoria->nombre;
    $this->tipo_categoria = ($registro_modificar->categoria->equipos == 0) ? '(Individual)' : '(Equipos)';
    $this->wods_categoria = $registro_modificar->categoria->wods;
    $this->dispatchBrowserEvent('mostrarModalScores');
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
