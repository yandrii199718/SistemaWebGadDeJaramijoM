<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-3">
    <div>
    <h2>Reporte Mantenimiento</h2>
    <button class="btn btn-primary  mt-2 mt-sm-4" id="generar-reporte">Reporte</button>
  </div>

    <div class="text-navbar2">
      <a href="<?= base_url().route_to('filtros.index') ?>">Reportes</a>
      <span> / </span>
      <a href="<?= base_url().route_to('login.index') ?>">Inicio</a>
    </div>

  </div>
  <hr>
  <div class="row">
        <div class="col">
          <div class="card text-white bg-dark">
            <div class="card-body pb-0">
              <div class="d-flex align-items-center align-items-md-start justify-content-between mb-4">
                <h6 class="text-md text-white mb-0">Generar Reporte</h6>
                
              </div> <!-- end of d-flex -->
            </div> <!-- end of card-body -->

  <div class="row">
    <form class="col-12 col-xl-6 px-0" action="<?= base_url().route_to('filtros.filter') ?>" method="post">
      <div class="col-12">
          <div class="row m-0">

            <div class="col-12 col-sm-6 col-md-3 px-1 px-sm-2">
              <label for="">Codigo Equipo:</label>
              <input type="text" class="form-control" name="codigo" value="<?= (isset($old['codigo'])) ? $old['codigo'] : '' ?>" id="codigo" required>
            </div>
            <div class="col-12 col-sm-6 col-md-3 px-1 px-sm-2">
              <label for="">Dependencia:</label>
              <select class="form-control" name="idsede" id="idsede" required>
                <?php if(isset($sede)){
                  echo '<option value="'.session('idsede').'">'.session('sede').'</option>';
                } else { ?>
                  <option value="">Seleccione</option>
                  <?php foreach(getSedes() as $sede){
                    if(isset($old['idsede']) && $old['idsede'] == $sede['id_sede']){
                      echo "<option selected value=".$sede['id_sede'].">".$sede['nombre_sede'] ."</option>";
                    } else {
                      echo "<option value=".$sede['id_sede'].">".$sede['nombre_sede'] ."</option>";
                    }
                 }
               }?>
              </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 px-1 px-sm-2">
              <label for="">Tipo Mantenimiento:</label>
              <select class="form-control" name="tipo_mantenimiento" id="tipo_mantenimiento" required>
                <option value="">Seleccione</option>
                <?php
                foreach($tipoMantenimiento as $tipo){
                  if(isset($old['tipo_mantenimiento']) && $old['tipo_mantenimiento'] == $tipo){
                    echo "<option selected value=".$tipo.">".$tipo."</option>";
                  } else {
                    echo "<option value=".$tipo.">".$tipo."</option>";
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-12 col-sm-2 p-sm-2">
              <button type="submit" class="btn btn-primary  mt-2 mt-sm-4" name="button">Buscar</button>
            </div>

            </div>
      
      </div>
      </div>
      
      </div>
    </form>

<?php if(!isset($datosEquipo)): ?>
  <div class="col-12">
    <div class="card p-4 m-4">
      <h3>No hay resultados</h3>
      <p>No existe un equipo con mantenimiento asignado</p>

    </div>

  </div>
  </div>


  <?php else: ?>
    <div class="container-fluid pt-4 px-4" id="informacion-equipo">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="card  text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5>
        <a id="prev" href="javascript:void(0);"><i class="fas fa-arrow-circle-left"></i></a>
        ACTIVIDAD <span id="numberActivity">1</span>
        <a id="next" href="javascript:void(0);"><i class="fas fa-arrow-circle-right"></i></a>
      </h5>
                            </div>
                           
      <div class="card p-3 border-secondary">
        <input type="hidden" id="cantidadM" value="<?= count($datosCronograma) ?>">
        <div class="table-responsive">
              <table  class="table table-hover mb-0" style="width:100%">
              <thead  class="thead-dark">
          <tr>
            <th>PROX.FECHAS</th>
            <th>ESTADO</th>
            <th>N° ORDEN</th>
          </tr>

          <?php foreach($datosCronograma as $key => $datos) :
            foreach($datos as $dato): ?>

          <tr class="tipoC tipoC<?= $key+1?>">
            <td><?= nuevaFecha($dato['fecha_cronograma']) ?></td>
            <td><?php
                if($dato['estadomantenimiento'] == 0){
                  echo "<span class='finalizado'>FINALIZADO</span>";
                } else if ($dato['estadomantenimiento'] == 1){
                  echo "<span class='pendiente'>PENDIENTE</span>";
                } else {
                  echo "<span class='vencido'>VENCIDO</span>";
                }
             ?></td>
            <td><?= ($dato['nro_orden'] != '') ? $dato['nro_orden'] : '0000' ?></td>
          </tr>
        <?php endforeach; endforeach; ?>
        </table>
      </div>                        </div>
                    </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="card card-danger  rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="mb-0"> <a  href="javascript:void(0);"><i class="fas fa-print"></i></a> <span> Informacion del equipo</span></h5>
                            </div>
                            
                            <ul>
              <li>Codigo: <?= $equipoE[0]['codigo'] ?></li>
              <li>Dependencia: <?= $equipoE[0]['nombre_sede'] ?></li>
              <li>Nombre de equipo: <span><?= $datosEquipo[0]['nombre_equipo'] ?></span> </li>
              <li>Marca: <span><?= $equipoE[0]['nombre_marca'] ?></span> </li>
              <li>Modelo: <span><?= $datosEquipo[0]['modelo'] ?></span> </li>
              <li>Manual: <span><?= ($datosEquipo[0]['manual'] != '')? 'si tiene' : 'no tiene' ?></span> </li>
              <li>Tipo mantenimiento: <span><?= $datosEquipo[0]['tipo_mantenimiento'] ?></span> </li>
              <li>Garantia: <span>
                <?=
                fechaVencida($datosEquipo[0]['periodo_garantia'])
                ?>
            </span> </li>
            </ul>
  <ul class="list-group list-group-horizontal">

        <li class="list-group-item list-group-item-action list-group-item-light text-center"><span>        <img class="rounded" src="<?= URL_UPLOADS ?>equipos/img/<?= $datosEquipo[0]['id_equipo'].'/'.$datosEquipo[0]['imagen'] ?>" alt="">
        </li>

        </ul>
                        </div>
                    </div>
                </div>
                

<hr class="col-12">

   

<div class="row mt-6">
                    <div class="col-md-12 col-12">
                        <!-- card  -->
                        <div class="card">
                            <!-- card header  -->
                            <div class="card-header bg-white  py-4">
                            <h5 class="mb-0"> <a  href="javascript:void(0);"><i class="fas fa-tools"></i></a> <span> Actividades Realizadas</span></h5>
                            </div>
        <?php
        //var_dump($datosEquipo);
        ?>
        <div class="table-responsive">
        <table  class="table table-hover table-activity text-center mb-0" style="width:100%">
        <thead  class="thead-dark">
        
          <tr>
            <th style="white-space: nowrap; padding: 10px;">ACTIVIDAD</th>
            <th style="white-space: nowrap; padding: 10px;">PUESTA EN <br>MARCHA</th>
            <th style="white-space: nowrap; padding: 10px;">FECHA <br> MANTENIMIENTO</th>
            <th style="white-space: nowrap; padding: 10px;">FRECUENCIA</th>
            <th style="white-space: nowrap; padding: 10px;">MAN.</th>
          </tr>

          <?php foreach($datosEquipo as $key => $datos) :?>
          <tr class="active active<?= $key+1?>">
            <td class="text-left">
              <?php if($datos['actividades'] != null ): ?>
                <ul>
                <?php foreach ($datos['actividades'] as $key => $value): ?>

                    <li style="width: 300px; min-width: 200px;"><?= $value['actividad'] ?></li>

                <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </td>
            <td style="white-space: nowrap;"><?= nuevaFecha($datos['fecha_operacion']) ?></td>
            <td><?= nuevaFecha($datos['fecha_mantenimiento']) ?></td>
            <td><?= $datos['frecuencia'] ?></td>
            <td><?= substr($datos['tipo_mantenimiento'], 0,1) ?></td>

          </tr>
          <?php endforeach; ?>
        </table>

      </div></div></div></div>

      <!-- contenedor para mostrar los colores representativos -->
      <div class="col-12 mt-5">
        <div class="row">
            <div class="col-3">
              <label for="">Año</label>
              <label for="" style="border: 1px solid grey; padding: 1px 20px;"><?= date('Y') ?></label>
            </div>
            <div class="col-3">
              <i class="fas fa-circle" style="color: green"></i>
              <label for="">Finalizado</label>
            </div>
            <div class="col-3">
              <i class="fas fa-circle" style="color: orange"></i>
              <label for="">Pendiente</label>
            </div>
            <div class="col-3">
              <i class="fas fa-circle" style="color: red"></i>
              <label for="">Vencido</label>
            </div>

        </div>
      </div>


    </div>
<?php endif;  ?>

  </div>



</div>



<?= $this->endSection() ?>
<?= $this->section('script') ?>

<script type="text/javascript">
  var position = 1;
  var cantidadM = $('#cantidadM').val();

  var tipoC = $('.tipoC');

  MostrarElementos(position);


  function MostrarElementos(elemento) {
    $('#numberActivity').html(position);
    var active = $('.table-activity .active');
    var activeS = $('.table-activity .active'+elemento);
    var ele = $('.tipoC'+elemento);
    tipoC.addClass('d-none');


      ele.removeClass('d-none');
      active.css('background', 'none');
      activeS.css('background', '#80808029');
  }

  $('#next').click(function(){
    if(cantidadM > position)
      position++;
    MostrarElementos(position);
  })

  $('#prev').click(function(){
    if(position > 1)
      position--;
    MostrarElementos(position);
  })


  $(document).on("click", "#generar-reporte", function(){
    if($('#informacion-equipo').length != 0){

    var id = $('#codigo').val();
    var tipo = $('#tipo_mantenimiento').val();
    var idsede = $('#idsede').val();
    window.open('/reportes/'+id+'/'+idsede+'/'+tipo, '_blank');
    }
  })

</script>
<?= $this->endSection() ?>
