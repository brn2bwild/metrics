<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermisosSeeder extends Seeder
{
  public function run()
  {
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    Permission::create(['name' => 'crear roles']);
    Permission::create(['name' => 'editar roles']);
    Permission::create(['name' => 'eliminar roles']);
    Permission::create(['name' => 'ver usuarios']);
    Permission::create(['name' => 'eliminar usuarios']);
    Permission::create(['name' => 'crear eventos']);
    Permission::create(['name' => 'editar eventos']);
    Permission::create(['name' => 'eliminar eventos']);
    Permission::create(['name' => 'administrar perfil']);

    $rolAdministrador = Role::create(['name' => 'administrador']);
    $rolAdministrador->givePermissionTo('crear roles');
    $rolAdministrador->givePermissionTo('editar roles');
    $rolAdministrador->givePermissionTo('eliminar roles');
    $rolAdministrador->givePermissionTo('ver usuarios');
    $rolAdministrador->givePermissionTo('eliminar usuarios');
    $rolAdministrador->givePermissionTo('crear eventos');
    $rolAdministrador->givePermissionTo('editar eventos');
    $rolAdministrador->givePermissionTo('eliminar eventos');
    $rolAdministrador->givePermissionTo('administrar perfil');

    $rolOrganizador = Role::create(['name' => 'organizador']);
    $rolOrganizador->givePermissionTo('crear eventos');
    $rolOrganizador->givePermissionTo('editar eventos');
    $rolOrganizador->givePermissionTo('eliminar eventos');
    $rolOrganizador->givePermissionTo('administrar perfil');

    $rolUsuario = Role::create(['name' => 'usuario']);
    $rolUsuario->givePermissionTo('administrar perfil');

    $usuarioAdmin = User::factory()->create([
      'name' => 'Daniel Pérez Flores',
      'email' => 'daniel_pflores@hotmail.com',
      'password' => Hash::make('12345678'),
    ]);

    $usuarioAdmin->assignRole($rolAdministrador);
  }
}
