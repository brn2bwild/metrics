<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <section class="col-12 col-md-8 mb-4">
          <div class="form-group">
            <label for="nombre">Nombre del evento</label>
            <input wire:model="nombre" type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="¿Cuál es el nombre del evento?">
            @error('nombre')
              <small id="nombre" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 form-group">
              <label for="fecha">Fecha del evento</label>
              <input wire:model="fecha" type="date" class="form-control" id="fecha" aria-describedby="fecha" placeholder="¿Cuál es la fecha del evento?">
              @error('fecha')
                <small id="fecha" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="col-12 col-sm-6 form-group">
              <label for="hora">Hora del evento</label>
              <input wire:model="hora" type="time" class="form-control" id="hora" aria-describedby="hora" placeholder="¿Cuál es la hora del evento?">
              @error('hora')
                <small id="hora" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-4 form-group">
              <label for="ciudad">Ciudad del evento</label>
              <input wire:model="ciudad" type="text" class="form-control" id="ciudad" aria-describedby="ciudad" placeholder="¿En qué ciudad será el evento?">
              @error('ciudad')
                <small id="ciudad" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="col-12 col-sm-4 form-group">
              <label for="estado">Estado</label>
              <input wire:model="estado" type="text" class="form-control" id="estado" aria-describedby="estado" placeholder="¿En qué estado se llevará a cabo?">
              @error('estado')
                <small id="estado" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="col-12 col-sm-4 form-group">
              <label for="direccion">Dirección</label>
              <input wire:model="direccion" type="text" class="form-control" id="direccion" aria-describedby="direccion" placeholder="¿Cuál es la dirección del evento?">
              @error('direccion')
                <small id="direccion" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion">descripcion</label>
            <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" aria-describedby="descripcion" placeholder="Agrega alguna información extra para el evento."></textarea>
            @error('descripcion')
              <small id="descripcion" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="row">
            <div class="col-12 col-sm-6 form-group">
              <label for="facebook">Facebook</label>
              <input wire:model="facebook" type="text" class="form-control" id="facebook" aria-describedby="facebook" placeholder="¿Tiene página de facebook?">
              @error('facebook')
                <small id="facebook" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="col-12 col-sm-6 form-group">
              <label for="instagram">Instagram</label>
              <input wire:model="instagram" type="text" class="form-control" id="instagram" aria-describedby="instagram" placeholder="¿Está en instagram?">
              @error('instagram')
                <small id="instagram" class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label for="url_pagina">Página oficial</label>
            <input wire:model="url_pagina" type="text" class="form-control" id="url_pagina" aria-describedby="url_pagina" placeholder="Agrega la página oficial de tu evento">
            @error('url_pagina')
              <small id="url_pagina" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="row d-flex justify-content-between px-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAtletas">
              Atletas inscritos
            </button>
            <button wire:click.prevent="guardar()" class="btn btn-primary">Guardar</button>
          </div>
        </section>
        <section class="col-12 col-md-4">
          @if($evento->url_imagen == null)
            <label>Agrega una imágen para tu evento</label>
            <div class="input-group">
              <div class="custom-file">
                <input wire:model="imagen" type="file" class="custom-file-input" id="imagenEvento">
                <label class="custom-file-label" for="imagenEvento">Buscar archivo</label>
              </div>
              <div class="input-group-append">
                <button wire:click="guardarImg()" class="btn btn-outline-secondary" type="button">Guardar</button>
              </div>
            </div>
            @error('imagen')
              <small id="nombre" class="form-text text-red">{{$message}}</small>
            @enderror
          @else
            <label>Imagen del evento</label>
            <figure class="figure">
              <img src="{{(asset('storage/'.$evento->url_imagen)) ?: asset('storage/images/jumbotron-image.jpg')}}" class="figure-img img-fluid rounded" alt="">
              <figcaption class="figure-caption">Esta imagen se mostrará a los participantes.</figcaption>
            </figure>
            <div class="row pl-2">
              <button wire:click.prevent="confimarEliminarImg({{$evento->id}})" class="btn btn-danger float-right">Eliminar</button>
            </div>
          @endif          
        </section>
        <section class="col-12">
          <livewire:categorias-organizador :evento="$evento"/>
        </section>
      </div>
    </div>
  </div>
  <livewire:atletas-inscritos :evento="$evento"/>
</div>