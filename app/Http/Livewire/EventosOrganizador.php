<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class EventosOrganizador extends Component
{
  public $modal;
  public $nombre, $fecha, $hora, $ciudad, $estado;

  protected array $rules = [];

  protected $listeners = ['eliminar'];

  public function rules () {
    return [
      'nombre' => 'required|string|max:100',
      'fecha' => 'required|date',
      'ciudad' => 'required|max:100',
      'estado' => 'required|max:100',
    ];
  }

  public function render()
  {
    $eventos = Evento::paginate(8);
    return view('livewire.eventos-organizador', compact('eventos'));
  }

  public function eliminar($url){
    $evento = Evento::where('url_evento', $url)->first();
    $evento->delete();
  }

  public function guardar() {
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
    ]);

    $this->limpiarDatos();
    $this->dispatchBrowserEvent('eventoGuardado');
  }

  public function limpiarDatos() {
    $this->nombre = '';
    $this->fecha = '';
    $this->hora = '';
    $this->ciudad = '';
    $this->estado = '';
  }

  public function mostrarModal() {
    $this->modal = true;
  }

  public function cerrarModal() {
    $this->modal = false;
  }
}
