<div class="modal fade" id="modalAtletas" tabindex="-1" role="dialog" aria-labelledby="modalAtletasTitulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atletas inscritos</h5>
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
            @foreach ($evento->registros as $registro)
              <tr>
                <td>{{$registro->usuario->name}}</td>
                <td>{{$registro->categoria->nombre}}</td>
              </tr>
            @endforeach
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
