<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <button class="btn btn-primary  btn-crear-usuario" data-toggle="modal" data-target="#modalCrearUsuario">
        Registrar usuario
    </button>

  

      <a href="<?= base_url().route_to('usuario.reporte') ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary  shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>


  </div>

<div class="row">
        <div class="col">
          <div class="card ">
            <div class="card-body pb-0">
              <div class="d-flex align-items-center align-items-md-start justify-content-between mb-4">
                <h6 class="text-md mb-0">Usuarios Registrados</h6>
                
              </div> <!-- end of d-flex -->
            </div> <!-- end of card-body -->
            <div class="table-responsive">
              <table  id="example" class="table table-hover mb-0" style="width:100%">
              <thead  class="thead-dark">
                
              <tr>
                <th>#</th>
                <th>Accion</th>
                <th>Usuario</th>
                <th>DNI</th>
                <th>Nombres</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Cargo</th>
                <th>Area</th>
                <th>Dependencia</th>
                
            </tr>
        </thead>
              </table>
             
            </div> <!-- end of table-responsive -->
          </div> <!-- end of card -->
        </div> <!-- end of col -->
      </div> <!-- end of row -->

      </div> 


<!-- Logout Modal-->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="titleModal">CREAR USUARIO</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formUsuario" method="post">
              <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="0">
                <div class="modal-body">
                  <div class="row">

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-user"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control" id="usuario" name="usuario">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-passport"></i></div>
                          </div>
                          <input type="password" class="form-control" id="password" name="password">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>


                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="dni">Cédula de identidad:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="number" class="form-control" id="dni" name="dni">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user icon-form"></i></div>
                          </div>
                          <input type="text" class="form-control" id="nombres" name="nombres">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>



                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="telefono">Telefono:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-phone-alt"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control" id="telefono" name="telefono">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="email">Correo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-envelope icon-form"></i></div>
                          </div>
                          <input type="text" class="form-control" id="email" name="email">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>



                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-child"></i></div>
                          </div>
                          <select type="text" class="form-control" id="idcargo" name="idcargo">
                            <option value="0">Seleccione...</option>
                            <?php
                            foreach (getCargo() as $key => $value) {
                              echo '<option value="'.$value['id_cargo'].'">'.$value['nombre_cargo'].'</option>';
                            }
                             ?>

                          </select>
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="area">Area:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-child"></i></div>
                          </div>
                          <select type="text" class="form-control" id="idarea" name="idarea">
                            <option value="0">Seleccione...</option>
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

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="permisos">Dependencia:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-child"></i></div>
                          </div>
                          <select type="text" class="form-control" id="idsede" name="idsede">

                            <option value="0">Seleccione...</option>
                            <?php
                            foreach (getSedes() as $key => $value) {

                              //if ($value['id_usuario'] == null) ?>
                                <option value="<?= $value['id_sede'] ?>">
                                <?= $value['nombre_sede'] ?> -  <?= ($value['id_usuario'] == null)? "Disponible" : "Ocupado" ?></option>;
<?php
                            }
                             ?>
                          </select>
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
                          <div class="custom-file">
                            <label class="custom-file-label" for="imagen"></label>
                            <input type="file" class="custom-file-input " id="imagen" name="imagen">

                          </div>
                          <div class="valid-input invalid-feedback d-block" style="margin-top: .5rem;"></div>
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
  <script type="text/javascript" src="/assets/ajax/usuarios.js"></script>
<?= $this->endSection() ?>
