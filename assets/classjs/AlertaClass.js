class AlertaClass {

  constructor(){
    this.swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });
  }

  crearAlertaEliminar(datos){
    var accion = this.swalWithBootstrapButtons.fire({
      title: datos['title'],
      text: datos['text'],
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, Eliminar!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        return true;
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        return false;
      }
    });
    return accion;
  }

  static alertaTop(message, status){
    Swal.fire({
      position: 'top-end',
      icon: status,
      title: message,
      showConfirmButton: false,
      timer: 1500
    })
  }

}
