<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <div class="col-12">
    <h2>Configuración</h2>
    <hr class="mb-2">
  </div>

  <?php if($configuracion != null): ?>

<div class="col-12">
  <img src="<?php
  if($configuracion['logo'] == 'no_image.jpg'){
    $imagen = URL_UPLOADS.'configuracion/0/'.$configuracion['logo'];
  } else {
    $imagen = URL_UPLOADS.'configuracion/1/'.$configuracion['logo'];
  }
  echo $imagen;
?>" alt="" width="100">

</div>

<form action="configuracion/update" method="post" enctype="multipart/form-data">
  <input type="hidden" class="form-control" id="id_configuracion" name="id_configuracion" value="<?= $configuracion['id_configuracion'] ?>">
    <div class="modal-body">
      <div class="row">

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="usuario">Ruc:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-envelope"></i>
                </div>
              </div>
              <input type="text" class="form-control" id="ruc" name="ruc" value="<?= $configuracion['ruc'] ?>">
              <div class="valid-input invalid-feedback d-block"><?= session('errors.ruc') ?></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="razon_social">Razon social:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-passport"></i></div>
              </div>
              <input type="text" class="form-control" id="razon_social" name="razon_social" value="<?= $configuracion['razon_social'] ?>">
              <div class="valid-input invalid-feedback d-block"><?= session('errors.razon_social') ?></div>
            </div>
          </div>
        </div>


        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="fecha_creacion">Fecha creación:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-id-card"></i></div>
              </div>
              <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" value="<?= $configuracion['fecha_creacion'] ?>">
              <div class="valid-input invalid-feedback d-block"><?= session('errors.fecha_creacion') ?></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="fecha_inicio">Fecha inicio:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-id-card"></i></div>
              </div>
              <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?= $configuracion['fecha_creacion'] ?>">
              <div class="valid-input invalid-feedback d-block"><?= session('errors.fecha_inicio') ?></div>
            </div>
          </div>
        </div>


        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="condicion">Condición:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-passport"></i></div>
              </div>
              <select type="text" class="form-control" id="condicion" name="condicion">
                <option value="">Seleccione...</option>
                <?php foreach ($condicion as $key => $value) {
                  if($value == $configuracion['condicion']){
                    echo '<option value="'.$value.'" selected>'.$value.'</option>';
                  } else {
                    echo '<option value="'.$value.'">'.$value.'</option>';
                  }

                } ?>

              </select>
              <div class="valid-input invalid-feedback d-block"><?= session('errors.condicion') ?></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="estado">Estado:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-passport"></i></div>
              </div>
              <select type="text" class="form-control" id="estado" name="estado">
                <option value="">Seleccione...</option>
                <?php foreach ($estado as $key => $value) {
                  if($value == $configuracion['estado']){
                    echo '<option value="'.$value.'" selected>'.$value.'</option>';
                  } else {
                    echo '<option value="'.$value.'">'.$value.'</option>';
                  }

                } ?>

              </select>
              <div class="valid-input invalid-feedback d-block"><?= session('errors.estado') ?></div>
            </div>
          </div>
        </div>


        <div class="col-12 col-lg-6">
          <div class="form-group">
            <label for="logo">Logo:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-image"></i></div>
              </div>
              <div class="custom-file">
                <label class="custom-file-label btn btn-light text-left" for="logo">
                  <?= $configuracion['logo'] ?>
                </label>
                <input type="file" class="custom-file-input" id="logo" name="logo">

              </div>
              <div class="valid-input invalid-feedback d-block" style="margin-top: .5rem;"><?= session('errors.logo') ?></div>

            </div>

          </div>
        </div>

      </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary color-btn" name="button">Guardar Cambios</button>
    </div>
</form>

<?php endif; ?>


</div>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
  <!--<script type="text/javascript" src="/assets/ajax/areas.js"></script>-->
<?= $this->endSection() ?>
