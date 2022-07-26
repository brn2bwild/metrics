<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class CategoriasOrganizador extends Component
{
  public $evento;
  public $id_categoria, $nombre, $descripcion;

  protected $listeners = ['eliminarCategoria'];

  protected array $rules = [];

  public function rules() {
    return [
      'nombre' => 'required|max:100',
      'descripcion' => 'max:100'
    ];
  }

  public function render()  {
    $categorias = Categoria::where('id_evento', $this->evento->id)->get();
    return view('livewire.categorias-organizador', compact('categorias'));
  }

  public function editarCategoria($categoria) {
    $this->id_categoria = $categoria['id'];
    $this->nombre = $categoria['nombre'];
    $this->descripcion = $categoria['descripcion']; 
  }

  public function guardar() {
    $this->validate();

    Categoria::updateOrCreate(
      [
        'id' => $this->id_categoria,
      ],[
        'nombre' => $this->nombre,
        'descripcion' => $this->descripcion,
        'id_evento' => $this->evento->id,
      ]
    );

    $this->dispatchBrowserEvent('swal:categoriaGuardada');
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
