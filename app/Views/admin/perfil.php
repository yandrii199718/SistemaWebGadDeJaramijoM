<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>


<div class="container-fluid">

<div class="col-12">
  <h2>Perfil de <?= session('nombres') ?></h2>
  <hr class="mb-2">
</div>

<div class="col-12">
  <img src="<?php
  if(session('imagen') == 'no_image.jpg'){
    $imagen = URL_UPLOADS.'usuarios/0/'.session('imagen');
  } else {
    $imagen = URL_UPLOADS.'usuarios/'.session('id').'/'.session('imagen');
  }
  echo $imagen;
  ?>" alt="" width="100">

</div>

<form action="perfil/update" method="post" enctype="multipart/form-data">
  <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?= session('id') ?>">
    <div class="modal-body">
      <div class="row">

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="usuario">Usuario:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-envelope"></i>
                </div>
              </div>
              <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $usuario[0]['usuario'] ?>">
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
            <label for="dni">CI:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-id-card"></i></div>
              </div>
              <input type="number" class="form-control" id="dni" name="dni" value="<?= $usuario[0]['dni'] ?>">
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
              <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $usuario[0]['nombres'] ?>">
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
              <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $usuario[0]['telefono'] ?>">
              <div class="valid-input invalid-feedback"></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="email">Correo:</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user icon-form"></i></div>
              </div>
              <input type="text" class="form-control" id="email" name="email" value="<?= $usuario[0]['email'] ?>">
              <div class="valid-input invalid-feedback"></div>
            </div>
          </div>
        </div>



        <div class="col-12 col-md-6">
          <div class="form-group">
            <label for="cargo">Cargo:</label>

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-passport"></i></div>
              </div>
              <select type="text" class="form-control" id="idcargo" name="idcargo">
                <option value="">Seleccione...</option>
                <?php
                foreach (getCargo() as $key => $value) {
                  if(session('rol') != ROL_ADMIN){
                    if($value['nombre_cargo'] != ROL_ADMIN){
                      if($usuario[0]['idcargo'] == $value['id_cargo']){
                        echo '<option value="'.$value['id_cargo'].'" selected>'.$value['nombre_cargo'].'</option>';
                      } else {
                        echo '<option value="'.$value['id_cargo'].'">'.$value['nombre_cargo'].'</option>';
                      }
                    }
                  } else {
                    if($usuario[0]['idcargo'] == $value['id_cargo']){
                      echo '<option value="'.$value['id_cargo'].'" selected>'.$value['nombre_cargo'].'</option>';
                    } else {
                      echo '<option value="'.$value['id_cargo'].'">'.$value['nombre_cargo'].'</option>';
                    }
                  }
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
                <div class="input-group-text"><i class="fas fa-passport"></i></div>
              </div>
              <select type="text" class="form-control" id="idarea" name="idarea">
                <option value="">Seleccione...</option>
                <?php
                foreach (getArea() as $key => $value) {
                  if($usuario[0]['idarea'] == $value['id_area']){
                    echo '<option value="'.$value['id_area'].'" selected>'.$value['nombre_area'].'</option>';
                  } else {
                    echo '<option value="'.$value['id_area'].'">'.$value['nombre_area'].'</option>';
                  }

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
                <div class="input-group-text"><i class="fas fa-passport"></i></div>
              </div>
              <select type="text" class="form-control" id="idsede" name="idsede" <?= (session('rol') == ROL_ADMIN) ? '' : 'readonly' ?>>
                <?php if(session('rol') == ROL_ADMIN)
                 echo '<option value="">Seleccione...</option>';
                foreach (getSedes() as $key => $value) {
                  if(session('rol') == ROL_ADMIN){
                    if($usuario[0]['idsede'] == $value['id_sede']){
                      echo '<option value="'.$value['id_sede'].'" selected>'.$value['nombre_sede'].'</option>';
                    } else {
                      echo '<option value="'.$value['id_sede'].'">'.$value['nombre_sede'].'</option>';
                    }
                  } else {
                    if($usuario[0]['idsede'] == $value['id_sede']){
                      echo '<option value="'.$value['id_sede'].'" selected  >'.$value['nombre_sede'].'</option>';
                    }
                  }

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
                <label class="custom-file-label btn btn-light text-left" for="imagen">
                  <?= $usuario[0]['imagen'] ?>
                </label>
                <input type="file" class="custom-file-input" id="imagen" name="imagen">

              </div>
              <div class="valid-input invalid-feedback d-block" style="margin-top: .5rem;"></div>
            </div>

          </div>
        </div>

      </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary color-btn" name="button">Editar Perfil</button>
    </div>
</form>


</div>


<?= $this->endSection() ?>
<?= $this->section('script') ?>
  <!--<script type="text/javascript" src="/assets/ajax/areas.js"></script>-->
<?= $this->endSection() ?>
