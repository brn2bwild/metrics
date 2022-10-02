<x-app-layout>
  {{-- <div class="w-full flex justify-center p-8" style="height: 40vh">
    <div class="max-w-sm w-full lg:max-w-full lg:flex justify-center h-full">
      <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden shadow-md" style="background-image: url('{{($evento->url_imagen) ? asset('storage/'.$evento->url_imagen) : asset('storage/images/jumbotron-image.jpg')}}')" title="{{$evento->nombre}}">
      </div>
      <div class="border-none bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal shadow-md">
        <div class="mb-8">
          <p class="text-sm text-gray-600 flex items-center">
            <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
            </svg>
            Members only
          </p>
          <div class="text-gray-900 font-bold text-xl mb-2">{{$evento->nombre}}</div>
          <p class="text-gray-700 text-base mb-4">{{$evento->comentarios}}</p>
          <div class="w-full lg:w-3/4 flex justify-between gap-4 mb-4">
            @php
              $redes = json_decode($evento->redes_sociales)    
            @endphp
            @isset ($redes->facebook)
              @if ($redes->facebook !== '')
                <a href="{{$redes->facebook}}" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white p-2 border-2 border-gray-500 hover:border-transparent rounded-full text-lg flex align-middle"><i class='bx bxl-facebook'></i></a>
              @endif
            @endisset
            @isset ($redes->instagram)
              @if ($redes->instagram !== '')
                <a href="{{$redes->instagram}}" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white p-2 border-2 border-gray-500 hover:border-transparent rounded-full text-lg flex align-middle"><i class='bx bxl-instagram'></i></a>
              @endif
            @endisset
            @isset ($redes->whatsapp)
              @if ($redes->whatsapp !== '')
                <a href="{{$redes->whatsapp}}" class="bg-transparent hover:bg-gray-500 text-gray-700 font-semibold hover:text-white p-2 border-2 border-gray-500 hover:border-transparent rounded-full text-lg flex align-middle"><i class='bx bxl-whatsapp'></i></a>
              @endif
            @endisset
          </div>
          <div class="w-full lg:1/2">
            @if ($evento->url_pagina) 
              <a href="{{$evento->url_pagina}}"><p class="text-md underline">Página oficial del evento</p></a>
            @endif
          </div>
        </div>
        <div class="flex items-center">
          <img class="w-10 h-10 rounded-full mr-4" src="{{($evento->url_imagen) ? asset('storage/'.$evento->url_imagen) : asset('storage/images/jumbotron-image.jpg')}}">
          <div class="text-sm">
            <p class="text-gray-900 leading-none">{{$evento->organizador->name}}</p>
            @php
              use Carbon\Carbon;
              $fecha = new Carbon($evento->fecha_hora);
            @endphp

            <p class="text-gray-600">{{$fecha}}</p>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <livewire:mostrar-evento :evento="$evento"/>


  <script>
    window.addEventListener('swal:modal', event => {
      Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        // footer: '<a href="/login">Iniciar Sesión</a><a class="ml-4" href="/register">Crear una cuenta</a>'
        footer: ''
      })
    })

    window.addEventListener('swal:confirmar', event => {
      Swal.fire({
        template: '#template-categoria'
      //   title: event.detail.title,
      //   text: event.detail.text,
      //   icon: event.detail.icon,
      //   showDenyButton: true,
      //   confirmButtonText: 'Inscribirse',
      //   denyButtonText: 'Cancelar',
      //   confirmButtonColor: '#3085d6',
      //   cancelButtonColor: '#d33',
      }).then((resultado) => {
        if(resultado.isConfirmed) { window.livewire.emit('inscribirUsuario', resultado.value) }
      })
    })

    window.addEventListener('swal:confirmarEquipo', event => {
      Swal.fire({
        template: '#template-equipo'
      }).then((resultado) => {
        if(resultado.isConfirmed) { window.livewire.emit('inscribirEquipo', resultado.value) }
      })
    })
  </script>
</x-app-layout>