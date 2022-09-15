<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <section class="col-12 col-md-6 mb-3 mb-md-0">
          <h4 class="card-text mb-4"><strong>{{$evento->nombre}}</strong></h4>
          <div class="row mb-4">
            <p class="card-text col-12">Dirección: <strong>{{$evento->direccion}}</strong></p>
            <p class="card-text col-12">Municipio: <strong>{{$evento->ciudad}}</strong></p>
            <p class="card-text col-12">Estado: <strong>{{$evento->estado}}</strong></p>
            <p class="card-text col-12">Fecha: <strong>{{$fecha}}</strong></p>
            <p class="card-text col-12">Hora: <strong>{{$hora}}</strong></p>
            <p class="card-text col-12">Comentarios generales: <strong>{{$evento->comentarios}}</strong></p>
            <p class="card-text col-12">Número de Whatsapp: <strong>{{$whatsapp ?: 'No hay agregado un número'}}</strong></p>

          </div>
          <div class="row w-full d-flex justify-content-between">
            @if ($instagram != '')
              <div class="col-12 col-md-4 text-center mb-2 mb-md-0 p-0">
                <a href="{{$instagram}}" class="card-link text-bold">Ver página de Instagram</a>
              </div>
            @endif
            @if ($facebook != '')
              <div class="col-12 col-md-4 text-center mb-2 mb-md-0 p-0">
                <a href="{{$facebook}}" class="card-link text-bold">Ver página de Facebook</a>
              </div>
            @endif
            @if ($url_pagina != '')
              <div class="col-12 col-md-4 text-center mb-2 mb-md-0 p-0">
                <a href="{{$url_pagina}}" class="card-link text-bold">Ver página oficial</a>
              </div>
            @endif
          </div>
        </section>
        <section class="col-12 col-md-6">
          <div class="d-flex justify-content-center mb-2">
            <a class="card-link text-bold"><h4 data-toggle="modal" data-target="#categoriasModal" class="" style="cursor: pointer"><i class="fas fa-pen-square mr-2"></i>Categoría: <strong>{{$registro->categoria->nombre}}</strong></h4></a>
          </div>
          <ul class="list-group">
            @foreach ($registro->categoria->wods as $wod)
              <li href="#" class="list-group-item list-group-item-action btn-primary" data-toggle="collapse" data-target="#collapseExample{{$wod->id}}" aria-expanded="false" aria-controls="collapseExample">{{$wod->nombre}}
              </li>
              <div class="collapse" id="collapseExample{{$wod->id}}">
                <div class="card card-body">
                  {{$wod->descripcion}}
                </div>
              </div>
            @endforeach
          </ul>
        </section>
      </div>
    </div>
  </div>

  <!-- Modal editar categoría -->
  <div wire:ignore.self class="modal fade" tabindex="-1" id="categoriasModal" aria-labelledby="tituloCategoriasModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloCategoriasModal">Categoría</h5>
          <button data-toggle="modal" data-target="#categoriasModal" type="button" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="categoria">Selecciona la categoría en la que deseas participar</label>
          <select wire:model="categoria" id="categoria" class="form-control">
            @foreach ($evento->categorias as $categoria)
              <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
            @endforeach
          </select>
          @error('categoria')
            <small id="descripcion" class="form-text text-muted">{{$message}}</small>
            @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button wire:click="guardarCategoria()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
