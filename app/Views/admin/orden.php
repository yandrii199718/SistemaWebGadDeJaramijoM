<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
      <h1 class="h3 mb-0 text-gray-800"></h1>

      <div class="text-navbar2">
        <a href="<?= base_url().route_to('ordenes.index') ?>">Finalizados</a>
        <span> / </span>
        <a href="<?= base_url().route_to('login.index') ?>">Inicio</a>
      </div>
      <!--<a href="<?= base_url().route_to('orders.report') ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary color-btn shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
  </div>
  <div class="row">
        <div class="col">
          <div class="card ">
            <div class="card-body pb-0">
              <div class="d-flex align-items-center align-items-md-start justify-content-between mb-4">
                <h6 class="text-md mb-0">Mantenimientos Finalizados</h6>
                
              </div> <!-- end of d-flex -->
            </div> <!-- end of card-body -->
  <!-- content -->
  <div class="row">

    <div class="col-12">
    <div class="table-responsive">
              <table  id="example" class="table table-hover mb-0" style="width:100%">
              <thead  class="thead-dark">
              <tr>
                  <th>#</th>
                  <th>Acción</th>
                  <th>Fecha Orden</th>
                  <th>N° Orden</th>
                  <th>Usuario</th>
                  <th>Area</th>
                  <th>Costo</th>
                  <th>Duración del Mtto</th>
                  <th>Estado</th>
              </tr>
          </thead>
      </table>

      </div>
      </div>





  </div>

</div>

</div>




<?= $this->endSection() ?>

<?= $this->section('script') ?>
  <script type="text/javascript" src="<?= base_url() ?>/assets/ajax/orden.js"></script>
<?= $this->endSection() ?>
