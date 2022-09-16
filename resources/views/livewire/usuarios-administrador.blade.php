<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Usuarios registrados</h5>
    </div>
    <div class="card-body">
      <div class="w-full d-flex justify-content-between mb-4">
        <button wire:click="agregarUsuario()" class="btn btn-primary rounded-pill text-bold" type="button">Agregar</button>
        <div class="row col-6">
          <input wire:model="busqueda" class="form-control" type="text" placeholder="Buscar usuario por nombre">
        </div>
      </div>
      <div class="w-full row d-flex justify-content-start">
        @foreach ($usuarios as $usuario)
        <div class="d-flex justify-content-center col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"><strong>{{$usuario->name}}</strong></h5><br>
              <h6 class="card-text text-muted mb-2">{{$usuario->email}}<br><strong>{{ucfirst($usuario->getRoleNames()[0])}}</strong></h6>
              <div class="d-flex justify-content-between">
                <a wire:click="editarUsuario('{{$usuario->id}}')" class="card-link"  style="cursor: pointer">Editar</a>
                <a wire:click="confirmarEliminar('{{$usuario->id}}')" class="card-link text-danger" style="cursor: pointer">Eliminar</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Modal Usuario--}}
  <div wire:ignore.self class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="tituloModalUsuario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalUsuario">@if ($editar)
            Editar usuario              
          @else
            Crear usuario
          @endif</h5>
          <button wire:click="cerrarModalUsuario()" type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nombre">Nombre del usuario</label>
              <input wire:model="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="¿Cuál es el nombre del usuario?">
              @error('name')
                <small class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="email">Correo electrónico</label>
              <input wire:model="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="¿Cuál es el email del usuario?">
              @error('email')
                <small class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            @if (!$editar)
              <div class="form-group">
                <label for="password">Contraseña</label>
                <input wire:model="password" type="password" class="form-control" id="password" aria-describedby="password" placeholder="Introduce una contraseña para el usuario">
                @error('password')
                  <small class="form-text text-muted">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation" aria-describedby="password_confirmation" placeholder="Confirma la contraseña para el usuario">
                @error('password_confirmation')
                  <small class="form-text text-muted">{{$message}}</small>
                @enderror
              </div>
            @endif
            <div class="form-group">
              <label for="rol">Rol</label>
              <select wire:model="rol" class="form-control">
                <option value="">Selecciona un rol para el usuario</option>
                @foreach ($roles as $rol)
                  <option value="{{$rol->name}}">{{ucfirst($rol->name)}}</option>
                @endforeach
              </select>
              @error('rol')
                <small class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button wire:click="cerrarModalUsuario()" type="button" class="btn btn-secondary">Cerrar</button>
          <button @if($editar) wire:click="guardarUsuarioEditado()" @else wire:click="guardarUsuario()" @endif  type="button" class="btn btn-primary">Guardar</button> 
        </div>
      </div>
    </div>
  </div>
</div>
