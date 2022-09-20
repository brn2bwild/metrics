<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <section class="bg-gray-600 flex items-center justify-center" style="background-image: url('{{asset('storage/imagenes/jumbotron-image_edit.jpg')}}'); background-size: cover; background-position: center; height:92vh;">
      <div class="max-w-7xl sm:px-6 lg:px-8 mx-auto">
        <div class="grid grid-cols-4 md:grid-cols-8">
          <div class="col-span-4 text-center md:text-right p-8 text-white text-5xl font-mono">
            <h1 class="">Si tu meta es ser el mejor, podemos ayudarte</h1>
          </div>
          <div class="bg-transparent col-span-4 flex items-center justify-center">
            <h1 class="display-5 fw-bold font-extrabold lh-1 mb-3 text-7xl font-mono pl-8">CROSS-METRICS</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="p-10">
      <div class="flex justify-center items-center">
        <h1 class="font-bold font-mono text-white text-4xl pb-10">ÚLTIMOS EVENTOS</h1>
      </div>
      <livewire:lista-ultimos-eventos/>
      <div class="flex justify-end items center pt-4">
        <a class="text-white font-bold text-md items-end" href="{{route('lista-eventos.index')}}"><span class="text-white font-bold font-mono text-2xl">Todos los eventos</span><i class='bx bxs-chevrons-right'></i></a>
      </div>
    </section>
    <footer class="pt-10 pb-1 bg-white flex flex-col gap-4">
      <div class="flex justify-center">
        <a href="www.facebook.com" class="bg-transparent hover:bg-gray-800 text-gray-900 font-semibold hover:text-white p-2 border-2 border-gray-800 hover:border-transparent rounded-full text-lg flex align-middle"><i class='bx bxl-facebook'></i></a>
      </div>
      <div class="flex justify-center">
        <a class="mr-2" href="#">Política de privacidad</a>
        {{-- <a href="#">Política de privacidad</a> --}}
      </div>
    </footer>
</x-app-layout>

            
