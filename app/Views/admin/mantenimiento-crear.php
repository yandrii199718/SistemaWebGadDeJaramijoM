<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between">
    <h2>Registrar Mantenimiento</h2>
    <div class="text-navbar2">
      <a href="<?= base_url().route_to('mantenimientos.index') ?>">Mantenimiento</a>
      <span> / </span>
      <a href="<?= base_url().route_to('login.index') ?>">Inicio</a>
    </div>
  </div>
  <hr>

  <div class="col-12">

    <form id="formMantenimiento" action="/mantenimiento" method="post">
      <input type="hidden" class="form-control" id="id_mantenimiento" name="id_mantenimiento" value="0">
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="ruc">Tipo Mantenimiento:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                  </div>
                  <select class="form-control" name="tipo_mantenimiento" id="tipo_mantenimiento" value="<?= old('tipo_mantenimiento') ?>" required>
                    <option value="">Seleccione...</option>
                    <?php
                    foreach ($tipoMantenimiento as $key => $value) {
                      if(old('tipo_mantenimiento') == $value){
                        echo '<option value="'.$value.'" selected>'.$value.'</option>';
                      } else {
                        echo '<option value="'.$value.'">'.$value.'</option>';
                      }
                    }
                     ?>
                  </select>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.tipo_mantenimiento') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="fecha_operacion">Equipo:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></div>
                  </div>
                  <input type="text" class="form-control" id="datos-equipo" name="datos-equipo"  value="<?= old('datos-equipo') ?>" required>
                  <input type="hidden"  id="idequipo" name="idequipo" value="<?= old('idequipo')?>">
                  <div class="input-group-append" required>
                   <button class="btn btn-outline-secondary rounded-right btn-seleccionar-equipo" type="button">
                     <i class="fas fa-search" ></i>
                   </button>
                </div>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.idequipo') ?></div>
                </div>
              </div>
            </div>



            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="fecha_operacion">Puesta en Marcha:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar-week"></i></i></div>
                  </div>
                  <input type="date" class="form-control" id="fecha_operacion" name="fecha_operacion" value="<?= old('fecha_operacion') ?>" required>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.fecha_operacion') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="fecha_mantenimiento">Fecha Mantenimiento:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar-week"></i></div>
                  </div>
                  <input type="date" class="form-control" id="fecha_mantenimiento" name="fecha_mantenimiento" value="<?= old('fecha_mantenimiento') ?>" required>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.fecha_mantenimiento') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="frecuencia">Ip del equipo:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></div>
                  </div>
                  <input type="text" class="form-control" id="frecuencia" name="frecuencia" value="<?= old('frecuencia') ?>" required>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.frecuencia') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="cantidad_mantenimiento">Cantida mantenimiento:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></div>
                  </div>
                  <input type="text" class="form-control" id="cantidad_mantenimiento" name="cantidad_mantenimiento" value="<?= old('cantidad_mantenimiento') ?>" required>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.cantidad_mantenimiento') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="horas_uso">Horas de uso:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                  </div>
                  <input type="text" class="form-control" id="horas_uso" name="horas_uso" value="<?= old('horas_uso') ?>" required>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.horas_uso') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <div class="row pl-2 pr-3">
                  <label for="periodo_garantia">Periodo garantia:</label>
                  <label for="" class="ml-auto">
                    (Vencido)
                    <input type="checkbox" id="estado-fecha">
                  </label>
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar-week"></i></div>
                  </div>
                  <input type="date" class="form-control" id="periodo_garantia" name="periodo_garantia" value="<?= old('periodo_garantia') ?>">
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.periodo_garantia') ?></div>
                </div>
              </div>
            </div>


            <div class="col-12 p-0">
              <div class="col-12 col-md-6 col-lg-8">
                <div class="form-group">
                  <label for="actividad0">Actividad:</label>
                  <div class="form-actividad">
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-chart-line"></i></div>
                      </div>
                      <textarea class="form-control" name="actividad[]" id="actividad0" rows="2" required><?= old('actividad0') ?></textarea>
                      <div class="valid-input invalid-feedback d-block"><?= session('errors.actividad') ?></div>
                    </div>

                  </div>
                  <button type="button" class="btn-add-actividad" style="border:none; background: none; margin: 10px 30px"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>




          </div>

        </div>
        <div class="modal-footer">
            <a href="<?= base_url().route_to('mantenimientos.index') ?>" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</a>
            <button type="submit" class="btn btn-primary color-btn" name="button">Guardar</button>
        </div>
    </form>

  </div>


  </div>




  <!-- Logout Modal-->
  <div class="modal fade" id="modalVerEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header bg-red-wine text-white">
                  <h5 class="modal-title w-100 text-center" id="title-ver-equipo">
                    SELECCIONAR EQUIPO
                  </h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body" >
                <div class="row">
                  <div class="col-12">
                    <table id="tablaEquipo" class="display" style="width:100%">
                      <thead>
                      <tr>
                        <th>id</th>
                        <th>Codigo</th>
                        <th>Encargado del equipo</th>
                        <th>Equipo</th>
                        <th>Modelo</th>
                        <th>Sede</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>id</th>
                          <th>Equipo</th>
                          <th>Sede</th>
                          <th>
                            <div class="btn">
                              <i class="far fa-check-square" style="font-size: 2rem"></i>
                            </div>
                          </th>
                        </tr>

                      </tbody>

                    </table>
                  </div>
                </div>

              </div>



          </div>
      </div>
  </div>





<?= $this->endSection() ?>
<?= $this->section('script') ?>
  <script type="text/javascript" src="/assets/ajax/mantenimiento.js"></script>
  <script src="/assets/libs/moment/moment.min.js"></script>
  <?php if(session('success')): ?>
  <script>
    AlertaClass.alertaTop('registro exitoso', 'success');

  </script>
  <?php endif; ?>


<?= $this->endSection() ?>
