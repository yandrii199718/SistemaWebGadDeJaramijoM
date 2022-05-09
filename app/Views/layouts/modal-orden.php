<!-- Logout Modal-->
<div class="modal fade" id="modalOrden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="titleModal">CREAR ORDEN</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formularioOrden" action="/ordenes" method="POST">
              <input type="hidden" id="id_orden" name="id_orden" value="0">
              <input type="hidden" id="idcronograma" name="idcronograma" value="0">
                <div class="modal-body">
                  <div class="row">

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="nro_orden">Nº Orden:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="nro_orden" name="nro_orden">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="fecha_orden">Fecha Orden:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="date" class="form-control" id="fecha_orden" name="fecha_orden">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="costo">Costo:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="text" class="form-control" id="costo" name="costo">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="hora_inicio">Hora Inicio:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="time" class="form-control" id="hora_inicio" name="hora_inicio">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="hora_fin">Hora fin:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <input type="time" class="form-control" id="hora_final" name="hora_final">
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="descripcion_servicio">Descripción:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <textarea class="form-control" name="descripcion_servicio" id="descripcion_servicio" rows="2"></textarea>
                          <div class="valid-input invalid-feedback"></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <label for="repuestos_utilizados">Repuestos utilizados:</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                          </div>
                          <textarea class="form-control" name="repuestos_utilizados" id="repuestos_utilizados" rows="2"></textarea>
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
<div class="modal fade" id="modalVerOrden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red-wine text-white">
                <h5 class="modal-title w-100 text-center" id="title-ver-orden">
                  CREAR ORDEN

                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" >
              <div class="row">
                <div class="col-12" id="contenedor-orden">
                      
                </div>
              </div>

            </div>



        </div>
    </div>
</div>



<!-- modal para mostrar la imagen -->
<div class="modal fade" id="modelImagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="img-modal" class="w-100" src="" img="<?= URL_UPLOADS ?>" alt="">
            </div>
        </div>
    </div>
</div>
