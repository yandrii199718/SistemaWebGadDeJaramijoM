//document.write("<script type='text/javascript' src='/assets/classjs/AlertaClass.js'></script>");
let editar = false;
let rol = $('#input_rol').val();
let rol_a = $('#input_rol_a').val();

$(document).ready(function() {
  table = $('#example').DataTable( {
    dom: 'Bfrtip',
    buttons: [
      {
        "extend": "csvHtml5",
        "text": "CSV",
        "titleAttr": "Exportar a csv",
        "className": "btn",
        "title": "Reporte De Herramientas",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Herramientas",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        }
      },
      {
        "extend": "pdfHtml5",
        "text": "PDF",
        "orientation": 'landscape',
        "titleAttr": "Exportar a PDF",
        "className": "btn",
        "title": "Reporte De Herramientas",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        },
        customize : function(doc){
            doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
            doc.content[1].table.widths = [30,60,80,150,140,90,80,80,80]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
        }
      },
      {
        "extend": "print",
        "text": "PRINT",
        "titleAttr": "Imprimir",
        "className": "btn",
        "title": "Reporte De Herramientas",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        },
      }

    ],
    "language": {
              "url": "/assets/Spanish.json"
    },
    "scrollX": true,
    "scrollY": "250px",
      "ajax": "/tablaHerramientas",
      "columns": [
           { "data": "id_herramienta",
           "render": function (data, type, JsonResultRow, meta) {
             return data;
           }
          },
           {
               "data": 'id_herramienta',
               "render": function (data, type, JsonResultRow, meta) {
                 html = `<div class="table-action">
                 <div class="dropdown">
                    <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acción <i class="fas fa-cog"></i> 
                    </a>


                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                          <a class="dropdown-item btn-editar"  href="javascript:void(0);" data-id="${JsonResultRow.id_herramienta}" data-accion="edit" data-toggle="modal" data-target="#modelCrear">
                            <i class="fas fa-edit"></i> Editar
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-ver" href="javascript:void(0);" data-id="${JsonResultRow.id_herramienta}">
                            <i class="far fa-eye"></i> Ver
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-eliminar" href="javascript:void(0);" data-id="${JsonResultRow.id_herramienta}">
                            <i class="fas fa-trash-alt"></i> Eliminar
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-imagen" href="javascript:void(0);" data-img="${JsonResultRow.imagen}" data-id="${JsonResultRow.id_herramienta}" data-toggle="modal" ${(JsonResultRow.imagen == null)? '' : 'data-target="#modelImagen"'}>
                            <i class="fas fa-file-image"></i> Img
                          </a>
                        </li>
                      </ul>

                    </div>
                  </div>`;
                   return html;
               }
           },
           { "data": "codigo" },
           { "data": "sbn" },
           { "data": "nombre_herramienta" },
           { "data": "observacion" },
           { "data": "nombre_marca" },
           { "data": "nombre_area" },
           { "data": "nombre_sede" },
       ]
  } );
} );

//ver descripcion
$(document).on("click", ".btn-ver", function(){
  id = $(this).data('id');
  $('#modalVerOrden').modal('toggle');
  $.ajax({
      url: '/herramientas/'+id,
      method: "get",
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
        //  console.log(res);
          if(res == null){

          } else {
            $('#title-ver-orden').html("HERRAMIENTA");
            contenedor = `
              <div class="card border-secondary mx-auto mb-3" style="max-width: 45rem;">
                <div class="card-header text-center">
                <h3 class="font-weight-bold">
                  ${res[0].nombre_herramienta}
                  </h3>
                </div>
                <div class="card-body text-secondary">
                  <div class="row">
                    <div class="col-12">
                      <p class="card-text">
                          <span class="font-weight-bold">Id:</span>
                          ${res[0].id_herramienta}
                      </p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">
                          <span class="font-weight-bold">Codigo:</span>
                          ${res[0].codigo}
                      </p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">
                          <span class="font-weight-bold">SBN:</span>
                          ${res[0].sbn}
                      </p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">
                          <span class="font-weight-bold">Nombre Herramienta:</span>
                          ${res[0].nombre_herramienta}
                      </p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">
                          <span class="font-weight-bold">Observación:</span>
                          ${res[0].observacion}
                      </p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">
                          <span class="font-weight-bold">Cite:</span>
                          ${res[0].nombre_sede}
                      </p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">
                          <span class="font-weight-bold">Imagen: </span><br>
                          ${(res[0].imagen == "" || res[0].imagen == null) ? 'Herramienta sin imagen' : '<img width="100" src="/assets/uploads/herramientas/'+res[0].id_herramienta+'/'+res[0].imagen+'" />'}
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

//ver imagen en un modal
$(document).on('click', '.btn-imagen', function(){
  imagen = $(this).data('img');
  id = $(this).data('id');
  imgModal = $('#img-modal');
  urlImg = imgModal.attr('img');
  imgModal.attr('src', urlImg+'herramientas/'+id+'/'+imagen);
})

//evento para editar un area
$(document).on("click", ".btn-editar", function(){
  var id = $(this).data('id');
  $('#titleModal').html('EDITAR SOFTWARE');
  vaciarErrores();
  editar = true;
  $.ajax({
    url: '/herramientas/'+id,
    type: 'get',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        //location.reload();
        //console.log(res);
        $('#formulario')[0].reset();
        $('#sbn').val(res[0].sbn);
        $('#codigo').val(res[0].codigo);
        $('#id_herramienta').val(res[0].id_herramienta);
        $('#nombre_herramienta').val(res[0].nombre_herramienta);

        $("#idmarca option[value="+ res[0].idmarca +"]").attr("selected",true);
        $("#idarea option[value="+ res[0].idarea +"]").attr("selected",true);
        $("#idsede option[value="+ res[0].idsede +"]").attr("selected",true);
        if(rol != rol_a)
          $('#idsede').attr('disabled', true);

        $('#observacion').val(res[0].observacion);

    }
  });
});

//evento para crear el area
$(document).on('click', '.btn-guardar', function(){
  editar = false;
  $('#titleModal').html('CREAR SOFTWARE');
  vaciarErrores();
  $("#formulario")[0].reset();

  if(rol != rol_a){
    var idsede = $('#header_sede').data('id');
    $("#idsede option[value="+ idsede +"]").attr("selected",true);
    $('#idsede').attr('disabled', true);
  }

  $('#id_herramienta').val(0);
});

//evento para eliminar un provedor
$(document).on('click', '.btn-eliminar', function(){
  id = $(this).data('id');

  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el Software!',
    'messageOk': 'Software eliminado con exito.',
    'messageNot': 'Software no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'herramientas/'+id,
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
$(document).on('submit', '#formulario', function(e){
  e.preventDefault();

  var message = 'Software guardada con exito :)';
  var url = '/herramientas';
  if(editar){
    message = 'Software Editada con exito :)';
    url = '/herramientas/update';
  }
  var formData = new FormData($('#formulario')[0]);
  $.ajax({
      url: url,
      type: 'post', // Para jQuery < 1.9
      method: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
          //location.reload();
          //console.log(res);

          if (res.status == "success") {
              table.ajax.reload();
              AlertaClass.alertaTop(message, 'success');
              $("#formulario")[0].reset();
              $('#modelCrear').modal('toggle');
          } else {
            var arrayErrores = res.errores;
            validar(arrayErrores);
          }

      }
  });
});
