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
        "title": "Reporte De Ordenes",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Ordenes",
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
        "title": "Reporte De Ordenes",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        },
        customize : function(doc){
            doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
            doc.content[1].table.widths = [40,70,100,100,100,70,70,70]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
        }
      },
      {
        "extend": "print",
        "text": "PRINT",
        "titleAttr": "Imprimir",
        "className": "btn",
        "title": "Reporte De Ordenes",
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
      "ajax": "/tablaOrdenes",
      "columns": [
           { "data": "id_orden",
           "render": function (data, type, JsonResultRow, meta) {
             return data;
           }
         },
           {
               "data": 'id_orden',
               "render": function (data, type, JsonResultRow, meta) {
                 html = `<div class="table-action">
                 <div class="dropdown">
                    <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acción<i class="fas fa-cog"></i>
                    </a>


                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                          <a class="dropdown-item btn-editar"  href="javascript:void(0);" data-id="${JsonResultRow.id_orden}" data-accion="edit" data-toggle="modal" data-target="#modalOrden">
                            <i class="fas fa-edit"></i> Editar
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-ver-orden"  href="javascript:void(0);" data-id="${JsonResultRow.id_orden}">
                            <i class="fas fa-eye"></i> Ver
                          </a>
                        </li>
                        <!--
                        <li>
                          <a class="dropdown-item btn-eliminar" href="javascript:void(0);" data-id="${JsonResultRow.id_orden}">
                            <i class="fas fa-trash-alt"></i> Eliminar
                          </a>
                        </li>
                        -->
                      </ul>

                    </div>
                  </div>`;
                   return html;
               }
           },
           { "data": "fecha_orden" },
           { "data": "nro_orden" },
           { "data": "nombres" },
           { "data": "nombre_area" },
           { "data": "costo" },
           { "data": "horas_total" },
           { "data": "estado",
              "render": function (data, type, JsonResultRow, meta) {
                var html = 'Finalizado';
                if(JsonResultRow.estado == 0){
                  html = 'Pendente';
                }
                return html;
              }
          },
       ]
  } );
} );


$(document).on('click', '.btn-orden', function(){
  id = $(this).attr('id');
  editar = false;
  $('#idcronograma').val(id);
  vaciarErrores();
  $('#modalOrden').modal('toggle');
});


//editar orden
$(document).on('click', '.btn-editar', function(){
  id = $(this).data('id');
  editar = true;
  $.ajax({
      url: '/ordenes/'+ id+'/edit',
      method: "get",
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
        //  console.log(res);
          $('#titleModal').html('EDITAR ORDEN');
          $('#id_orden').val(res.id_orden);
          $('#nro_orden').val(res.nro_orden);
          $('#fecha_orden').val(res.fecha_orden);
          $('#costo').val(res.costo);
          $('#hora_inicio').val(res.hora_inicio);
          $('#hora_final').val(res.hora_final);
          $('#descripcion_servicio').val(res.descripcion_servicio);
          $('#repuestos_utilizados').val(res.repuestos_utilizados);

      }
  });

})

$(document).on("click", '.btn-ver-orden', function(){
  id = $(this).data('id');
  $('#modalVerOrden').modal('toggle');
  $.ajax({
      url: '/ordenes/'+ id,
      method: "get",
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
          //console.log(res);
          if(res == null){

          } else {
            $('#title-ver-orden').html("ORDEN");
            contenedor = `
              <div class="card border-secondary mx-auto mb-3" style="max-width: 45rem;">
                <div class="card-header text-center">Orden:
                  ${res.id_orden}
                  <a href="/reporteOrden/${res.id_orden}" target="_blank" class="float-right">Reporte</a>
                </div>
                <div class="card-body text-secondary">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <p class="card-text">Id: ${res.id_orden}</p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">Numero orden: ${res.nro_orden}</p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">Costo: ${res.costo}</p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">Hora inicio: ${res.hora_inicio}</p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">Hora final: ${res.hora_final}</p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">Hora total: ${res.horas_total}</p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">Fecha registro: ${res.fecha_registro}</p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">Fecha orden: ${res.fecha_orden}</p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">Descripción: ${res.descripcion_servicio}</p>
                    </div>
                    <div class="col-12">
                      <p class="card-text">Herramientas utilizadas: ${res.repuestos_utilizados}</p>
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


$(document).on("submit", "#formularioOrden", function(e){
  e.preventDefault();

  var message = 'Orden guardado con exito :)';
  var url = '/ordenes';
  if(editar){
    message = 'Orden Editada con exito :)';
    url = '/ordenes/update';
  }
  var formData = new FormData($('#formularioOrden')[0]);
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
              if(editar)
                table.ajax.reload();


              AlertaClass.alertaTop(message, 'success');
              $("#formularioOrden")[0].reset();
              $('#modalOrden').modal('toggle');
          } else {
            if(res.message){
              AlertaClass.alertaTop(res.message, 'error');
              $("#formularioOrden")[0].reset();
              $('#modalOrden').modal('toggle');
            }
            var arrayErrores = res.errores;
            validar(arrayErrores);
          }
          ajaxCronograma();
      }
  });
})
