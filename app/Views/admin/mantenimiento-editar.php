<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between">
    <h2>Editar Mantenimiento</h2>
    <div class="text-navbar2">
      <a href="<?= base_url().route_to('mantenimientos.index') ?>">Mantenimiento</a>
      <span> / </span>
      <a href="<?= base_url().route_to('login.index') ?>">Inicio</a>
    </div>
  </div>
  <hr>

  <div class="col-12">

    <form id="formMantenimiento" action="/mantenimiento/update" method="post">
      <input type="hidden" class="form-control" id="id_mantenimiento" name="id_mantenimiento" value="<?= ($mantenimiento) ? $mantenimiento[0]['id_mantenimiento'] : 0 ?>">
        <div class="modal-body">
          <div class="row">

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="ruc">Tipo Mantenimiento:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                  </div>
                  <select class="form-control" name="tipo_mantenimiento" id="tipo_mantenimiento" value="<?= old('tipo_mantenimiento') ?>">
                    <option value="">Seleccione...</option>
                    <?php
                    foreach ($tipoMantenimiento as $key => $value) {
                      if(old('tipo_mantenimiento') == $value || $mantenimiento[0]['tipo_mantenimiento'] == $value){
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
                  <input type="text" class="form-control" id="datos-equipo" name="datos-equipo"  value="<?= (old('datos-equipo')) ? old('datos-equipo'): $mantenimiento[0]['nombre_equipo'].' - '.$mantenimiento[0]['nombre_sede'] ?>" required>
                  <input type="hidden"  id="idequipo" name="idequipo" value="<?= (old('idequipo')) ? old('idequipo'): $mantenimiento[0]['idequipo']?>">
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
                <label for="fecha_operacion">Fecha operación:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar-week"></i></div>
                  </div>
                  <input type="date" class="form-control" id="fecha_operacion" name="fecha_operacion" value="<?= (old('fecha_operacion')) ? old('fecha_operacion') : $mantenimiento[0]['fecha_operacion'] ?>">
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
                  <input type="date" class="form-control" id="fecha_mantenimiento" name="fecha_mantenimiento" value="<?= (old('fecha_mantenimiento')) ? old('fecha_mantenimiento') : $mantenimiento[0]['fecha_mantenimiento'] ?>" readonly>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.fecha_mantenimiento') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="frecuencia">Frecuencia:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></div>
                  </div>
                  <input type="text" class="form-control" id="frecuencia" name="frecuencia" value="<?= (old('frecuencia')) ? old('frecuencia') : $mantenimiento[0]['frecuencia'] ?>" readonly>
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
                  <input type="text" class="form-control" id="cantidad_mantenimiento" name="cantidad_mantenimiento" value="<?= (old('cantidad_mantenimiento')) ? old('cantidad_mantenimiento') : $mantenimiento[0]['cantidad_mantenimiento'] ?>" readonly>
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
                  <input type="text" class="form-control" id="horas_uso" name="horas_uso" value="<?= (old('horas_uso')) ? old('horas_uso') : $mantenimiento[0]['horas_uso'] ?>">
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.horas_uso') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="periodo_garantia">Periodo garantia:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar-week"></i></div>
                  </div>
                  <input type="date" class="form-control" id="periodo_garantia" name="periodo_garantia" value="<?= (old('periodo_garantia')) ? old('periodo_garantia') : $mantenimiento[0]['periodo_garantia'] ?>">
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.periodo_garantia') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
              <div class="form-group">
                <label for="estado_alerta">Estado alerta:</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-question-circle"></i></div>
                  </div>
                  <select class="form-control" id="estado_alerta" name="estado_alerta" value="<?= old('estado_alerta') ?>">
                    <option value="">Seleccione...</option>
                    <?php

                    foreach ($estadoAlerta as $key => $value) {
                      if(old('estado_alerta') == $key || $mantenimiento[0]['estado_alerta'] == $key){
                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                      } else {
                        echo '<option value="'.$key.'">'.$value.'</option>';
                      }

                    }
                     ?>

                  </select>
                  <div class="valid-input invalid-feedback d-block"><?= session('errors.estado_alerta') ?></div>
                </div>
              </div>
            </div>

            <div class="col-12 p-0">
              <div class="col-12 col-md-6 col-lg-8">
                <div class="form-group">
                  <label for="actividad0">Actividad:</label>
                  <div class="form-actividad">
                    <?php if($actividad != null): ?>
                      <?php foreach ($actividad as $key => $value): ?>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-chart-line"></i></div>
                        </div>
                            <textarea class="form-control" name="actividad[]" id="actividad0" rows="2"><?= $value['actividad'] ?></textarea>

                        <div class="valid-input invalid-feedback d-block"><?= session('errors.actividad') ?></div>
                      </div>
                      <?php endforeach; ?>
                      <?php else: ?>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                            <textarea class="form-control" name="actividad[]" id="actividad0" rows="2"><?= old('actividad0') ?></textarea>

                          <div class="valid-input invalid-feedback d-block"><?= session('errors.actividad') ?></div>
                        </div>
                    <?php endif; ?>
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
<?= $this->endSection() ?>
