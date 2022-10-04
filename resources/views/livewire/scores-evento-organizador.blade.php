<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h5 class="m-0 text-bold">Scores {{$evento->nombre}} ({{$atletas}} atletas / {{$equipos}} equipos inscritos)</h5>
    </div>
    <div class="card-body">
      <div class="w-full d-flex justify-content-between mb-4">
        <div class="row col-4">
          <select wire:change="buscarCategoria()" wire:model="categoria" class="form-control">
            <option value="">Todos</option>
            @foreach ($evento->categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nombre}} {{($categoria->equipos == 0) ? '(Individual)' : '(Equipos)'}}</option>
            @endforeach
          </select>
        </div>
        <div class="row col-4">
          <input wire:change="buscarNombre()" wire:model="busqueda" class="form-control" type="text" placeholder="Buscar atleta o equipo por nombre">
        </div>
      </div>
      <div class="w-full row d-flex justify-content-center">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nombre atleta / equipo</th>
              <th>Categoría</th>  
            </tr>
          </thead>
          <tbody>
            @forelse ($registros as $registro)
              <tr wire:click="editarScores({{$registro}})" style="cursor: pointer">
                <td>{{($registro->nombre_equipo) ?: $registro->usuario->name}}</td>
                <td>{{$registro->categoria->nombre}} {{($registro->categoria->equipos == 0) ? '(Individual)' : '(Equipos)'}}</td>
              </tr>
            @empty
              <tr>
                <td class="text-center" colspan="2">No hay resultados para mostrar</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Modal Usuario--}}
  <div wire:ignore.self class="modal fade" id="modalScores" tabindex="-1" role="dialog" aria-labelledby="tituloModalScores" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModalScores">
            Score
          </h5>
          <button wire:click="cerrarModalScores()" type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nombre">Atleta / Equipo: {{$nombre_registro}}</label>
            </div>
            <div class="form-group">
              <label for="nombre">Categoria: {{$categoria_registro}} {{$tipo_categoria}}</label>
            </div>
            <div class="form-group">
              <label for="wods_categoria">Wod</label>
              {{-- <input wire:model="wods_categoria" type="wods_categoria" class="form-control" placeholder="¿Cuál es el wods_categoria del usuario?"> --}}
              @if ($wods_categoria != null)
                <select class="form-control">
                  <option value="">Selecciona un wod</option>
                  @forelse ($wods_categoria as $wod)
                    <option value="{{$wod->id}}">{{$wod->nombre}}</option>
                  @empty
                  @endforelse
                </select>
                @error('wods_categoria')
                  <small class="form-text text-muted">{{$message}}</small>
                @enderror
              @endif
            </div>
            <div class="form-group">
              <label for="score">Wod</label>
              <input wire:model="score" type="time" class="form-control">
              @error('score')
                <small class="form-text text-muted">{{$message}}</small>
              @enderror
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button wire:click="cerrarmodalScore()" type="button" class="btn btn-secondary">Cerrar</button>
          {{-- <button @if($editar) wire:click="guardarUsuarioEditado()" @else wire:click="guardarUsuario()" @endif  type="button" class="btn btn-primary">Guardar</button>  --}}
        </div>
      </div>
    </div>
  </div>
</div>
