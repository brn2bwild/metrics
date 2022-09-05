@extends('adminlte::page')

@section('css')
  @livewireStyles
@endsection

@section('content')
  <livewire:editar-eventos-organizador :evento="$evento"/>
  @livewireScripts
@stop

@section('js')
  <script>
    // window.addEventListener('swal:eventoGuardado', event => {
    //   Swal.fire({
    //     position: 'center',
    //     icon: 'success',
    //     title: 'Evento guardado con éxito',
    //     showConfirmButton: false,
    //     timer: 1500
    //   })
    //   window.setTimeout(() => {
    //     location.reload()
    //   }, 1500);
    // })

    // window.addEventListener('swal:imgGuardada', event => {
    //   Swal.fire({
    //     position: 'center',
    //     icon: 'success',
    //     title: '¡Imagen guardada!',
    //     showConfirmButton: false,
    //     timer: 1500
    //   })
    //   window.setTimeout(() => {
    //     location.reload()
    //   }, 1500);
    // })

    // window.addEventListener('swal:eliminarImg', event => {
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
    //     if(resultado.isConfirmed) {
    //       window.livewire.emit('eliminarImg', event.detail.id)
    //       Swal.fire({
    //         title: '¡Imágen eliminada!',
    //         text: '',
    //         icon: 'success',
    //         showConfirmButton: false,
    //         time: 1500
    //       })
    //       window.setTimeout(() => {
    //         location.reload()
    //       }, 1500);
    //     }
    //   })
    // })

    // window.addEventListener('swal:categoriaGuardada', event => {
    //   Swal.fire({
    //     position: 'center',
    //     icon: 'success',
    //     title: 'Categoría guardada con éxito',
    //     showConfirmButton: false,
    //     timer: 1500
    //   })
    //   window.setTimeout(() => {
    //     location.reload()
    //   }, 1500);
    // })

    window.addEventListener('swal:confirmarCategoria', event => {
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
        if(resultado.isConfirmed) { window.livewire.emit('eliminarCategoria', event.detail.id) }
      })
    })

    window.addEventListener('swal:confirmarWod', event => {
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
        if(resultado.isConfirmed) { window.livewire.emit('eliminarWod', event.detail.id) }
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

    window.addEventListener('mostrarWodsModal', event => {
      $('#wodsModal').modal('show')
    })

    window.addEventListener('cerrarWodsModal', event => {
      $('#wodsModal').modal('hide')
    })
    // $(function () {
    //   $('[data-toggle="tooltip"]').tooltip()
    // })
  </script>
@endsection