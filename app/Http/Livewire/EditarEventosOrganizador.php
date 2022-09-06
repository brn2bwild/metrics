<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarEventosOrganizador extends Component
{
  use WithFileUploads;
  
  public $evento;
  public $nombre, $fecha, $hora, $ciudad, $estado, $direccion, $comentarios, $facebook, $instagram, $url_pagina, $imagen;
  
  protected $listeners = ['eliminarImg'];

  protected array $rules = [];

  public function rules() {
    return [
      'nombre' => 'required|string|max:100',
      'fecha' => 'required|date',
      'ciudad' => 'required|max:100',
      'estado' => 'required|max:100',
      'direccion' => 'max:100',
      'comentarios' => 'max:200',
      'facebook' => 'max:150',
      'instagram' => 'max:150',
      'whatsapp' => 'max:150',
      'url_pagina' => 'max:100',
    ];
  }
  public function mount () {
    $this->nombre = $this->evento->nombre;
    $this->fecha = Carbon::create($this->evento->fecha_hora)->toDateString();
    $this->hora = Carbon::create($this->evento->fecha_hora)->toTimeString();
    $this->ciudad = $this->evento->ciudad;
    $this->estado = $this->evento->estado;
    $this->direccion = $this->evento->direccion;
    $this->comentarios = $this->evento->comentarios;
    $array_redes = json_decode($this->evento->redes_sociales);
    $this->facebook = ($array_redes->facebook) ?? '';
    $this->instagram = ($array_redes->instagram) ?? '';
    $this->whatsapp = ($array_redes->whatsapp) ?? '';
    $this->url_pagina = $this->evento->url_pagina;
  }

  public function render() {
    return view('livewire.editar-eventos-organizador');
  }

    public function guardar() {
    $this->validate();

    $fecha_hora = Carbon::create($this->fecha.' '.$this->hora);
    $array_redes = ['facebook' => $this->facebook, 'instagram' => $this->instagram, 'whatsapp' => $this->whatsapp];
    $redes_sociales = json_encode($array_redes);

    Evento::updateOrCreate([
      'id' => $this->evento->id,
    ],[
      'nombre' => $this->nombre,
      'fecha_hora' => $fecha_hora,
      'ciudad' => $this->ciudad,
      'estado' => $this->estado,
      'direccion' => $this->direccion,
      'comentarios' => $this->comentarios,
      'redes_sociales' => $redes_sociales,
      'url_pagina' => $this->url_pagina,
    ]);

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Información guardada!',
      'text' => '',
      'icon' => 'success',
    ]);
  }
}
