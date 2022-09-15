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
  public $ver = false;
  public $name, $email, $password, $password_confirmation, $rol;

  public function render() {
    return view('livewire.usuarios-administrador', [
      'usuarios' => User::where('name', 'like', '%'.$this->busqueda.'%')->get(),
      'roles' => Role::all()
    ]);
  }

  public function verUsuario($id) {
    $usuario = User::find($id);
    $this->name = $usuario->name;
    $this->email = $usuario->email;
    $this->rol = $usuario->getRoleNames()[0];
    $this->dispatchBrowserEvent('mostrarModalUsuario');
    $this->ver = true;
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
        'email' => 'email|string|required|unique:users|max:150',
        'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->uncompromised()],
        'rol' => 'required|exists:roles,name'
      ]
    )->validate();

    $usuario = User::create([
      'name' => $this->name,
      'email' => $this->email,
      'password' => Hash::make($this->password),
    ]);

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
    $this->name = '';
    $this->email = '';
    $this->password = '';
    $this->password_confirmation = '';
    $this->rol = '';
    $this->ver = false;
  }
}
