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

  protected $listeners = ['inscribirUsuario', 'inscribirEquipo'];

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
        'footer' => '<a href="/login">Iniciar Sesión</a><a class="ml-4" href="/register">Crear una cuenta</a>',
      ]);
    }


  }

  public function inscribirUsuario($id_categoria) {
    $this->categoria_inscripcion = Categoria::where('id', $id_categoria)->where('id_evento', $this->evento->id)->first();

    if($this->categoria_inscripcion != null and Auth::user() != null and $this->categoria_inscripcion->equipos == 0) {
      Registro::create([
        'id_usuario' => Auth::user()->id,
        'id_evento' => $this->evento->id,
        'id_categoria' => $this->categoria_inscripcion->id,
      ]);

      $this->dispatchBrowserEvent('swal:modal', [
        'title' => '¡Has sido registrado al evento!',
        'text' => '',
        'icon' => 'success',
      ]);
    }

    if($this->categoria_inscripcion != null and Auth::user() != null and $this->categoria_inscripcion->equipos == 1) {
      $this->dispatchBrowserEvent('swal:confirmarEquipo');
    }

    if($this->categoria_inscripcion == null){
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

  public function inscribirEquipo($nombre_equipo){

    if($this->categoria_inscripcion != null and Auth::user() != null and $this->categoria_inscripcion->equipos == 1) {
      Registro::create([
        'id_usuario' => Auth::user()->id,
        'id_evento' => $this->evento->id,
        'id_categoria' => $this->categoria_inscripcion->id,
        'nombre_equipo' => $nombre_equipo,
      ]);

      $this->dispatchBrowserEvent('swal:modal', [
        'title' => '¡Equipo inscrito!',
        'text' => '',
        'icon' => 'success',
      ]);
    }

    if($this->categoria_inscripcion == null){
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
