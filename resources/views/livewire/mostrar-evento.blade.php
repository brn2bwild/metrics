<div>
  <!-- Sección de la tarjeta del evento -->
  <div class="w-full flex justify-center px-8 py-4" style="height: 50vh">
    <div class="max-w-sm w-full lg:max-w-full lg:flex justify-center h-full">
      <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden shadow-md" style="background-image: url('{{($evento->url_imagen) ? asset('storage/'.$evento->url_imagen) : asset('storage/imagenes/jumbotron-image.jpg')}}')" title="{{$evento->nombre}}">
      </div>
      <div class="border-none bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal shadow-md">
        <div class="mb-4">
          <p class="text-sm text-gray-600 flex items-center">
            <i class='bx bxs-calendar mr-2'></i>
            {{$fecha_evento}}
          </p>
          <div class="text-gray-900 font-bold text-xl mb-2">{{$evento->nombre}}</div>
          <p class="text-gray-700 text-base mb-4">{{$evento->comentarios}}</p>
          <div class="w-full lg:w-3/4 flex justify-between gap-4 mb-4">
            @isset ($redes->facebook)
              @if ($redes->facebook !== '')
                <a href="{{$redes->facebook}}" class="bg-transparent hover:bg-gray-800 text-gray-900 font-semibold hover:text-white p-2 border-2 border-gray-800 hover:border-transparent rounded-full text-lg flex align-middle"><i class='bx bxl-facebook'></i></a>
              @endif
            @endisset
            @isset ($redes->instagram)
              @if ($redes->instagram !== '')
                <a href="{{$redes->instagram}}" class="bg-transparent hover:bg-gray-800 text-gray-900 font-semibold hover:text-white p-2 border-2 border-gray-800 hover:border-transparent rounded-full text-lg flex align-middle"><i class='bx bxl-instagram'></i></a>
              @endif
            @endisset
            @isset ($redes->whatsapp)
              @if ($redes->whatsapp !== '')
                <a href="{{$redes->whatsapp}}" class="bg-transparent hover:bg-gray-800 text-gray-900 font-semibold hover:text-white p-2 border-2 border-gray-800 hover:border-transparent rounded-full text-lg flex align-middle"><i class='bx bxl-whatsapp'></i></a>
              @endif
            @endisset
          </div>
          <div class="w-full lg:1/2">
            @if ($evento->url_pagina) 
              <a href="{{$evento->url_pagina}}"><p class="text-md underline">Página oficial del evento</p></a>
            @endif
          </div>
        </div>
        <div class="flex justify-between items-center gap-4">
          {{-- <img class="w-10 h-10 rounded-full mr-4" src="{{($evento->url_imagen) ? asset('storage/'.$evento->url_imagen) : asset('storage/images/jumbotron-image.jpg')}}"> --}}
          <div class="text-sm">
            <p class="text-gray-900 leading-none">{{$evento->organizador->name}}</p>
            <p class="text-gray-600 mb-0">Agregado {{$fecha_creacion}}</p>
          </div>
          @if (!$registrado)
            <div>
              <span wire:click="verificarInscripcion()" class="bg-transparent hover:bg-gray-800 text-gray-900 font-semibold hover:text-white py-1 px-3 border-2 border-gray-800 hover:border-transparent rounded-full text-lg" style="cursor: pointer">Inscribirse</span>
            </div> 
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Sección de los nombres de las categorías -->
  <div class=" w-full flex flex-wrap justify-center mt-20 lg:my-0 p-4 bg-slate-50">
    @foreach ($evento->categorias as $categoria)
      <span wire:click="verCategoria('{{$categoria->id}}')" class="inline-block bg-gray-200 rounded-full px-4 py-2 text-md font-semibold text-gray-700 ml-2 cursor-pointer mb-2 lg:mb-0 text-center"> 
        @if($categoria->equipos == 0) 
          <i class='bx bx-user text-xl'></i> {{$categoria->nombre}} (Individual)  
        @else
          <i class='bx bx-group text-xl'></i> {{$categoria->nombre}} (Equipos)  
        @endif
      </span>
    @endforeach
  </div>

  <!-- Sección de los wods -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 px-8 pb-4">
    @if ($wods_categoria != null)
      @forelse ($wods_categoria as $wod)
      <div class="flex justify-center">
        <div class="block rounded-md shadow-lg bg-white w-full text-center">
          <div class="py-3 px-4 border-b border-gray-300 flex justify-between align-bottom">
            <i class='bx bx-dumbbell text-4xl'></i>
            <h5 class="text-gray-900 text-xl font-semibold pr-8">{{$wod->nombre}}</h5>
          </div>
          <div class="p-6">
            <p class="text-gray-700 text-base">
              {{$wod->descripcion}}
            </p>
          </div>
        </div>
      </div> 
      @empty
      @endforelse
    @endif
  </div>

  <template id="template-categoria">
    <swal-title>
      Selecciona la categoría a la que deseas inscribirte
    </swal-title>
    <swal-input type="select" placeholder="Selecciona una categoría" value="">
      @foreach ($evento->categorias as $categoria)
        <swal-input-option value="{{$categoria->id}}">{{$categoria->nombre}} {{($categoria->equipos == 0) ? '(Individual)' : '(Equipos)'}}</swal-input-option> 
      @endforeach
    </swal-input>
    <swal-button type="confirm" color="info">
      Aceptar
    </swal-button>
    <swal-button type="deny">
      Cancelar
    </swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param
      name="customClass"
      value='{ "popup": "my-popup" }' />
  </template>

  <template id="template-equipo">
    <swal-title>
      Introduce el nombre de tu equipo
    </swal-title>
    <swal-input type="text" placeholder="Nombre del equipo" value="">
    </swal-input>
    <swal-button type="confirm" color="info">
      Aceptar
    </swal-button>
    <swal-button type="deny">
      Cancelar
    </swal-button>
    <swal-param name="allowEscapeKey" value="false" />
    <swal-param
      name="customClass"
      value='{ "popup": "my-popup" }' />
  </template>
</div>
