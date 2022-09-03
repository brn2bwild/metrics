<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Wod;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CategoriasOrganizador extends Component
{
  public $evento;
  public $id_categoria, $nombreCategoria, $descripcionCategoria;
  public $id_wod, $nombreWod, $descripcionWod, $tipoWod, $timeCap, $categoriaWod;

  protected $listeners = ['eliminarCategoria'];

  public function render()  {
    $categorias = Categoria::where('id_evento', $this->evento->id)->get();
    return view('livewire.categorias-organizador', compact('categorias'));
  }

  public function editarCategoria($categoria) {
    $this->id_categoria = $categoria['id'];
    $this->nombreCategoria = $categoria['nombre'];
    $this->descripcionCategoria = $categoria['descripcion']; 
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

    $this->dispatchBrowserEvent('swal:categoriaGuardada');
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
        'timeCap' => 'required|integer|min:0',
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

    $this->dispatchBrowserEvent('swal:wodGuardado');
  }

  public function confirmarEliminarCategoria($id) {
    $this->dispatchBrowserEvent('swal:confirmarEliminarCategoria', [
      'type' => 'warning',
      'title' => '¿Estás seguro de eliminar la categoría?',
      'text' => '',
      'icon' => 'warning',
      'id' => $id,
    ]);
  }

  public function eliminarCategoria($id) {
    Categoria::destroy($id);
  }
}
