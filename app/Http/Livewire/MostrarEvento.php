<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Registro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MostrarEvento extends Component
{
  public $evento;
  public $fecha_evento, $fecha_creacion;
  public $wods_categoria;
  public $categoria_inscripcion;
  public $registrado = false;

  protected $listeners = ['inscribirUsuario'];

  public function mount() {
    $this->fecha_evento = Carbon::parse($this->evento->fecha_hora)->format('d F Y, h:m a');
    $this->fecha_creacion = Carbon::parse($this->evento->created_at)->diffForHumans();
  }

  public function render() { 
    if (Auth::user() != null) {
      $this->registrado = (Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->first() != null) ? true : false;
    }
    return view('livewire.mostrar-evento', [
      'redes' => json_decode($this->evento->redes_sociales)
    ]);
  }

  public function verCategoria ($id) {
    // dd($categoria);
    $categoria = Categoria::find($id);
    $this->wods_categoria = $categoria->wods;
  }

  public function verificarInscripcion() {
    if(Auth::user() != null) {
      $this->dispatchBrowserEvent('swal:confirmar', [
        'title' => '¿Deseas registrarte al evento?',
        'text' => '',
        'icon' => 'question',
      ]);
    } else {
      $this->dispatchBrowserEvent('swal:modal', [
        'title' => '¿No tienes una cuenta?',
        'text' => 'Para poder registrarte al evento y poder llevar tus estadísticas, iniciar sesión o crear una cuenta.',
        'icon' => 'info',
      ]);
    }


  }

  public function inscribirUsuario($categoria) {
    $categoria_evento = Categoria::where('nombre', $categoria)->where('id_evento', $this->evento->id)->first();

    if($categoria_evento != null and Auth::user() != null) {
      Registro::create([
        'id_usuario' => Auth::user()->id,
        'id_evento' => $this->evento->id,
        'id_categoria' => $categoria_evento->id,
      ]);

      $this->dispatchBrowserEvent('swal:modal', [
        'title' => '¡Has sido registrado al evento!',
        'text' => '',
        'icon' => 'success',
      ]);
    }

    if($categoria_evento == null){
      $this->dispatchBrowserEvent('swal:modal', [
        'title' => '¡Error!',
        'text' => '',
        'icon' => 'error',
      ]);
    }

    if(Auth::user() == null) {
      $this->dispatchBrowserEvent('swal:modal', [
        'title' => '¡Error!',
        'text' => '',
        'icon' => 'error',
      ]);
    }

  }
}
