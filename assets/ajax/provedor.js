//document.write("<script type='text/javascript' src='/assets/classjs/AlertaClass.js'></script>");
let editar = false;
$(document).ready(function() {
  table = $('#example').DataTable( {
    dom: 'Bfrtip',
    buttons: [
      {
        "extend": "csvHtml5",
        "text": "CSV",
        "titleAttr": "Exportar a csv",
        "className": "btn ",
        "title": "Reporte De Proveedores",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 1,2,3,4,5,6,7]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Proveedores",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 1,2,3,4,5,6,7]
        }
      },
      {
        "extend": "pdfHtml5",
        "text": "PDF",
        "orientation": 'landscape',
        "titleAttr": "Exportar a PDF",
        "className": "btn",
        "title": "Reporte De Proveedores",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 1,2,3,4,5,6,7]
        },
        customize : function(doc){
            doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
            doc.content[1].table.widths = [80,100,100,100,80,110,100]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
        }
      },
      {
        "extend": "print",
        "text": "PRINT",
        "titleAttr": "Imprimir",
        "className": "btn",
        "title": "Reporte De Proveedores",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 1,2,3,4,5,6,7 ]
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
      "ajax": "/tablaProvedor",
      "columns": [
           {
               "data": 'id_provedor',
               "render": function (data, type, JsonResultRow, meta) {
                 html = `<div class="table-action">
                 <div class="dropdown">
                   
                    <a class="btn btn-primary btn-sm dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acción
                    <i class="fas fa-cog">
                    </i>
                  </a>

                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                          <a class="dropdown-item  btn-editar-provedor" href="javascript:void(0);" data-id="${JsonResultRow.id_provedor}" data-accion="edit" data-toggle="modal" data-target="#modalCrearCliente">
                            <i class="fas fa-edit"></i> Editar
                          </a>

                        </li>
                        <li>
                          <a class="dropdown-item btn-ver" href="javascript:void(0);" data-id="${JsonResultRow.id_provedor}">
                            <i class="far fa-eye"></i> Ver
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-eliminar-provedor" href="javascript:void(0);" data-id="${JsonResultRow.id_provedor}">
                            <i class="fas fa-trash-alt"></i> Eliminar
                          </a>
                        </li>
                      </ul>

                    </div>
                  </div>`;
                   return html;
               }
           },
           { "data": "ruc" },
           { "data": "razon_social" },
           { "data": "rubro" },
           { "data": "direccion" },
           { "data": "telefono" },
           { "data": "email" },
           { "data": "tipo" },
       ]
  } );
} );

//ver descripcion
$(document).on("click", ".btn-ver", function(){
  id = $(this).data('id');
  $('#modalVerOrden').modal('toggle');
  $.ajax({
      url: '/provedor/'+id,
      method: "get",
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
          console.log(res);
          if(res == null){

          } else {
            $('#title-ver-orden').html("PROVEEDOR");
            contenedor = `
              <div class="card border-secondary mx-auto mb-3" style="max-width: 45rem;">
                <div class="card-header text-center">
                <h3 class="font-weight-bold">
                  ${res.razon_social}
                  </h3>
                </div>
                <div class="card-body text-secondary">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Id:</span>
                          ${res.id_provedor}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">RUC:</span>
                          ${res.ruc}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Razon Social:</span>
                          ${res.razon_social}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Rubro:</span>
                          ${res.rubro}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Dirección:</span>
                          ${res.direccion}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Telefono:</span>
                          ${res.telefono}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Contacto:</span>
                          ${res.contacto}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Celular: </span>
                          ${res.celular}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Correo: </span>
                          ${res.email}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Tipo Provedor: </span>
                          ${res.tipo}
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
$(document).on("click", ".btn-editar-provedor", function(){
  var id = $(this).data('id');
  $('#titleModal').html('EDITAR PROVEEDOR');
  vaciarErrores();
  editar = true;
  $.ajax({
    url: '/provedor/'+id,
    type: 'get',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        //location.reload();
        console.log(res);

        $('#formProvedor')[0].reset();

        $('#id_provedor').val(res.id_provedor);
        $('#ruc').val(res.ruc);
        $('#razon_social').val(res.razon_social);
        $('#rubro').val(res.rubro);
        $('#direccion').val(res.direccion);
        $('#telefono').val(res.telefono);
        $('#contacto').val(res.contacto);
        $('#celular').val(res.celular);
        $('#email').val(res.email);
        //$('#cargo').val(res[0].nombre_cargo);
        $("#tipo option[value="+ res.tipo +"]").attr("selected",true);

    }
  });
});

//evento para crear el provedor
$(document).on('click', '.btn-crear-provedor', function(){
  editar = false;
  $('#titleModal').html('CREAR PROVEEDOR');
  vaciarErrores();
  $("#formProvedor")[0].reset();
  $('#id_provedor').val(0);
});

//evento para eliminar un provedor
$(document).on('click', '.btn-eliminar-provedor', function(){
  idProvedor = $(this).data('id');

  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el provedor!',
    'messageOk': 'Provedor eliminado con exito.',
    'messageNot': 'Provedor no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'provedor/'+idProvedor,
        type: 'delete',
        dataType: 'json',
        success: function (res) {
          if(res.status == 'success'){
            AlertaClass.alertaTop(datos['messageOk'], 'success');
            table.ajax.reload();
          } else {
            AlertaClass.alertaTop(datos['messageNot'], 'error');
            table.ajax.reload();
          }
        }
      })

    } else {
      AlertaClass.alertaTop(datos['messageNot'], 'error');
    }
  });

});


//evento submit para guardar o editar datos
$(document).on('submit', '#formProvedor', function(e){
  e.preventDefault();
  var message = 'Provedor guardado con exito :)';
  var url = '/provedor';
  if(editar){
    message = 'Provedor Editado con exito :)';
    url = '/provedor/update';
  }
  var formData = new FormData($('#formProvedor')[0]);
  $.ajax({
      url: url,
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
          //location.reload();
          //console.log(res);

          if (res.status == "success") {
              table.ajax.reload();
              AlertaClass.alertaTop(message, 'success');
              $("#formProvedor")[0].reset();
              $('#modalCrearCliente').modal('toggle');
          } else {
            var arrayErrores = res.errores;
            validar(arrayErrores);
          }

      }
  });
});
