<div>
  <table class="table table-hover m-0">
    <thead>
      <tr>
        <th>
          Categorías<span wire:click.prevent="agregarCategoria()" class="badge badge-primary rounded-pill text-bold p-1 px-2 ml-2" style="cursor: pointer">&plus;</span>
        </th>
        <th>
          Wods<span wire:click.prevent="agregarWod()" class="badge badge-primary rounded-pill text-bold p-1 px-2 ml-2" style="cursor: pointer">&plus;</span>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categorias as $categoria)
        <tr>
          <td>
            <span wire:click="editarCategoria({{$categoria}})" class="badge badge-info rounded-pill py-1 px-2" style="cursor: pointer">{{$categoria->nombre}}</span>
          </td>
          <td>
            @foreach ($categoria->wods as $wod)
              <span wire:click="editarWod({{$wod}})" class="badge badge-info rounded-pill py-1 px-2" style="cursor: pointer">{{$wod->nombre}}</span>
            @endforeach
          </td>
          {{-- <td>
            <a wire:click="editarCategoria({{$categoria}})" class="badge badge-primary text-xs rounded-pill p-2" data-toggle="modal" data-target="#categoriasModal"><i class="fas fa-pen"></i></a>
            <a wire:click="confirmarEliminarCategoria({{$categoria->id}})" class="badge badge-danger text-xs rounded-pill p-2 ml-2"><i class="fas fa-trash-alt"></i></a>
          </td> --}}
        </tr>
      @endforeach
    </tbody>
  </table>

  {{-- Modal categorías --}}
  <div wire:ignore.self class="modal fade" id="categoriasModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$accionCategoria}}</h5>
          <button wire:click.prevent="cerrarCategoriasModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombreCategoria">Nombre</label>
            <input wire:model="nombreCategoria" type="text" class="form-control" id="nombreCategoria" aria-describedby="nombreCategoria" placeholder="Asigna un nombre a la categoría" required>
            @error('nombreCategoria')
              <small id="nombre" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="descripcionCategoria">Descripción de la catagoría</label>
            <textarea wire:model="descripcionCategoria" type="text" class="form-control" id="descripcionCategoria" aria-describedby="descripcionCategoria" placeholder="Agrega una descripción a la categoría"></textarea>
            @error('descripcionCategoria')
              <small id="descripcion" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <div class="d-flex justify-content-start">
            @if($editarCategoria)
              <button wire:click.prevent="confirmarEliminarCategoria()" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
            @endif
          </div>
          <div>
            <button wire:click.prevent="guardarCategoria()" type="button" class="btn btn-primary mr-2">Guardar</button>
            <button wire:click.prevent="cerrarCategoriasModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal wods --}}
  <div wire:ignore.self class="modal fade" id="wodsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{$accionWod}}</h5> 
          <button wire:click.prevent="cerrarWodsModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombreWod">Nombre</label>
            <input wire:model="nombreWod" type="text" class="form-control" id="nombreWod" aria-describedby="nombreWod" placeholder="Asigna un nombre al wod" required>
            @error('nombreWod')
              <small id="nombre" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="descripcionWod">Descripción</label>
            <textarea wire:model="descripcionWod" type="text" class="form-control" id="descripcionWod" aria-describedby="descripcionWod" placeholder="Agrega la descripción del wod">
            </textarea>
            @error('descripcionWod')
              <small id="descripcion" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="tipoWod">Tipo de wod</label>
            <select wire:model="tipoWod" id="tipoWod" class="form-control" required>
              <option value="">Selecciona una opción</option>
              <option value="amrap">Amrap</option>
              <option value="fortime">For time</option>
            </select>
            @error('tipoWod')
              <small id="tipo" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="timeCap">Time cap (minutos)</label>
            <input wire:model="timeCap" type="time" class="form-control" id="timeCap" aria-describedby="timeCap" step="1" value="12:23:00" required>
            @error('timeCap')
              <small id="timecap" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="categoriaWod">Categoría</label>
            {{-- <input wire:model="categoriaWod" type="number" class="form-control" id="categoriaWod" aria-describedby="categoriaWod" min="0"> --}}
            <select wire:model="categoriaWod" class="form-control">
              <option value="">Selecciona una categoría</option>
              @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
              @endforeach
            </select>
            @error('categoriaWod')
              <small id="categoriaWod" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <div class="d-flex justify-content-start">
            @if ($editarWod)
              <button wire:click.prevent="confirmarEliminarWod()" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
            @endif
          </div>
          <div class="">
            <button wire:click.prevent="guardarWod()" type="button" class="btn btn-primary mr-2">Guardar</button>
            <button wire:click.prevent="cerrarWodsModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
