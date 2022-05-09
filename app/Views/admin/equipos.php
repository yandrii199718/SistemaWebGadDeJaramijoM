<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>


<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <button class="btn btn-primary  btn-guardar" data-toggle="modal" data-target="#modelCrear">
        Registrar Equipo
    </button>

    <div class="text-navbar2">
      <a href="<?= base_url().route_to('equipos.index') ?>">Equipos</a>
      <span> / </span>
      <a href="<?= base_url().route_to('login.index') ?>">Inicio</a>
    </div>

      <!--<a href="<?= base_url().route_to('teams.report') ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary color-btn shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->


  </div>

  <div class="row">
        <div class="col">
          <div class="card ">
            <div class="card-body pb-0">
              <div class="d-flex align-items-center align-items-md-start justify-content-between mb-4">
                <h6 class="text-md mb-0">Equipos Registrados</h6>
                
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
                <th>Nombre Usuario</th>
                <th>Nombre Equipo</th>
                <th>Modelo</th>
                <th>observacion</th>
                <th>Marca</th>
                <th>Area</th>
                <th>Dependencia</th>
               
                </tr>
        </thead>
    </table>

  </div>
</div>

  </div>
  </div>
</div>



<!-- Logout Modal-->
<div class="modal fade" id="modelCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="titleModal">REGISTRAR EQUIPO</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formulario">
              <input type="hidden" class="form-control" id="id_equipo" name="id_equipo" value="0">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="sbn">Codigo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="codigo" name="codigo">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="sbn">Encargado del equipo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="sbn" name="sbn">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>
                

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="nombre_equipo">Nombre equipo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="nombre_equipo" name="nombre_equipo">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="modelo">Modelo Equipo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="modelo" name="modelo">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="idmarca">Marca:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-child"></i></div>
                          </div>
                          <select type="text" class="form-control" id="idmarca" name="idmarca">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach (getMarcas() as $key => $value) {
                              echo '<option value="'.$value['id_marca'].'">'.$value['nombre_marca'].'</option>';
                            }
                             ?>
                          </select>
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="area">Area:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-child"></i></div>
                          </div>
                          <select type="text" class="form-control" id="idarea" name="idarea">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach (getArea() as $key => $value) {
                              echo '<option value="'.$value['id_area'].'">'.$value['nombre_area'].'</option>';
                            }
                             ?>
                          </select>
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="permisos">Dependencia:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-child"></i></div>
                          </div>
                          <select type="text" class="form-control" id="idsede" name="idsede">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach (getSedes() as $key => $value) {
                              echo '<option value="'.$value['id_sede'].'">'.$value['nombre_sede'].'</option>';
                            }
                             ?>
                          </select>
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="observacion">Observación:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <textarea class="form-control" name="observacion" id="observacion" rows="2"></textarea>
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="manual">Manual:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-file-pdf"></i></div>
                          </div>
                            <input type="text" class="form-control" id="manual" name="manual">
                            <div class="valid-input invalid-feedback"></div>

                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label for="">Imagen:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-image"></i></div>
                          </div>
                          <div class="custom-files">
                            <label class="custom-file-label" for="imagen"></label>
                            <input type="file" class="custom-file-input" id="imagen" name="imagen">

                            <div class="valid-input invalid-feedback" style="margin-top: -1rem;"></div>
                          </div>
                        </div>
                      </div>
                    </div>




                  </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary " name="button">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>





<?= $this->endSection() ?>
<?= $this->section('script') ?>
  <script type="text/javascript" src="/assets/ajax/equipos.js"></script>
<?= $this->endSection() ?>
