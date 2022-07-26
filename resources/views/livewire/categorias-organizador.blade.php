<div class="mt-4">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Categoría<button class="btn btn-primary ml-2" data-toggle="modal" data-target="#categoriasModal">Agregar</button></th>
        <th>Wods<button class="btn btn-primary ml-2" data-toggle="modal" data-target="#wodsModal">Agregar</button></th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categorias as $categoria)
        <tr>
          <td>{{$categoria->nombre}}</td>
          <td>
            @foreach ($categoria->wods as $wod)
            <span class="badge badge-info">{{$wod->nombre}}</span>
            @endforeach
          </td>
          <td>
            <button wire:click="editarCategoria({{$categoria}})" class="btn btn-primary" data-toggle="modal" data-target="#categoriasModal"><i class="fas fa-pen"></i></button>
            <button wire:click="confirmarEliminarCategoria({{$categoria->id}})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            <label for="nombre">Nombre de la categoría</label>
            <input wire:model="nombre" type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Asigna un nombre a la categoría">
            @error('nombre')
              <small id="nombre" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción de la catagoría</label>
            <textarea wire:model="descripcion" type="text" class="form-control" id="descripcion" aria-describedby="descripcion" placeholder="Agrega una descripción a la categoría"></textarea>
            @error('descripcion')
              <small id="descripcion" class="form-text text-muted">{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button wire:click.prevent="guardar()" type="button" class="btn btn-primary">Guardar</button>
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
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
