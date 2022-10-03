<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Registro;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EventoParticipacion extends Component
{
  public $evento;
  public $registro;
  public $fecha, $hora;
  public $instagram, $facebook, $url_pagina, $whatsapp;
  public $id_categoria, $categoria_inscripcion;

  protected $listeners = ['eliminarParticipacion', 'inscribirEquipo'];

  public function mount() {
    $this->fecha = Carbon::create($this->evento->fecha_hora)->toDateString();
    $this->hora = Carbon::create($this->evento->fecha_hora)->toTimeString();
    $array_redes = json_decode($this->evento->redes_sociales);
    $this->facebook = ($array_redes->facebook) ?? '';
    $this->instagram = ($array_redes->instagram) ?? '';
    $this->whatsapp = ($array_redes->whatsapp) ?? '';
    $this->url_pagina = $this->evento->url_pagina;
    $this->registro = Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->first();
    if ($this->registro == null) { 
      return to_route('participaciones.index');
    }
    $this->id_categoria = $this->registro->categoria->id;
  }

  public function render() {
    $this->registro = Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->first();
    return view('livewire.evento-participacion');
  }

  public function limpiarDatos() {
    $this->id_categoria = $this->registro->categoria->id;
  }

  public function guardarCategoria() {
    Validator::make(
      ['categoria' => $this->id_categoria],
      ['categoria' => 'required|exists:categorias,id'],
      [
        'categoria.required' => 'Debes seleecionar una categoría',
        'categoria.exists' => 'La categoría que seleccionaste no existe'
      ]
    )->validate();

    $this->categoria_inscripcion = Categoria::find($this->id_categoria);
    
    switch (Categoria::find($this->id_categoria)->equipos) {
      case 0:
        Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->update([
          // 'id_categoria' => Categoria::where('nombre', $this->categoria)->first()->id
          'id_categoria' => $this->id_categoria,
          'nombre_equipo' => null,
        ]);

        $this->dispatchBrowserEvent('cerrarCategoriasModal');

        $this->dispatchBrowserEvent('swal:modal', [
          'title' => '¡Categoria actualizada!',
          'text' => '',
          'icon' => 'success',
        ]);
        break;
      case 1:
        $this->dispatchBrowserEvent('cerrarCategoriasModal');

        $this->dispatchBrowserEvent('swal:confirmarEquipo');
        break;
    }  
  }

  public function inscribirEquipo($nombre_equipo){
    if($this->categoria_inscripcion != null and Auth::user() != null and $this->categoria_inscripcion->equipos == 1) {
      $registro = Registro::where([
        ['id_usuario', Auth::user()->id],
        ['id_evento', $this->evento->id]
      ])->first();

      $registro->update([
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

  public function confirmarEliminar() {
    $this->dispatchBrowserEvent('swal:confirmarEliminar',[
      'title' => '¿Deseas eliminar tu participación del evento?',
      'text' => '',
      'icon' => 'question',
    ]);
  }

  public function eliminarParticipacion() {
    Registro::where('id_usuario', Auth::user()->id)->where('id_evento', $this->evento->id)->delete();

    $this->dispatchBrowserEvent('swal:modal', [
      'title' => '¡Participación eliminada!',
      'text' => '',
      'icon' => 'success',
    ]);

    return to_route('participaciones.index');
  }
}
