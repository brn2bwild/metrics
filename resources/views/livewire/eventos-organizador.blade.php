<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h5 class="m-0">Eventos organizados</h5>
    </div>
    <div class="card-body">
      <div class="w-full d-flex justify-content-between mb-4">
        <button wire:click="mostrarModalEvento()" class="btn btn-primary rounded-pill text-bold" type="button">Agregar</button>
        <div class="row col-6">
          <input class="form-control" type="text" placeholder="Buscar evento por nombre">
        </div>
      </div>
      <div class="w-full row d-flex justify-content-start">
        @foreach ($eventos as $evento)
          <div class="d-flex justify-content-center col-12 col-sm-6 col-md-4 col-xl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{($evento->url_imagen) ? 'storage/'.$evento->url_imagen : asset('storage/imagenes/jumbotron-image.jpg')}}" alt="..." height="200px" style="border-radius: 5px 5px 0 0">
              <div>
                <button wire:click="mostrarAtletas({{$evento}})" type="button" class="btn btn-primary text-bold rounded-pill text-sm" style="position:absolute; top: 178px; left: 5px; cursor: pointer">Atletas/Equipos <span class="badge badge-light ml-2 font-sm">{{$evento->registros->count()}}</span>
                </button>
                @if (!$evento->url_imagen)
                  <label wire:click="cargarImagenEvento('{{$evento->url_evento}}')" for="imagenEvento-{{$evento->url_evento}}" class="badge badge-primary text-bold text-md rounded-pill p-2" style="position:absolute; top: 178px;
                  right: 5px; cursor: pointer" data-toggle="tooltip" title="Buscar imágen">
                    <span  class="fas fa-camera" aria-hidden="true"></span>
                  </label>
                @else
                  <label wire:click="confirmarEliminarImagenEvento('{{$evento->url_imagen}}')" for="eliminarImagen" class="badge badge-danger text-bold text-md rounded-pill p-2" style="position:absolute; top: 178px;
                  right: 5px; cursor: pointer;" data-toggle="tooltip" title="Eliminar imágen">
                    <span class="fas fa-trash-alt" aria-hidden="true"></span>
                  </label>
                @endif
              </div>
              <div class="card-body pb-2 pt-3">
                <h5 class="card-title"><strong>{{$evento->nombre}}</strong></h5>
                <p class="card-text mb-0">Fecha y hora: <strong>{{$evento->fecha_hora}}</strong></p>
                {{-- <p class="card-text mb-0">{{$evento->ciudad}}</p>
                <p class="card-text mb-0">{{$evento->estado}}</p> --}}
              </div>
              <div class="card-footer text-muted">
                <div class="d-flex justify-content-between">
                  <a href="{{route('eventos.editar', $evento->url_evento)}}" class="card-link text-bold rounded-pill">Editar evento</a>
                  <a href="" wire:click.prevent="confirmarEliminarEvento('{{$evento->url_evento}}')" class="card-link text-bold text-danger">Eliminar evento</a>
                </div>
                <div class="d-flex justify-content-center pt-2">
                  <a href="{{route('scores.editar', $evento->url_evento)}}" class="card-link text-bold text-info">Scores</a>
                </div>
              </div>
            </div>
          </div> 
        @endforeach
      </div>
      <div class="w-full d-flex justify-content-end">
        {{$eventos->links()}}
      </div>
    </div>
  </div>

  {{-- @if($evento_mostrar != null)
    <livewire:atletas-inscritos :evento="$evento_mostrar"/>
  @endif --}}
  {{-- Modal atletas --}}
  @if($evento_mostrar != null)
    <div class="modal fade" id="modalAtletas" tabindex="-1" role="dialog" aria-labelledby="modalAtletasTitulo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-bold">Atletas inscritos en {{$evento_mostrar->nombre}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-strip">
              <thead>
                <tr>
                  <th>Nombre completo</th>
                  <th>Categoría</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($evento_mostrar->registros as $registro)
                  <tr>
                    <td>{{($registro->categoria->equipos == 0) ? $registro->usuario->name : $registro->nombre_equipo}}</td>
                    {{-- <td>{{$registro->categoria->nombre}} {{($registro->nombre_equipo == null) ? "<i class='bx bx-user text-lg'></i>" : "<i class='bx bx-group text-lg'></i>"}}</td> --}}
                    <td class="d-flex align-items-center">{{$registro->categoria->nombre}} 
                    @if($registro->nombre_equipo == null)
                      (Individual)<i class='bx bx-user h3 ml-2'></i> 
                    @else 
                      (Equipo)<i class='bx bx-group h3 ml-2'></i> 
                    @endif</td>
                  </tr>
                @empty
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          </div>
        </div>
      </div>
    </div>
  @endif

  {{-- Modal evento--}}
  <div wire:ignore.self class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="tituloModalEvento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalEvento">Crear evento</h5>
          <button wire:click="cerrarModalEvento()" type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nombre">Nombre del evento</label>
              <input wire:model="nombre" type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="¿Cuál es el nombre del evento?">
              @error('nombre')
                <small id="nombre" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="fecha">Fecha del evento</label>
              <input wire:model="fecha" type="date" class="form-control" id="fecha" aria-describedby="fecha" placeholder="¿Cuál es la fecha del evento?">
              @error('fecha')
                <small id="fecha" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="ciudad">Ciudad del evento</label>
              <input wire:model="ciudad" type="text" class="form-control" id="ciudad" aria-describedby="ciudad" placeholder="¿En qué ciudad será el evento?">
              @error('ciudad')
                <small id="ciudad" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="estado">Estado</label>
              <input wire:model="estado" type="text" class="form-control" id="estado" aria-describedby="estado" placeholder="¿En qué estado se llevará a cabo?">
              @error('estado')
                <small id="estado" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button wire:click="cerrarModalEvento()" type="button" class="btn btn-secondary">Cancelar</button>
          <button wire:click="guardarEvento()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal imagen --}}
  <div wire:ignore.self class="modal fade" id="modalImagenEvento" tabindex="-1" role="dialog" aria-labelledby="tituloModalImagenEvento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalmagenEvento">Subir imágen para el evento</h5>
          <button wire:click.prevent="cerrarModalImagenEvento()" type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="input-group">
              {{-- <div class="input-group-prepend">
                <span class="input-group-text btn btn-primary">Subir</span>
              </div> --}}
              <div class="custom-file">
                <input wire:model="imagen_evento" type="file" class="custom-file-input" id="inputImagen" aria-describedby="imagen_evento" accept="image/*">
                <label class="custom-file-label" for="inputImagen">Buscar imágen</label>
              </div>
            </div>
            @error('imagen_evento')
              <small class="form-text text-muted">{{$message}}</small>
            @enderror
            {{-- <div class="form-group">
              <label for="fecha">Fecha del evento</label>
              <input wire:model="fecha" type="date" class="form-control" id="fecha" aria-describedby="fecha" placeholder="¿Cuál es la fecha del evento?">
              @error('fecha')
                <small id="fecha" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="ciudad">Ciudad del evento</label>
              <input wire:model="ciudad" type="text" class="form-control" id="ciudad" aria-describedby="ciudad" placeholder="¿En qué ciudad será el evento?">
              @error('ciudad')
                <small id="ciudad" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="estado">Estado</label>
              <input wire:model="estado" type="text" class="form-control" id="estado" aria-describedby="estado" placeholder="¿En qué estado se llevará a cabo?">
              @error('estado')
                <small id="estado" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div> --}}
          </form>
        </div>
        <div class="modal-footer">
          <button wire:click.prevent="cerrarModalImagenEvento()" type="button" class="btn btn-secondary">Cancelar</button>
          <button wire:click="guardarImagen()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
