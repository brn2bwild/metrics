@extends('adminlte::page')

@section('title', 'Scores')

@section('css')
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  @livewireStyles
@endsection

@section('content')
  <livewire:scores-evento-organizador :evento="$evento"/>
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
  </script>
  <script>    
    // function buscarCategoria () {
    //   window.livewire.emit('buscarCategoria')
    // }
    
    window.addEventListener('mostrarModalAtletas', event => {
      $('#modalAtletas').modal('show')
    })

    // window.addEventListener('cerrarModalAtletas', event => {
    //   $('#modalAtletas').modal('hide')
    // })

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