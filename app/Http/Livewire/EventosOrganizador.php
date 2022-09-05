<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EventosOrganizador extends Component
{
  use WithFileUploads;

  public $nombre, $fecha, $hora, $ciudad, $estado;
  public $url_imagen, $url_evento, $imagen_evento;

  protected array $rules = [];

  protected $listeners = ['eliminarEvento', 'eliminarImagenEvento'];

  public function rules () {
    return [
      'nombre' => 'required|string|max:100',
      'fecha' => 'required|date',
      'ciudad' => 'required|max:100',
      'estado' => 'required|max:100',
    ];
  }

  public function render() {
    $eventos = Evento::orderBy('id', 'DESC')->paginate(8);
    return view('livewire.eventos-organizador', compact('eventos'));
  }

  public function cerrarModalImagenEvento() {
    $this->dispatchBrowserEvent('cerrarModalImagenEvento');
    $this->limpiarDatosImagen();
  }

  public function limpiarDatosImagen() {
    $this->url_evento = '';
    $this->url_imagen = '';
    $this->resetErrorBag();
  }

  public function eliminarImagenEvento() {
    Storage::delete('public/'.$this->url_imagen);
    Evento::where('url_imagen', $this->url_imagen)->update([
      'url_imagen' => null,
    ]);

    $this->imagen_evento = null;

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Imágen eliminada!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->render();
  }

  public function confirmarEliminarImagenEvento($url_imagen) {
    // $evento = Evento::where('url_imagen', $url);
    $this->url_imagen = $url_imagen;

    $this->dispatchBrowserEvent('swal:confirmarImagen', [
      'type' => 'warning',
      'title' => '¿Desas eliminar la imágen?',
      'text' => '',
      'icon' => 'warning',
    ]);
  }

  public function guardarImagen() {
    Validator::make(
      ['imagen_evento' => $this->imagen_evento],
      ['imagen_evento' => 'required|image|max:1024'],
    )->validate();

    $path = $this->imagen_evento->store('imagenes', 'public');
    $evento = Evento::where('url_evento', $this->url_evento)->first();
    $evento->update([
      'url_imagen' => $path,
    ]);

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Imágen guardada!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->cerrarModalImagenEvento();
  }

  public function cargarImagenEvento($url_evento) {
    // $evento = Evento::where('url_imagen', $url)->first();
    $this->url_evento = $url_evento;

    $this->dispatchBrowserEvent('mostrarModalImagenEvento');
  }

  public function confirmarEliminarEvento($url_evento) {
    $this->url_evento = $url_evento;

    $this->dispatchBrowserEvent('swal:confirmarEvento', [
      'type' => 'warning',
      'title' => '¿Desas eliminar el evento?',
      'text' => '',
      'icon' => 'warning',
    ]);
  }

  public function eliminarEvento(){
    $evento = Evento::where('url_evento', $this->url_evento)->first();
    if($evento->url_evento) {
      Storage::delete('public/'.$evento->url_imagen);
    }
    $evento->delete();
  }

  public function guardarEvento() {
    $this->validate();

    $valorAleatorio = uniqid();

    $url = Str::of($this->nombre)->slug("-")->limit(200 - mb_strlen($valorAleatorio) - 1, "")->trim("-")->append("-", $valorAleatorio);

    $fecha_hora = Carbon::create($this->fecha.' 00:00:00');

    Evento::updateOrCreate([
      'url_evento' => $url,
    ],[
      'nombre' => $this->nombre,
      'fecha_hora' => $fecha_hora,
      'ciudad' => $this->ciudad,
      'estado' => $this->estado,
      'id_usuario' => Auth::user()->id,
    ]);

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Evento guardado!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->cerrarModalEvento();
  }

  public function limpiarDatosEvento() {
    $this->nombre = '';
    $this->fecha = '';
    $this->hora = '';
    $this->ciudad = '';
    $this->estado = '';
  }

  public function mostrarModalEvento() {
    $this->limpiarDatosEvento();
    $this->dispatchBrowserEvent('mostrarModalEvento');
  }

  public function cerrarModalEvento() {
    $this->dispatchBrowserEvent('cerrarModalEvento');
  }
}
