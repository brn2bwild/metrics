@extends('adminlte::page')

@section('title', 'Eventos')

{{-- @section('content_header')
    
@stop --}}

@section('css')
  @livewireStyles
@endsection

@section('content')
  <livewire:eventos-organizador/>
  @livewireScripts
@stop

@section('js')
  <script>
    window.addEventListener('eventoGuardado', event => {
      $('#modalEvento').modal('hide');

      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Evento registrado con éxito',
        showConfirmButton: false,
        timer: 1500
      })
    });

    function confirmarEliminar(url) {
      Swal.fire({
        title: '¿Deseas eliminar el evento?',
        text: "¡Esta acción no se podrá revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Borrar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.livewire.emit('eliminar', url)
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Evento borrado con éxito',
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
    }
  </script>
@endsection