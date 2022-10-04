<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-header d-flex align-items-center">
      <h5 class="m-0">Scores {{$evento->nombre}}</h5>
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
              <tr>
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
</div>
