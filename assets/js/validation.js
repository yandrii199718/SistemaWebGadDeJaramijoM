/**
 * Realizar una validacion por cada error que devuelve el ajax
 * clase de error invalid-feedback
 * clase que todo esta ok valid-feedback
 * clase para referirme y agregar las clases valid-input
 * clase para mostrar elemento d-block;
 */
function validar(arrayErrores){
  vaciarErrores();
  for (var key in arrayErrores) {

    if( $('#'+key).length > 0){
      //alert('elemento si existe');
      var elemento = $('#'+key).next('.valid-input');

      if(elemento.length == 0){
        elemento = $('#'+key).parent('.custom-file');
        elemento = elemento.next('.valid-input');
      }

      elemento.addClass('d-block');
      elemento.html(arrayErrores[key]);

      /*
      *En caso de no existir hay que llamar al padre custom-file
      *y despues llamar al sigiente elemento llamado .valid-input
       */

    }
  }

}

function vaciarErrores(){
  $('.valid-input').removeClass('d-block');
  $('.valid-input').html('');
}
