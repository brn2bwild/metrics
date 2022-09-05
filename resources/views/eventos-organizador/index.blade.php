@extends('adminlte::page')

@section('title', 'Eventos')

@section('css')
  @livewireStyles
@endsection

@section('content')
  <livewire:eventos-organizador/>
@stop

@section('js')
  @livewireScripts
  <script>
    window.addEventListener('swal:modal', event => {
      Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showConfirmButton: false,
        timer: 1500
      })
    })

    window.addEventListener('swal:confirmarImagen', event => {
      Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showDenyButton: true,
        confirmButtonText: 'Eliminar',
        denyButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then((resultado) => {
        if(resultado.isConfirmed) { window.livewire.emit('eliminarImagenEvento') }
      })
    })

    window.addEventListener('swal:confirmarEvento', event => {
      Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showDenyButton: true,
        confirmButtonText: 'Eliminar',
        denyButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      }).then((resultado) => {
        if(resultado.isConfirmed) { window.livewire.emit('eliminarEvento') }
      })
    })

    // function confirmarEliminar(url) {
    //   Swal.fire({
    //     title: '¿Deseas eliminar el evento?',
    //     text: "¡Esta acción no se podrá revertir!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Borrar'
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       window.livewire.emit('eliminar', url)
    //       Swal.fire({
    //         position: 'center',
    //         icon: 'success',
    //         title: 'Evento borrado con éxito',
    //         showConfirmButton: false,
    //         timer: 1500
    //       })
    //     }
    //   })
    // }
  </script>
  <script>
    window.addEventListener('mostrarModalImagenEvento', event => {
      $('#modalImagenEvento').modal('show')
    })

    window.addEventListener('cerrarModalImagenEvento', event => {
      $('#modalImagenEvento').modal('hide')
    })

    window.addEventListener('mostrarModalEvento', event => {
      $('#modalEvento').modal('show')
    })

    window.addEventListener('cerrarModalEvento', event => {
      $('#modalEvento').modal('hide')
    })

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@endsection