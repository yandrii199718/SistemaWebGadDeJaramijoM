let tableEquipo;
$(document).ready(function() {
  table = $('#example').DataTable( {
    dom: 'Bfrtip',
    buttons: [
      {
        "extend": "csvHtml5",
        "text": "CSV",
        "titleAttr": "Exportar a csv",
        "className": "btn",
        "title": "Reporte De Mantenimientos",
        "exportOptions": {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        }
      },
      {
        "extend": "excelHtml5",
        "text": "EXCEL",
        "titleAttr": "Exportar a excel",
        "className": "btn",
        "title": "Reporte De Mantenimientos",
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
        "title": "Reporte De Mantenimientos",
        exportOptions: {// quali colonne vengono mandate in stampa (indice posizionale)
        columns: [ 0,2,3,4,5,6,7,8 ]
        },
        customize : function(doc){
            doc.styles.tableHeader.alignment = 'left'; //giustifica a sinistra titoli colonne
            doc.content[1].table.widths = [40,80,100,100,100,90,90,90]; //costringe le colonne ad occupare un dato spazio per gestire il baco del 100% width che non si concretizza mai
        }
      },
      {
        "extend": "print",
        "text": "PRINT",
        "titleAttr": "Imprimir",
        "className": "btn",
        "title": "Reporte De Mantenimientos",
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
    "order": [[ 0, 'asc' ]],
      "ajax": "/tablaMantenimientos",
      "columns": [
           { "data": "id_mantenimiento",
              "render": function(data, type, JsonResultRow, meta){
                return meta.row + 1;

              }
           },
           {
               "data": 'id_mantenimiento',
               "render": function (data, type, JsonResultRow, meta) {
                 html = `<div class="table-action">
                 <div class="dropdown">
                    <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acción<i class="fas fa-cog"></i>
                    </a>


                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                          <a class="dropdown-item btn-editar-mantenimiento" href="/mantenimiento/${JsonResultRow.id_mantenimiento}/editar" data-id="${JsonResultRow.id_mantenimiento}" data-accion="edit">
                            <i class="fas fa-edit"></i> Editar
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-ver" href="javascript:void(0);" data-id="${JsonResultRow.id_mantenimiento}">
                            <i class="far fa-eye"></i> Ver
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item btn-eliminar-mantenimiento" href="javascript:void(0);" data-id="${JsonResultRow.id_mantenimiento}">
                            <i class="fas fa-trash-alt"></i> Eliminar
                          </a>
                        </li>
                      </ul>

                    </div>
                  </div>`;
                   return html;
               }
           },
           { "data": "codigo_equipo" },
          { "data": "sbn" },
           { "data": "nombre_equipo" },
            { "data": "nombre_sede" },
           { "data": "nombres" },
           { "data": "fecha_mantenimiento" },
           { "data": "tipo_mantenimiento" },
           { "data": "estado_alerta" ,
            "render": function (data, type, JsonResultRow, meta) {
              return (JsonResultRow.estado_alerta == 1)? 'Pendiente': 'Finalizado';
            }
          }

       ]
  } );

  consultaEquipo();

} );


function consultaEquipo(){
  tableEquipo = $('#tablaEquipo').DataTable( {
    "language": {
              "url": "/assets/Spanish.json"
    },
    "ajax": "/mantenimientos-equipos",
    "columns": [
         { "data": "id_equipo"},
         { "data": "codigo"},
         { "data": "sbn"},
         { "data": "nombre_equipo"},
         { "data": "modelo"},
         { "data": "nombre_sede"},
         { "data": "id_equipo",
           "render": function (data, type, JsonResultRow, meta) {
             var btn = `
             <div class="btn btn-seleccionar-equipo-actual" data-id="${JsonResultRow.id_equipo}" data-equipo="${JsonResultRow.nombre_equipo}" data-sede="${JsonResultRow.nombre_sede}" data-sbn="${JsonResultRow.sbn}">
               <i class="far fa-check-square" style="font-size: 2rem"></i>
             </div>
             `;
             return btn;
           }
          },
       ]
  });
}

$(document).on('click', '.btn-seleccionar-equipo-actual', function(){
  var id = $(this).data('id');
  var equipo = $(this).data('equipo');
  var sede = $(this).data('sede');
  var sbn = $(this).data('sbn');
  $('#datos-equipo').val(equipo + " - "+ sede);
  $('#idequipo').val(id);
  $('#modalVerEquipo').modal('toggle');
})

$(document).on("click", ".btn-seleccionar-equipo", function(){
  $('#modalVerEquipo').modal('toggle');
})

$(document).on("change", "#estado-fecha", function(){
  if($(this).is(':checked')){
    $('#periodo_garantia').attr('disabled', true);
  } else {
    $('#periodo_garantia').attr('disabled', false);
  }

})


//ver descripcion
$(document).on("click", ".btn-ver", function(){
  id = $(this).data('id');
  $('#modalVerOrden').modal('toggle');
  $.ajax({
      url: '/mantenimiento/'+id,
      method: "get",
      cache: false,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (res) {
          console.log(res);
          if(res == null){

          } else {
            $('#title-ver-orden').html("MANTENIMIENTO");
            contenedor = `
              <div class="card border-secondary mx-auto mb-3" style="max-width: 45rem;">
                <div class="card-header text-center">
                <h3 class="font-weight-bold">
                  ${res[0].tipo_mantenimiento}
                  </h3>
                </div>
                <div class="card-body text-secondary">
                  <div class="row">
                  <div class="col-12 col-md-6">
                    <p class="card-text">
                        <span class="font-weight-bold">Tipo Mantenimiento:</span>
                        ${res[0].tipo_mantenimiento}
                    </p>
                  </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Id:</span>
                          ${res[0].id_mantenimiento}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Codigo Equipo:</span>
                          ${res[0].codigo_equipo}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Fecha operación:</span>
                          ${res[0].fecha_operacion}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Fecha Mantenimiento:</span>
                          ${res[0].fecha_mantenimiento}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Frecuencia:</span>
                          ${res[0].frecuencia}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Cantidad Mantenimientos:</span>
                          ${res[0].cantidad_mantenimiento}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Horas uso:</span>
                          ${res[0].horas_uso}
                      </p>
                    </div>
                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Periodo Garantía: </span>
                          ${res[0].periodo_garantia}
                      </p>
                    </div>

                    <div class="col-12 col-md-6">
                      <p class="card-text">
                          <span class="font-weight-bold">Estado: </span>
                          ${(res[0].estado_alerta == 1) ? 'Pendiente': 'Finalizado'}
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



$(document).on('change', '#fecha_mantenimiento', function(){
  var date = $(this).val();
  //date = moment(date).format('MM-DD-YYYY');
  //
  date = new Date(date);


  //fecha = date.getFullYear() + ' - ' + date.getMonth() + ' - ' + date.getDate();
  dias = 5; //Frecuencia
  cantidad = 5 //cantidad mantenimiento

  cronograma = [];
   for (var i = 0; i <= cantidad; i++){
      //d = i * dias;   // => 1*5=5, 2*5=10
      var fecha = '';
      if(i == 0){
        date.setDate(date.getDate() + 1);
        fecha = date.getFullYear() + ' - ' + (date.getMonth() + 1) + ' - ' + (date.getDate());
      } else {
        date.setDate(date.getDate() + dias);
        fecha = date.getFullYear() + ' - ' + (date.getMonth() + 1) + ' - ' + (date.getDate());
      }
      //console.log(date.getDate());
      cronograma.push(fecha);

    }
console.log(cronograma);
  //date.setDate(date.getDate() + (dias + 1));


})

$(document).on('click', '.btn-eliminar-mantenimiento', function(){
  idMantenimiento = $(this).data('id');
alert(idMantenimiento);
  var alerta = new AlertaClass();
  datos = {
    'title': 'Esta seguro?',
    'text': 'Si quiero eliminar el mantenimiento!',
    'messageOk': 'Mantenimiento eliminado con exito.',
    'messageNot': 'Mantenimiento no eliminado :)',
  }
  var estado = alerta.crearAlertaEliminar(datos);

  estado.then(function(res){
    if(res){
      $.ajax({
        url: 'mantenimiento/delete/'+idMantenimiento,
        type: 'delete',
        success: function (res) {
          console.log(res);
        }
      })
      AlertaClass.alertaTop(datos['messageOk'], 'success');
      table.ajax.reload();
    } else {
      AlertaClass.alertaTop(datos['messageNot'], 'error');
    }
  });
})


//acción de agregar una nueva actividad
var number_actividad = 0;
var mensaje = "";
$(document).on('click', '.btn-add-actividad', function(){

    mensaje = $('#actividad'+number_actividad).val();
    contenedor = $('.form-actividad');
    if(mensaje.length != 0){
      number_actividad++;
      html = `<div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-id-card"></i></div>
        </div>
        <textarea class="form-control" name="actividad[]" id="actividad${number_actividad}" rows="2"></textarea>
        <div class="valid-input invalid-feedback d-block"></div>
      </div>`;
      contenedor.append(html);
    }


});


//evento al hacer un cambio en tipo_mantenimiento
$(document).on("change", "#tipo_mantenimiento", function(){
  valor = $(this).val();
  frecuencia = $('#frecuencia');
  cantidad_mantenimiento = $('#cantidad_mantenimiento');
  horas_uso = $('#horas_uso');
  periodo_garantia = $('#periodo_garantia');
  fecha_operacion = $('#fecha_operacion');
  var now = new Date();

  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);

  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

  if(valor == "PREVENTIVO"){
    frecuencia.prop('readonly', false);
    cantidad_mantenimiento.prop('readonly', false);
    horas_uso.prop('readonly', false);
    periodo_garantia.prop('readonly', false);
    fecha_operacion.prop('readonly', false);
  } else {
    frecuencia.prop('readonly', true);
    frecuencia.val('1');
    cantidad_mantenimiento.prop('readonly', true);
    cantidad_mantenimiento.val('1');
    horas_uso.prop('readonly', true);
    horas_uso.val('0');
    periodo_garantia.prop('readonly', true);
    periodo_garantia.val(today);
    fecha_operacion.prop('readonly', true);
    fecha_operacion.val(today);
  }
})
