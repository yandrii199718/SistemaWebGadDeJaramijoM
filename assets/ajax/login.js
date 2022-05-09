function VerificarUsuario(){
    var usu = $("usuario").val();
    var con = $("pass").val();
    if (usu.length== 0 || con.length== 0){
        return Swal.fire("Mensaje de Advertencia", "Llenne los campos vacios", "Warnig");    }
    alert("hola");

}