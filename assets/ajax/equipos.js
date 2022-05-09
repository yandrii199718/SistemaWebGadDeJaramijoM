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
        "title": "Reporte De Equipos",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8,9 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Equipos",
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
        "title": "Reporte De Equipos",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8,9 ]
        },
        customize : function(doc){
            doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
            doc.content[1].table.widths = [30,60,80,80,60,140,80,80,90]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
        }
      },
      {
        "extend": "print",
        "text": "PRINT",
        "titleAttr": "Imprimir",
        "className": "btn",
        "title": "Reporte De Equipos",
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
    "scrollY": "400px",
      "ajax": "/tablaEquipos",
      "columns": [
           { "data": "id_equipo",
               "render": function (data, type, JsonResultRow, meta) {
                 return data;
               }
            },
           {
               "data": 'id_equipo',
               "render": function (data, type, JsonResultRow, meta) {
                 html = `<div class="table-action">
                 <div class="dropdown">
                    <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Acción<i class="fas fa-cog"></i>
                    </a>


                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                          <a class="dropdown-item btn-editar"  href="javascript:void(0);" data-id="${JsonResultRow.id_equipo}" data-accion="edit" data-toggle="modal" data-target="#modelCrear">
                            <i class="fas fa-edit"></i> Editar
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-ver" href="javascript:void(0);" data-id="${JsonResultRow.id_equipo}">
                            <i class="far fa-eye"></i> Ver
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-eliminar" href="javascript:void(0);" data-id="${JsonResultRow.id_equipo}">
                            <i class="fas fa-trash-alt"></i> Eliminar
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-pdf" href="${(JsonResultRow.manual == null) ? 'javascript:void(0);': JsonResultRow.manual}" target="${(JsonResultRow.manual == null) ? '': '_blank'}" data-id="${JsonResultRow.id_equipo}">
                            <i class="fas fa-file-pdf"></i> Pdf
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-imagen" href="javascript:void(0);" data-img="${JsonResultRow.imagen}" data-id="${JsonResultRow.id_equipo}" data-toggle="modal" ${(JsonResultRow.imagen == null)? '' : 'data-target="#modelImagen"'}>
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
           { "data": "nombre_equipo" },
            { "data": "modelo" },
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
      url: '/equipos/'+id,
      method: "get",
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
          //console.log(res);
          if(res == null){

          } else {
            $('#title-ver-orden').html("EQUIPO");
            contenedor = `
              <div class="card border-secondary mx-auto mb-3" style="max-width: 45rem;">
                <div class="card-header text-center">
                <h3 class="font-weight-bold">
                  ${res[0].nombre_equipo}
                  </h3>
                </div>
                <div class="card-body text-secondary">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Id:</span>
                          ${res[0].id_equipo}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Codigo:</span>
                          ${res[0].codigo}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">SBN:</span>
                          ${res[0].sbn}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Nombre Equipo:</span>
                          ${res[0].nombre_equipo}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Modelo:</span>
                          ${res[0].modelo}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Observación:</span>
                          ${res[0].observacion}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Marca:</span>
                          ${res[0].nombre_marca}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Cite:</span>
                          ${res[0].nombre_sede}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Area: </span>
                          ${res[0].nombre_area}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Manual: </span>
                          ${ (res[0].manual == "") ? 'No cuenta con manual' : '<a href="'+res[0].manual+'" target="-blank">Ver</a>'}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Imagen: </span><br>
                          ${(res[0].imagen == "") ? 'Equipo sin imagen' : '<img width="100" src="/assets/uploads/equipos/img/'+res[0].id_equipo+'/'+res[0].imagen+'" />'}
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


//evento para editar un area
$(document).on("click", ".btn-editar", function(){
  var id = $(this).data('id');
  $('#titleModal').html('EDITAR EQUIPO');
  vaciarErrores();
  editar = true;
  $.ajax({
    url: '/equipos/'+id,
    type: 'get',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        //location.reload();
        //console.log(res);

        $('#formulario')[0].reset();
        $('#sbn').val(res[0].sbn);
        $('#id_equipo').val(res[0].id_equipo);
        $('#nombre_equipo').val(res[0].nombre_equipo);
        $('#modelo').val(res[0].modelo);
        $('#codigo').val(res[0].codigo);
        $('#codigo').attr('disabled','true');

        $('#manual').val(res[0].manual);


        imagen = $('#imagen').prev();
        imagen.html(res[0].imagen);

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
  $('#titleModal').html('CREAR EQUIPO');
  vaciarErrores();
  $("#formulario")[0].reset();
  $('#id_equipo').val(0);

  if(rol != rol_a){
    var idsede = $('#header_sede').data('id');
    $("#idsede option[value="+ idsede +"]").attr("selected",true);
    $('#idsede').attr('disabled', true);
  }

});

//evento para eliminar un provedor
$(document).on('click', '.btn-eliminar', function(){
  id = $(this).data('id');

  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el Equipo!',
    'messageOk': 'Equipo eliminado con exito.',
    'messageNot': 'Equipo no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'equipos/'+id,
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

$(document).on('click', '.btn-imagen', function(){
  imagen = $(this).data('img');
  id = $(this).data('id');
  imgModal = $('#img-modal');
  urlImg = imgModal.attr('img');
  imgModal.attr('src', urlImg+'equipos/img/'+id+'/'+imagen);
})


//evento submit para guardar o editar datos
$(document).on('submit', '#formulario', function(e){
  e.preventDefault();

  var message = 'Equipo guardado con exito :)';
  var url = '/equipos';
  if(editar){
    message = 'Equipo Editado con exito :)';
    url = '/equipos/update';
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
        //  console.log(res);

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
