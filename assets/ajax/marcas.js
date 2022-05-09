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
        "title": "Reporte De Marcas",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Marcas",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        }
      },
      {
        "extend": "pdfHtml5",
        "text": "PDF",
        "titleAttr": "Exportar a PDF",
        "className": "btn",
        "title": "Reporte De Marcas",
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
        "title": "Reporte De Marcas",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        },
      }

    ],
    "language": {
              "url": "/assets/Spanish.json"
    },
    "scrollX": true,
    "scrollY": "250px",
      "ajax": "/tablaMarcas",
      "columns": [
           { "data": "id_marca",
           "render": function (data, type, JsonResultRow, meta) {
             return data;
           }
          },
           { "data": "nombre_marca" },
           {
               "data": 'id_marca',
               "render": function (data, type, JsonResultRow, meta) {
                   return `<a href="#" data-id="${JsonResultRow.id_marca}" class="btn btn-warning btn-editar-marca" data-accion="edit" data-toggle="modal" data-target="#modalCrearMarca">
                      <i class="fas fa-pencil-alt"></i>
                   </a>
                   <a href="#" class="btn btn-danger btn-eliminar-marca" data-id="${JsonResultRow.id_marca}">
                      <i class="fa fa-trash"></i>
                   </a>`
               }
           },
       ]
  } );
} );


//evento para editar un area
$(document).on("click", ".btn-editar-marca", function(){
  var id = $(this).data('id');
  vaciarErrores();
  editar = true;
  $('#titleModal').html('EDITAR MARCA');

  $.ajax({
    url: '/marcas/'+id,
    type: 'get',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        //location.reload();
        //console.log(res);

        $('#formMarca')[0].reset();

        $('#id_marca').val(res.id_marca);
        $('#nombre_marca').val(res.nombre_marca);

    }
  });
});

//evento para crear el area
$(document).on('click', '.btn-crear-marca', function(){
  editar = false;
  vaciarErrores();
  $("#formMarca")[0].reset();
  $('#id_marca').val(0);
  $('#titleModal').html('CREAR MARCA');
});

//evento para eliminar un provedor
$(document).on('click', '.btn-eliminar-marca', function(){
  idMarca = $(this).data('id');

  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el marca!',
    'messageOk': 'Marca eliminado con exito.',
    'messageNot': 'Marca no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'marcas/'+idMarca,
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
$(document).on('submit', '#formMarca', function(e){
  e.preventDefault();

  var message = 'Marca guardado con exito :)';
  var url = '/marcas';
  if(editar){
    message = 'Marca Editado con exito :)';
    url = '/marcas/update';
  }
  var formData = new FormData($('#formMarca')[0]);
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
              $("#formMarca")[0].reset();
              $('#modalCrearMarca').modal('toggle');
          } else {
            var arrayErrores = res.errores;
            validar(arrayErrores);
          }

      }
  });
});
