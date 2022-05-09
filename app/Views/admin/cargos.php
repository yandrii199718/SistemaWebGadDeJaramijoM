<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <button class="btn btn-primary btn-crear-cargo" data-toggle="modal" data-target="#modalCrearCargo">
        Registrar Cargo
    </button>

    <div class="text-navbar2">
      <a href="<?= base_url().route_to('cargos.index') ?>">Cargos</a>
      <span> / </span>
      <a href="<?= base_url().route_to('login.index') ?>">Inicio</a>
    </div>

      <!--<a href="<?= base_url().route_to('charges.report') ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary color-btn shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->


  </div>
  <div class="row">
        <div class="col">
          <div class="card ">
            <div class="card-body pb-0">
              <div class="d-flex align-items-center align-items-md-start justify-content-between mb-4">
                <h6 class="text-md mb-0">Cargos Registrados</h6>
                
              </div> <!-- end of d-flex -->
            </div> <!-- end of card-body -->
  <div class="col-12">
  <table id="example" class="table  table-hover" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre Cargo</th>
                <th width="100px">Acción</th>
            </tr>
        </thead>
    </table>

  </div>

  </div>
  </div>

  </div>
  </div>

  

<!-- Logout Modal-->
<div class="modal fade" id="modalCrearCargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="titleModal">REGISTRAR CARGO</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formCargo">
              <input type="hidden" class="form-control" id="id_cargo" name="id_cargo" value="0">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-md-12">
                      <div class="form-group">
                        <label for="ruc">Nombre Cargo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="nombre_cargo" name="nombre_cargo">
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


<?= $this->endSection() ?>
<?= $this->section('script') ?>
  <script type="text/javascript" src="/assets/ajax/cargos.js"></script>
<?= $this->endSection() ?>
