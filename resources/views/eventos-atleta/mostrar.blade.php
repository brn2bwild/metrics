@extends('adminlte::page')

@section('css')
  @livewireStyles
@endsection

@section('content')
  <livewire:evento-participacion :evento="$evento"/>
  @livewireScripts
@stop

@section('js')
  <script>
    // window.addEventListener('swal:confirmarCategoria', event => {
    //   Swal.fire({
    //     title: event.detail.title,
    //     text: event.detail.text,
    //     icon: event.detail.icon,
    //     showDenyButton: true,
    //     confirmButtonText: 'Eliminar',
    //     denyButtonText: 'Cancelar',
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //   }).then((resultado) => {
    //     if(resultado.isConfirmed) { window.livewire.emit('eliminarCategoria', event.detail.id) }
    //   })
    // })

    window.addEventListener('swal:confirmarEliminar', event => {
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
        if(resultado.isConfirmed) { window.livewire.emit('eliminarParticipacion', event.detail.id) }
      })
    })

    window.addEventListener('swal:modal', event => {
      Swal.fire({
        title: event.detail.title,
        text: event.detail.text,
        icon: event.detail.icon,
        showConfirmButton: false,
        timer: 1500
      })
    })
  </script>
  <script>
    window.addEventListener('mostrarCategoriasModal', event => {
      $('#categoriasModal').modal('show')
    })

    window.addEventListener('cerrarCategoriasModal', event => {
      $('#categoriasModal').modal('hide')
    })

    // window.addEventListener('mostrarWodsModal', event => {
    //   $('#wodsModal').modal('show')
    // })

    // window.addEventListener('cerrarWodsModal', event => {
    //   $('#wodsModal').modal('hide')
    // })
    // $(function () {
    //   $('[data-toggle="tooltip"]').tooltip()
    // })
  </script>
@endsection