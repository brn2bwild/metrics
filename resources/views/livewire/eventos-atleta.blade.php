<div class="w-full pb-2 pt-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Eventos en los que participas</h5>
    </div>
    <div class="card-body">
      <div class="w-full d-flex justify-content-end mb-4">
        <div class="row col-6">
          <input class="form-control" type="text" placeholder="Buscar evento por nombre">
        </div>
      </div>
      <div class="w-full row d-flex justify-content-start">
        @foreach ($registros as $registro)
          <div class="d-flex justify-content-center col-12 col-sm-6 col-md-4 col-xl-3">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{($registro->evento->url_imagen) ? 'storage/'.$registro->evento->url_imagen : asset('storage/imagenes/jumbotron-image.jpg')}}" alt="..." height="200px" style="border-radius: 5px 5px 0 0">
              <div class="card-body py-2">
                <h5 class="card-title">{{$registro->evento->nombre}}</h5>
                <p class="card-text mb-0">{{$registro->evento->fecha_hora}}</p>
                {{-- <p class="card-text mb-0">{{$registro->evento->ciudad}}</p>
                <p class="card-text mb-0">{{$registro->evento->estado}}</p> --}}
                <p class="card-text mb-0">Categoría: <strong>{{$registro->categoria->nombre}} {{($registro->categoria->equipos == 0) ? '(Individual)' : '(Equipos)'}}</strong></p>
              </div>
              <div class="card-footer text-muted">
                <div class="d-flex justify-content-center">
                  <a href="{{route('participaciones.mostrar', $registro->evento->url_evento)}}" class="card-link text-bold rounded-pill">Ver participación</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="w-full d-flex justify-content-end">
        {{$registros->links()}}
      </div>
    </div>
  </div>
</div>
