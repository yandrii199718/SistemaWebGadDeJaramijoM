<?= $this->extend("layouts/template-admin") ?>
<?= $this->section('page_title') ?> Inicio <?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <button class="btn btn-primary btn-crear-provedor" data-toggle="modal" data-target="#modalCrearCliente">
        Registrar Proveedor
    </button>

   
      <a href="<?= base_url().route_to('vendors.report') ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>


  </div>
  

  <div class="row">
        <div class="col">
          <div class="card ">
            <div class="card-body pb-0">
              <div class="d-flex align-items-center align-items-md-start justify-content-between mb-4">
                <h6 class="text-md mb-0">Proveedores Registrados</h6>
                
              </div> <!-- end of d-flex -->
            </div> <!-- end of card-body -->
            <div class="table-responsive">
              <table  id="example" class="table table-hover mb-0" style="width:100%">
              <thead  class="thead-dark">
            <tr>
                <th>Acción</th>
                <th>Ruc</th>
                <th>Razon Social</th>
                <th>rubro</th>
                <th>direccion</th>
                <th>telefono</th>
                <th>email</th>
                <th>tipo</th>


            </tr>
        </thead>
              </table>
             
            </div> <!-- end of table-responsive -->
          </div> <!-- end of card -->
        </div> <!-- end of col -->
      </div> <!-- end of row -->

      </div> 


<!-- Logout Modal-->
<div class="modal fade" id="modalCrearCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="titleModal">CREAR PROVEEDOR</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formProvedor" method="post">
              <input type="hidden" class="form-control" id="id_provedor" name="id_provedor" value="0">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="ruc">Ruc:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="number" class="form-control" id="ruc" name="ruc">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="razon_social">Razon social:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user icon-form"></i></div>
                          </div>
                          <input type="text" class="form-control" id="razon_social" name="razon_social">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="rubro">Rubro:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user icon-form"></i></div>
                          </div>
                          <input type="text" class="form-control" id="rubro" name="rubro">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-address-book"></i></div>
                          </div>
                          <input type="text" class="form-control" id="direccion" name="direccion">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="telefon">Telefono:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-phone-square-alt"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control" id="telefono" name="telefono">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="telefono">Contacto:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="far fa-id-card"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control" id="contacto" name="contacto">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="celular">Celular:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-phone-alt"></i></i></div>
                          </div>
                          <input type="text" class="form-control" id="celular" name="celular">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="email">Correo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-envelope"></i></div>
                          </div>
                          <input type="text" class="form-control" id="email" name="email">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-passport"></i></div>
                          </div>
                          <select class="form-control" id="tipo" name="tipo">
                            <option value="">Seleccione..</option>
                            <option value="PRODUCTO">PRODUCTO</option>
                            <option value="SERVICIO">SERVICIO</option>
                            <option value="AMBOS">AMBOS</option>
                          </select>
                          <div class="valid-input invalid-feedback"></div>

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
  <script type="text/javascript" src="/assets/ajax/provedor.js"></script>
<?= $this->endSection() ?>



<!--
<div class="col-12 col-md-12">
  <div class="form-group">
    <label for="">Imagen:</label>
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-image"></i></div>
      </div>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="imagenusuario" name="imagenusuario">
        <label class="custom-file-label btn btn-primary text-left" for="imagenusuario">prueba</label>
      </div>
    </div>
  </div>
</div>
-->
