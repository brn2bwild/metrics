<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-header">
      <h3>Eventos organizados</h3>
    </div>
    <div class="card-body">
      <div class="w-full d-flex justify-content-between mb-4">
        <button class="btn btn-primary rounded-pill text-bold" type="button" data-toggle="modal" data-target="#modalEvento">Agregar</button>
        <div>
          <input class="form-control" type="text" placeholder="Buscar">
        </div>
      </div>
      <div class="w-full row d-flex justify-content-start">
        @foreach ($eventos as $evento)
          <div class="d-flex justify-content-center col-12 col-sm-6 col-md-4 col-xl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{($evento->url_imagen) ? 'storage/'.$evento->url_imagen : asset('storage/images/jumbotron-image.jpg')}}" alt="..." height="200px" style="border-radius: 5px 5px 0 0">
              <div>
                <label for="imagenEvento" class="badge badge-primary text-bold text-md rounded-pill p-2" style="position:absolute; top: 178px;
                left: 5px;" data-toggle="tooltip" title="Buscar imágen">
                  <span class="fas fa-camera" aria-hidden="true" style="cursor: pointer"></span>
                  <input type="file" id="imagenEvento" style="display:none">
                </label>
                <label for="cargarImagen" class="badge badge-success text-bold text-md rounded-pill p-2" style="position:absolute; top: 178px;
                left: 44px;" data-toggle="tooltip" title="Subir imágen">
                  <span class="fas fa-check" aria-hidden="true" style="cursor: pointer"></span>
                  {{-- <button id="cargarImagen" style="display:none"></button> --}}
                </label>
                <label for="eliminarImagen" class="badge badge-danger text-bold text-md rounded-pill p-2" style="position:absolute; top: 178px;
                right: 5px;"  data-toggle="tooltip" title="Eliminar imágen">
                  <span class="fas fa-trash-alt" aria-hidden="true" style="cursor: pointer"></span>
                  {{-- <button id="eliminarImagen" style="display:none"></button> --}}
                </label>
              </div>
              <div class="card-body">
                <h5 class="card-title">{{$evento->nombre}}</h5>
                <p class="card-text mb-0">{{$evento->fecha_hora}}</p>
                <p class="card-text mb-0">{{$evento->ciudad}}</p>
                <p class="card-text mb-0">{{$evento->estado}}</p>
              </div>
              <div class="card-footer text-muted">
                <div class="d-flex justify-content-between">
                  <a href="{{route('eventos.editar', $evento->url_evento)}}" class="card-link text-bold rounded-pill">Editar</a>
                  <a href="" onclick="confirmarEliminar('{{$evento->url_evento}}')" class="card-link text-bold text-danger">Eliminar</a>
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

  {{-- Modal --}}
  <div wire:ignore.self class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="tituloModalEvento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalEvento">Crear evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button wire:click="guardar()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
