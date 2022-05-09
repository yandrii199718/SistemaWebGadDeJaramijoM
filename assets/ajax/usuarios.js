//document.write("<script type='text/javascript' src='/assets/classjs/AlertaClass.js'></script>");
/**
 * Variables globales de usuario
 */
 let editar = false;

 $(document).ready(function() {
   table = $('#example').DataTable( {
     dom: 'Bfrtip',
     buttons: [
       {
         "extend": "csvHtml5",
         "text": "CSV",
         "titleAttr": "Exportar a csv",
         "className": "btn",
         "title": "Reporte Usuarios",
         "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
         columns: [ 0,2,3,4,5,6,7,8,9 ]
         }
       },
       {
         "extend": "excelHtml5",
         "text": "EXCEL",
         "titleAttr": "Exportar a excel",
         "className": "btn",
         "title": "Reporte Usuarios",
         "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
         columns: [ 0,2,3,4,5,6,7,8,9 ]
         }
       },
       {
         "extend": "pdfHtml5",
         "text": "PDF",
         "orientation": 'landscape',
         "titleAttr": "Exportar a PDF",
         "className": "btn",
         "title": "Reporte Usuarios",
         exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
         columns: [ 0,2,3,4,5,6,7,8,9 ]
         },
         customize : function(doc){
             doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
             doc.content[1].table.widths = [20,60,60,100,60,130,90,90,90]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
         }
       },
       {
         "extend": "print",
         "text": "PRINT",
         "titleAttr": "Imprimir",
         "className": "btn",
         "title": "Reporte Usuarios",
         exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
         columns: [ 0,2,3,4,5,6,7,8,9 ]
         },
       }
 
     ],
     "language": {
               "url": "/assets/Spanish.json"
     },
     "lengthMenu": false, 
     "bLengthChange": false,
      "responsive": true,
     "scrollX": true,
     "scrollY": "300px",
     "order": [[ 0, 'asc' ]],
       "ajax": "/tablaUsuarios",
       "columns": [
            { "data": "id_usuario",
               "render": function(data, type, JsonResultRow, meta){
                 return meta.row + 1;
 
               }
            },
            {
                "data": 'id_usuario',
                "render": function (data, type, JsonResultRow, meta) {
                  html = `<div class="table-action">
                  <div class="dropdown">
                    
                     <a class="btn btn-primary btn-sm dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acción <i class="fas fa-cog">
                   </i></a>
 
 
                       <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                         <li>
                           <a class="dropdown-item btn-editar-usuario" href="javascript:void(0);" data-id="${JsonResultRow.id_usuario}" data-accion="edit" data-toggle="modal" data-target="#modalCrearUsuario">
                             <i class="fas fa-edit"></i> Editar
                           </a>
                         </li>
                         <li>
                           <a class="dropdown-item btn-ver" href="javascript:void(0);" data-id="${JsonResultRow.id_usuario}">
                             <i class="far fa-eye"></i> Ver
                           </a>
                         </li>
                         <li>
                           <a class="dropdown-item btn-eliminar-usuario" href="javascript:void(0);" data-id="${JsonResultRow.id_usuario}">
                             <i class="fas fa-trash-alt"></i> Eliminar
                           </a>
                         </li>
                       </ul>
 
                     </div>
                   </div>`;
                    return html;
                }
            },
            { "data": "usuario" },
            { "data": "dni" },
            { "data": "nombres" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "nombre_cargo" },
            { "data": "nombre_area" },
            { "data": "nombre_sede" }
 
        ]
   } );
 
 } );
 
 
 
 //ver descripcion
 $(document).on("click", ".btn-ver", function(){
   id = $(this).data('id');
   $('#modalVerOrden').modal('toggle');
   $.ajax({
       url: '/usuarios/'+id,
       method: "get",
       cache: false,
       contentType: false,
       processData: false,
       dataType: 'json',
       success: function (res) {
           //console.log(res);
           if(res == null){
 
           } else {
             $('#title-ver-orden').html("USUARIOS");
             contenedor = `
               <div class="card border-secondary mx-auto mb-3" style="max-width: 45rem;">
                 <div class="card-header text-center">
                 <h3 class="font-weight-bold">
                   ${res[0].nombres}
                   </h3>
                 </div>
                 <div class="card-body text-secondary">
                   <div class="row">
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Id:</span>
                           ${res[0].id_usuario}
                       </p>
                     </div>
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Usuario:</span>
                           ${res[0].usuario}
                       </p>
                     </div>
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Nombres:</span>
                           ${res[0].nombres}
                       </p>
                     </div>
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Teléfono:</span>
                           ${res[0].telefono}
                       </p>
                     </div>
 
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Correo: </span>
                           ${res[0].email}
                       </p>
                     </div>
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Area:</span>
                           ${res[0].nombre_area}
                       </p>
                     </div>
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Cargo:</span>
                           ${res[0].nombre_cargo}
                       </p>
                     </div>
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Dependencia:</span>
                           ${res[0].nombre_sede}
                       </p>
                     </div>
 
                     <div class="col-12 col-md-6">
                       <p class="card-text">
                           <span class="font-weight-bold">Estado: </span>
                           ${(res[0].estado == 0) ? 'Activo' : 'Inactivo'}
                       </p>
 
                     </div>
 
                     <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                     <hr />
                       <p class="card-text">
                           <span class="font-weight-bold">Imagen: </span><br>
 
                             ${(res[0].imagen == "no_image.jpg") ? '<img width="200" src="/assets/uploads/usuarios/0/'+res[0].imagen+'"' : '<img width="100" src="/assets/uploads/usuarios/'+res[0].id_usuario+'/'+res[0].imagen+'" />'}
 
                       </p>
                     </div>
 
                   </div>
 
 
                 </div>
               </div>
             `;
             $('#contenedor-orden').html(contenedor);
           }
       }
   });
 })
 
 
 
 
 
 
 //evento para editar un usuario
 $(document).on("click", ".btn-editar-usuario", function(){
   var id = $(this).data('id');
   $('#titleModal').html('EDITAR USUARIO');
   vaciarErrores();
   editar = true;
   $.ajax({
     url: '/usuarios/'+id,
     type: 'get',
     contentType: false,
     processData: false,
     dataType: 'json',
     success: function (res) {
         //location.reload();
         //console.log(res);
 
         $('#formUsuario')[0].reset();
 
         $('#id_usuario').val(res[0].id_usuario);
         $('#usuario').val(res[0].usuario);
         $('#dni').val(res[0].dni);
         $('#nombres').val(res[0].nombres);
         $('#telefono').val(res[0].telefono);
         $('#email').val(res[0].email);
 
         var imagen = $('#imagen').prev();
         imagen.html(res[0].imagen);
         //$('#cargo').val(res[0].nombre_cargo);
         $("#idcargo option[value="+ res[0].idcargo +"]").attr("selected",true);
         $("#idarea option[value="+ res[0].idarea +"]").attr("selected",true);
         $("#idsede option[value="+ res[0].idsede +"]").attr("selected",true);
 
     }
   });
 });
 
 //evento al precionar en crear usuarios
 $(document).on('click', '.btn-crear-usuario', function(){
   editar = false;
   $('#titleModal').html('CREAR USUARIO');
   vaciarErrores();
   $('#formUsuario')[0].reset();
   $("#idsede").val(0);
   $("#idcargo").val(0);
   $("#idarea").val(0);
   $('#id_usuario').val(0);
 });
 
 //evento para eliminar un usuario
 $(document).on('click', '.btn-eliminar-usuario', function(){
   idUsuario = $(this).data('id');
 
   var alerta = new AlertaClass();
   datos = {
     'title': 'Esta seguro?',
     'text': 'Si quiero eliminar el usuario!',
     'messageOk': 'Usuario eliminado con exito.',
     'messageNot': 'Usuario no eliminado :)',
   }
   var estado = alerta.crearAlertaEliminar(datos);
 
   estado.then(function(res){
     if(res){
       $.ajax({
         url: 'usuarios/delete/'+idUsuario,
         type: 'delete',
         success: function (res) {
           //console.log(res);
         }
       })
       AlertaClass.alertaTop(datos['messageOk'], 'success');
       table.ajax.reload();
     } else {
       AlertaClass.alertaTop(datos['messageNot'], 'error');
     }
   });
 
 });
 
 //evento submit para guardar o editar datos
 $(document).on('submit', '#formUsuario', function(e){
   e.preventDefault();
   var message = 'Usuario guardado con exito :)';
   var url = '/usuarios';
   if(editar){
     message = 'Usuario Editado con exito :)';
     url = '/usuarios/update';
   }
   var formData = new FormData($('#formUsuario')[0]);
   $.ajax({
       url: url,
       type: 'post',
       data: formData,
       contentType: false,
       processData: false,
       dataType: 'json',
       success: function (res) {
           //location.reload();
 
 
           if (res.status == "success") {
               table.ajax.reload();
               AlertaClass.alertaTop(message, 'success');
               $("#formUsuario")[0].reset();
               $('#modalCrearUsuario').modal('toggle');
               setTimeout(function(){ location.reload(); }, 1000);
 
           } else {
             console.log(res.errores);
             var arrayErrores = res.errores;
             validar(arrayErrores);
           }
 
       }
   });
 });
 