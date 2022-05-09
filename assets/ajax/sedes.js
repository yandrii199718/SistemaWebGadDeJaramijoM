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
        "title": "Reporte De Dependencias",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1,2 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Dependencias",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1,2 ]
        }
      },
      {
        "extend": "pdfHtml5",
        "text": "PDF",
        "titleAttr": "Exportar a PDF",
        "className": "btn",
        "title": "Reporte De Dependencias",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1,2 ]
        },
        customize : function(doc){
            doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
            doc.content[1].table.widths = [90,210,200]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
        }
      },
      {
        "extend": "print",
        "text": "PRINT",
        "titleAttr": "Imprimir",
        "className": "btn",
        "title": "Reporte De Dependencias",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,1,2 ]
        },
      }

    ],
    "language": {
              "url": "/assets/Spanish.json"
    },
      "ajax": "/tablaSedes",
      "columns": [
           { "data": "id_sede",
           "render": function (data, type, JsonResultRow, meta) {
             return data;
           }
          },
           { "data": "nombre_sede" },
           { "data": "direccion" },
           { "data": "imagen_sede",
              "render": function (data, type, JsonResultRow, meta) {
                 return `<img class="btn-imagen" width="40" src="${(JsonResultRow.imagen_sede == 'no_image.jpg' || JsonResultRow.imagen_sede == '') ? "/assets/uploads/sedes/0/no_image.jpg" : "/assets/uploads/sedes/"+JsonResultRow.id_sede+"/"+JsonResultRow.imagen_sede }" data-id="${JsonResultRow.id_sede}" data-img="${JsonResultRow.imagen_sede}" data-toggle="modal" data-target="#modelImagen" />`;
             }
           },
           {
               "data": 'id_sede',
               "render": function (data, type, JsonResultRow, meta) {
                   return `<a href="#" data-id="${JsonResultRow.id_sede}" class="btn btn-warning btn-editar-sede" data-accion="edit" data-toggle="modal" data-target="#modalCrearSede">
                      <i class="fas fa-pencil-alt"></i>
                   </a>
                   <a href="#" class="btn btn-danger btn-eliminar-sede" data-id="${JsonResultRow.id_sede}">
                      <i class="fas fa-trash-alt"></i>
                   </a>`
               }
           },
       ]
  } );
} );


$(document).on('click', '.btn-imagen', function(){
  imagen = $(this).data('img');
  id = $(this).data('id');
  imgModal = $('#img-modal');
  urlImg = imgModal.attr('img');
  imgModal.attr('src', urlImg+'sedes/'+id+'/'+imagen);
})


//evento para editar un area
$(document).on("click", ".btn-editar-sede", function(){
  var id = $(this).data('id');
  $('#titleModal').html('EDITAR DEPENDENCIA');
  vaciarErrores();
  editar = true;
  $.ajax({
    url: '/sedes/'+id,
    type: 'get',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function (res) {
        //location.reload();
        console.log(res);

        $('#formSede')[0].reset();

        $('#id_sede').val(res.id_sede);
        $('#nombre_sede').val(res.nombre_sede);
        $('#direccion').val(res.direccion);

        var imagen = $('#imagen_sede').prev();
        imagen.html(res.imagen_sede);

    }
  });
});

//evento para crear el area
$(document).on('click', '.btn-crear-sede', function(){
  editar = false;
  $('#titleModal').html('CREAR DEPENDENCIA');
  vaciarErrores();
  $("#formSede")[0].reset();
  $('#id_sede').val(0);

  var imagen = $('#imagen_sede').prev();
  imagen.html("");
});

//evento para eliminar un provedor
$(document).on('click', '.btn-eliminar-sede', function(){
  idSede = $(this).data('id');

  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el Dependencia!',
    'messageOk': 'Dependencia eliminado con exito.',
    'messageNot': 'Dependencia no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'sedes/'+idSede,
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
$(document).on('submit', '#formSede', function(e){
  e.preventDefault();

  var message = 'Dependencia guardado con exito :)';
  var url = '/sedes';
  if(editar){
    message = 'Dependencia Editado con exito :)';
    url = '/sedes/update';
  }
  var formData = new FormData($('#formSede')[0]);
  $.ajax({
      url: url,
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
          //location.reload();
          console.log(res);

          if (res.status == "success") {
              table.ajax.reload();
              AlertaClass.alertaTop(message, 'success');
              $("#formSede")[0].reset();
              $('#modalCrearSede').modal('toggle');
          } else {
            var arrayErrores = res.errores;
            validar(arrayErrores);
          }

      }
  });
});
