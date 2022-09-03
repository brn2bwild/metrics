<div class="">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Categoría<span class="badge badge-primary rounded-pill text-bold p-1 px-2 ml-2" data-toggle="modal" data-target="#categoriasModal" style="cursor: pointer">&plus;</span>
        </th>
        <th>Wods<span class="badge badge-primary rounded-pill text-bold p-1 px-2 ml-2" data-toggle="modal" data-target="#wodsModal" style="cursor: pointer">&plus;</span>
          {{-- <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#wodsModal">Agregar</button> --}}
        </th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categorias as $categoria)
        <tr>
          <td>{{$categoria->nombre}}</td>
          <td>
            @foreach ($categoria->wods as $wod)
            <span class="badge badge-info rounded-pill py-1 px-2" data-toggle="tooltip" data-placement="top" title="algo acá">{{$wod->nombre}}</span>
            @endforeach
          </td>
          <td>
            <a wire:click="editarCategoria({{$categoria}})" class="badge badge-primary text-xs rounded-pill p-2" data-toggle="modal" data-target="#categoriasModal"><i class="fas fa-pen"></i></a>
            <a wire:click="confirmarEliminarCategoria({{$categoria->id}})" class="badge badge-danger text-xs rounded-pill p-2"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{-- Modal categorías --}}
  <div wire:ignore.self class="modal fade" id="categoriasModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button wire:click.prevent="guardarCategoria()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal wods --}}
  <div wire:ignore.self class="modal fade" id="wodsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar wod</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
            <input wire:model="timeCap" type="number" class="form-control" id="timeCap" aria-describedby="timeCap" min="0" required>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button wire:click.prevent="guardarWod()" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>
