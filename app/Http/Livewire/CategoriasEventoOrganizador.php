<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Wod;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CategoriasEventoOrganizador extends Component
{
  public $evento;
  public $id_categoria, $nombreCategoria, $descripcionCategoria, $editarCategoria = false, $accionCategoria = 'Agregar categoría';
  public $id_wod, $nombreWod, $descripcionWod, $tipoWod, $timeCap = '00:00:00', $categoriaWod, $editarWod = false, $accionWod = 'Agregar wod';

  protected $listeners = ['eliminarCategoria', 'eliminarWod'];

  public function render()  {
    $categorias = Categoria::where('id_evento', $this->evento->id)->get();
    return view('livewire.categorias-evento-organizador', compact('categorias'));
  }

  public function confirmarEliminarWod() {
    $this->dispatchBrowserEvent('swal:confirmarWod', [
      'type' => 'warning',
      'title' => 'Categoría: '.$this->categoriaWod.'<br>Wod: '.$this->nombreWod,
      'text' => '¿Deseas eliminar el wod seleccionado?',
      'icon' => 'warning',
    ]);
  }

  public function eliminarWod() {
    Wod::destroy($this->id_wod);

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Wod eliminado!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->cerrarWodsModal();
  }

  public function editarWod($wod){
    $wod = Wod::findOrFail($wod['id']);
    
    $this->id_wod = $wod->id;
    $this->nombreWod = $wod->nombre;
    $this->descripcionWod = $wod->descripcion;
    $this->tipoWod = $wod->tipo;
    $this->timeCap = $wod->time_cap;
    $this->categoriaWod = $wod->categoria->id;
    $this->editarWod = true;
    $this->accionWod = 'Editar wod';
    $this->dispatchBrowserEvent('mostrarWodsModal');
  }

  public function limpiarDatosWod() {
    $this->id_wod = '';
    $this->nombreWod = '';
    $this->descripcionWod = '';
    $this->tipoWod = '';
    $this->timeCap = '00:00:00';
    $this->categoriaWod = '';
    $this->accionWod = 'Agregar wod';
    $this->editarWod = false;
  }

  public function guardarWod() {
    $wodValidado = Validator::make(
      [
        'nombreWod' => $this->nombreWod,
        'descripcionWod' => $this->descripcionWod,
        'tipoWod' => $this->tipoWod,
        'timeCap' => $this->timeCap,
        'categoriaWod' => $this->categoriaWod,
      ],
      [
        'nombreWod' => 'required|max:50',
        'descripcionWod' => 'max:150',
        'tipoWod' => 'required|string',
        'timeCap' => 'required',
        'categoriaWod' => 'required',
      ]
    )->validate();

    Wod::updateOrCreate(
      [
        'id' => $this->id_wod,
      ],[
        'nombre' => $this->nombreWod,
        'descripcion' => $this->descripcionWod,
        'tipo' => $this->tipoWod,
        'time_cap' => $this->timeCap,
        'id_categoria' => $this->categoriaWod,
      ]
    );

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Wod guardado!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->cerrarWodsModal();
  }

  public function agregarWod() {
    $this->limpiarDatosWod();
    $this->dispatchBrowserEvent('mostrarWodsModal');
  }

  public function cerrarWodsModal() {
    $this->limpiarDatosWod();
    $this->resetErrorBag();
    $this->editarWod = false;
    $this->accionWod = 'Editar wod';
    $this->dispatchBrowserEvent('cerrarWodsModal');
  }

  public function agregarCategoria() {
    $this->limpiarDatosCategoria();
    $this->dispatchBrowserEvent('mostrarCategoriasModal');
  }

  public function editarCategoria($categoria) {
    $this->editarCategoria = true;
    $this->accionCategoria = 'Editar Categoria';
    $this->id_categoria = $categoria['id'];
    $this->nombreCategoria = $categoria['nombre'];
    $this->descripcionCategoria = $categoria['descripcion'];
    $this->dispatchBrowserEvent('mostrarCategoriasModal');
  }

  public function guardarCategoria() {
    $categoriaValidada = Validator::make(
      [
        'nombreCategoria' => $this->nombreCategoria,
        'descripcionCategoria' => $this->descripcionCategoria,
      ],
      [
        'nombreCategoria' => 'required|max:60',
        'descripcionCategoria' => 'max:150',
      ],
    )->validate();

    Categoria::updateOrCreate(
      [
        'id' => $this->id_categoria,
      ],[
        'nombre' => $this->nombreCategoria,
        'descripcion' => $this->descripcionCategoria,
        'id_evento' => $this->evento->id,
      ]
    );

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Categoría guardada!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->cerrarCategoriasModal();
  }

  public function limpiarDatosCategoria() {
    $this->id_categoria = '';
    $this->nombreCategoria = '';
    $this->descripcionCategoria = ''; 
    $this->accionCategoria = 'Agregar wod';
    $this->editarCategoria = false;
  }

  public function confirmarEliminarCategoria() {
    $this->dispatchBrowserEvent('swal:confirmarCategoria', [
      'type' => 'warning',
      'title' => '¿Desas eliminar la categoría?',
      'text' => '',
      'icon' => 'warning',
    ]);
  }

  public function eliminarCategoria() {
    Categoria::destroy($this->id_categoria);

    $this->dispatchBrowserEvent('swal:modal', [
      'type' => 'success',
      'title' => '¡Categoría eliminada!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->cerrarCategoriasModal();
  }

  public function cerrarCategoriasModal() {
    $this->limpiarDatosCategoria();
    $this->resetErrorBag();
    $this->editarCategoria = false;
    $this->accionCategoria = 'Editar categoría';
    $this->dispatchBrowserEvent('cerrarCategoriasModal');
  }
}
