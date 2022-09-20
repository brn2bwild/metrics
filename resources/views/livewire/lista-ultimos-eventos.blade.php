<div>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @foreach ($eventos as $evento)
      <a class="" href="{{route('lista-eventos.show', $evento->url_evento)}}">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
          <img class="w-full" src="{{($evento->url_imagen) ? asset('storage/'.$evento->url_imagen) : asset('storage/imagenes/jumbotron-image.jpg')}}" alt="{{$evento->nombre}}">
          <div class="px-6 py-4 bg-yellow-300">
            <div class="font-bold text-xl text-center">{{$evento->nombre}}</div>
            {{-- <p class="text-gray-700 text-base">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
            </p> --}}
          </div>
          {{-- <div class="px-6 pt-4 pb-2">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
          </div> --}}
        </div>
      </a>
    @endforeach
  </div>
</div>
