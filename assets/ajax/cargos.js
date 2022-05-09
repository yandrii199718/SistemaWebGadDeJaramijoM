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
        "title": "Reporte De Cargos",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Cargos",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1 ]
        }
      },
      {
        "extend": "pdfHtml5",
        "text": "PDF",
        "titleAttr": "Exportar a PDF",
        "className": "btn",
        "title": "Reporte De Cargos",
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
        "title": "Reporte De Cargos",
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
      "ajax": "/tablaCargos",
      "columns": [
           { "data": "id_cargo",
           "render": function (data, type, JsonResultRow, meta) {
             return data;
           }
          },
           { "data": "nombre_cargo" },
           {
               "data": 'id_area',
               "render": function (data, type, JsonResultRow, meta) {
                   return `<a href="#" data-id="${JsonResultRow.id_cargo}" class="btn btn-warning btn-editar-cargo" data-accion="edit" data-toggle="modal" data-target="#modalCrearCargo">
                      <i class="fas fa-pencil-alt"></i>
                   </a>
                   <a href="#" class="btn btn-danger btn-eliminar-cargo" data-id="${JsonResultRow.id_cargo}">
                      <i class="fa fa-trash"></i>
                   </a>`
               }
           },
       ]
  } );
} );


//evento para editar un area
$(document).on("click", ".btn-editar-cargo", function(){
  var id = $(this).data('id');
  $('#titleModal').html('EDITAR CARGO');
  vaciarErrores();
  editar = true;
  $.ajax({
    url: '/cargos/'+id,
    type: 'get',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        //location.reload();
        //console.log(res);

        $('#formCargo')[0].reset();

        $('#id_cargo').val(res.id_cargo);
        $('#nombre_cargo').val(res.nombre_cargo);

    }
  });
});

//evento para crear el area
$(document).on('click', '.btn-crear-cargo', function(){
  editar = false;
  $('#titleModal').html('CREAR CARGO');
  vaciarErrores();
  $("#formCargo")[0].reset();
  $('#id_cargo').val(0);
});

//evento para eliminar un provedor
$(document).on('click', '.btn-eliminar-cargo', function(){
  idCargo = $(this).data('id');

  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el Cargo!',
    'messageOk': 'Cargo eliminado con exito.',
    'messageNot': 'Cargo no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'cargos/'+idCargo,
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
$(document).on('submit', '#formCargo', function(e){
  e.preventDefault();

  var message = 'Cargo guardado con exito :)';
  var url = '/cargos';
  if(editar){
    message = 'Cargos Editado con exito :)';
    url = '/cargos/update';
  }
  var formData = new FormData($('#formCargo')[0]);
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
              $("#formCargo")[0].reset();
              $('#modalCrearCargo').modal('toggle');
          } else {
            var arrayErrores = res.errores;
            validar(arrayErrores);
          }

      }
  });
});
