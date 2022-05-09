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
        "className": "btn",
        "title": "Reporte De Areas",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Areas",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        }
      },
      {
        "extend": "pdfHtml5",
        "text": "PDF",
        "titleAttr": "Exportar a PDF",
        "className": "btn",
        "title": "Reporte De Areas",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        },
        customize : function(doc){
            doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
            doc.content[1].table.widths = [90,410]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
        }
      },
      {
        "extend": "print",
        "text": "PRINT",
        "titleAttr": "Imprimir",
        "className": "btn",
        "title": "Reporte De Areas",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        },
      }

    ],
    "language": {
              "url": "/assets/Spanish.json"
    },
    "scrollX": true,
    "scrollY": "300px",
      "ajax": "/tablaAreas",
      "columns": [
           { "data": "id_area",
           "render": function (data, type, JsonResultRow, meta) {
             return data;
           }
          },
           { "data": "nombre_area" },
           {
               "data": 'id_area',
               "render": function (data, type, JsonResultRow, meta) {
                   return `<a href="#" data-id="${JsonResultRow.id_area}" class="btn btn-warning btn-editar-area" data-accion="edit" data-toggle="modal" data-target="#modalCrearArea">
                      <i class="fas fa-pencil-alt"></i>
                   </a>
                   <a href="#" class="btn btn-danger btn-eliminar-area" data-id="${JsonResultRow.id_area}">
                      <i class="fa fa-trash"></i>
                   </a>`
               }
           },
       ]
  } );
} );


//evento para editar un area
$(document).on("click", ".btn-editar-area", function(){
  var id = $(this).data('id');
  $('#titleModal').html('EDITAR AREA');
  vaciarErrores();
  editar = true;
  $.ajax({
    url: '/areas/'+id,
    type: 'get',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        //location.reload();
        //console.log(res);

        $('#formArea')[0].reset();

        $('#id_area').val(res.id_area);
        $('#nombre_area').val(res.nombre_area);

    }
  });
});

//evento para crear el area
$(document).on('click', '.btn-crear-area', function(){
  editar = false;
  $('#titleModal').html('CREAR AREA');
  vaciarErrores();
  $("#formArea")[0].reset();
  $('#id_area').val(0);
});

//evento para eliminar un provedor
$(document).on('click', '.btn-eliminar-area', function(){
  idArea = $(this).data('id');

  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el area!',
    'messageOk': 'Area eliminado con exito.',
    'messageNot': 'Area no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'areas/'+idArea,
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
$(document).on('submit', '#formArea', function(e){
  e.preventDefault();

  var message = 'Area guardado con exito :)';
  var url = '/areas';
  if(editar){
    message = 'Area Editado con exito :)';
    url = '/areas/update';
  }
  var formData = new FormData($('#formArea')[0]);
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
              $("#formArea")[0].reset();
              $('#modalCrearArea').modal('toggle');
          } else {
            var arrayErrores = res.errores;
            validar(arrayErrores);
          }

      }
  });
});
