<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between  mt-3 mb-4">
    <a href="<?= base_url().route_to('mantenimientos.create') ?>" class="btn btn-primary ">
        Registrar Mantenimiento
    </a>

    <div class="text-navbar2">
      <a href="<?= base_url().route_to('mantenimientos.index') ?>">Mantenimientos</a>
      <span> / </span>
      <a href="<?= base_url().route_to('login.index') ?>">Inicio</a>
    </div>

      <!--<a href="<?= base_url().route_to('maintenances.report') ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary color-btn shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->


  </div>
  <div class="row">
        <div class="col">
          <div class="card ">
            <div class="card-body pb-0">
              <div class="d-flex align-items-center align-items-md-start justify-content-between mb-4">
                <h6 class="text-md mb-0">Mantenimiento Registrados</h6>
                
              </div> <!-- end of d-flex -->
            </div> <!-- end of card-body -->
  <div class="col-12">
  <div class="table-responsive">
              <table  id="example" class="table table-hover mb-0" style="width:100%">
              <thead  class="thead-dark">
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Codigo</th>
                <th>Encargado equipo</th>
                <th>Nombre Equipo</th>
                <th>Dependencia</th>
                <th>Usuario</th>
                <th>Fecha mantenimiento</th>
                <th>Tipo Mantenimiento</th>
                <th>Estado</th>
            </tr>
        </thead>
    </table>

  </div>
  </div>
  </div>
  </div>
  </div>
<!-- Logout Modal-->
<div class="modal fade" id="modalCrearArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="exampleModalLabel">CREAR AREA</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formArea">
              <input type="hidden" class="form-control" id="id_area" name="id_area" value="0">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-md-12">
                      <div class="form-group">
                        <label for="ruc">Nombre Area:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="nombre_area" name="nombre_area">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>


                  </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary color-btn" name="button">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>






<!-- Logout Modal-->
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="titleModal">DETALLE DE MANTENIMIENTO</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formulario">
              <input type="hidden" class="form-control" id="id_equipo" name="id_equipo" value="0">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Tipo mantenimiento:</label>
                      <div class="form-control">
                        <label>Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Equipo:</label>
                      <div class="form-control">
                        <label id="m-equipo">Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Fecha Operación:</label>
                      <div class="form-control">
                        <label id="m-fecha-operacion">Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Fecha Mantenimiento:</label>
                      <div class="form-control">
                        <label id="m-fecha-mantenimiento">Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Frecuencia:</label>
                      <div class="form-control">
                        <label id="m-fredcuencia">Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Cantidad Mantenimientos:</label>
                      <div class="form-control">
                        <label id="m-cantidad">Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Horas de uso:</label>
                      <div class="form-control">
                        <label id="m-horas-uso">Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Reriodo garantia:</label>
                      <div class="form-control">
                        <label id="m-garantia">Prueba</label>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 mb-md-4">
                      <label>Estado alerta:</label>
                      <div class="form-control">
                        <label id="alerta">Prueba</label>
                      </div>
                    </div>

                    <div class="col-12 mb-md-4">
                      <div class="">
                        <label>Actividad:</label>
                        <div class="form-control">
                          <label for="">Prueba</label>
                        </div>
                      </div>

                    </div>


                  </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>

                </div>
            </form>

        </div>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
  <script type="text/javascript" src="<?= base_url() ?>/assets/ajax/mantenimiento.js"></script>
  <?php if(session('success')): ?>
  <script>
    AlertaClass.alertaTop('registro exitoso', 'success');

  </script>
  <?php endif; ?>
<?= $this->endSection() ?>
