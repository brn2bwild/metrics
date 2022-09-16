<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UsuariosAdministrador extends Component
{
  public $busqueda;
  public $editar = false;
  public $name, $email, $password, $password_confirmation, $rol, $id_usuario;

  protected $listeners = ['eliminarUsuario'];

  public function render() {
    return view('livewire.usuarios-administrador', [
      'usuarios' => User::where('name', 'like', '%'.$this->busqueda.'%')->get(),
      'roles' => Role::all()
    ]);
  }

  public function eliminarUsuario() {
    User::destroy($this->id_usuario);

    $this->dispatchBrowserEvent('swal:modal', [
      'title' => '¡Usuario eliminado',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->limpiarDatos();
  }

  public function confirmarEliminar($id) {
    $this->id_usuario = $id;
    $this->dispatchBrowserEvent('swal:confirmarUsuario',[
      'title' => '¿Deseas eliminar el usuario?',
      'text' => '',
      'icon' => 'question',
    ]);
  }

  public function editarUsuario($id) {
    $this->id_usuario = $id;
    $usuario = User::find($id);
    $this->name = $usuario->name;
    $this->email = $usuario->email;
    $this->rol = $usuario->getRoleNames()[0];
    $this->dispatchBrowserEvent('mostrarModalUsuario');
    $this->editar = true;
  }

  public function guardarUsuarioEditado() {
    Validator::make(
      [
        'name' => $this->name,
        'email' => $this->email,
        'rol' => $this->rol,
      ],
      [
        'name' => 'required|string|max:150',
        'email' => 'email|string|required|max:150|unique:users,email,'.$this->id_usuario,
        'rol' => 'required|exists:roles,name'
      ]
    )->validate();

    $usuario = User::where('id', $this->id_usuario)->first();
    $usuario->update(
      [
      'name' => $this->name,
      'email' => $this->email,
      ]
    );

    $usuario->syncRoles([$this->rol]);

    $this->dispatchBrowserEvent('swal:modal', [
      'title' => '¡Usuario actualizado!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->dispatchBrowserEvent('cerrarModalUsuario');
    
    $this->limpiarDatos();
  }

  public function guardarUsuario() {
    Validator::make(
      [
        'name' => $this->name,
        'email' => $this->email,
        'password' => $this->password,
        'password_confirmation' => $this->password_confirmation,
        'rol' => $this->rol,
      ],
      [
        'name' => 'required|string|max:150',
        'email' => 'email|string|required|max:150|unique:users,email,'.$this->id_usuario,
        'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()],
        'rol' => 'required|exists:roles,name'
      ]
    )->validate();

    $usuario = User::create(
      [
      'name' => $this->name,
      'email' => $this->email,
      'password' => Hash::make($this->password),
      ]
    );

    $usuario->assignRole($this->rol);

    $this->dispatchBrowserEvent('swal:modal', [
      'title' => '¡Usuario creado!',
      'text' => '',
      'icon' => 'success',
    ]);

    $this->dispatchBrowserEvent('cerrarModalUsuario');
    
    $this->limpiarDatos();
  }

  public function agregarUsuario() {
    $this->dispatchBrowserEvent('mostrarModalUsuario');
  }

  public function cerrarModalUsuario() {
    $this->dispatchBrowserEvent('cerrarModalUsuario');
    $this->limpiarDatos();
  }

  public function limpiarDatos() {
    $this->id_usuario = '';
    $this->name = '';
    $this->email = '';
    $this->password = '';
    $this->password_confirmation = '';
    $this->rol = '';
    $this->editar = false;
  }
}
