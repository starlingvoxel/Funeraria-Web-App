
<div class="main-content">
   <section class="section">

     <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Miembro</h4>
            </div>
            <div class="card-body">
                  <form class="" method="post">

                    <div class="row">

                      <div class="col-md-4">
                          <label>Informacion personal:</label>


                      </div>
                      <!--=====================================
                      ENTRADA NOMBRE
                      ======================================-->
                      <div class="form-group col-12 col-sm-4 pull-right">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                      </div>

                      <!--=====================================
                      ENTRADA APELLIDO
                      ======================================-->
                      <div class="form-group col-sm-12 col-md-4 pull-right">
                        <label>Apellido:</label>
                        <input type="text" name="apellido" class="form-control" required>
                      </div>

                      <!--=====================================
                      ENTRADA DOCUMENTO
                      ======================================-->
                      <div class="form-group col-sm-12 col-md-6 pull-right">
                        <label>Documento:</label>
                        <input type="number" name="documento" class="form-control" required>
                      </div>

                      <!--=====================================
                      ENTRADA FECHA DE NACIMIENTO
                      ======================================-->
                      <div class="form-group col-sm-12 col-md-6">
                        <label>Fecha de nacimineto:</label>
                        <input type="date" name="fechaNac" class="form-control" required>
                      </div>

                      <div class="form-group col-sm-12">
                        <label>Dirrecion:</label>
                        <input type="text" name="dirrecion" class="form-control" required>
                      </div>

                      <!--=====================================
                      ENTRADA VOCACION
                      ======================================-->
                      <div class="form-group col-sm-12 col-md-6">
                        <label>Vocacion</label>
                          <select class="form-control" name="vocacion" required>
                            <option>Selecciona una vocacion</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                          </select>
                      </div>

                      <!--=====================================
                      ENTRADA
                      ======================================-->
                      <div class="form-group col-sm-12 col-md-6">
                        <label>Nivel Academico</label>
                          <select class="form-control">
                            <option>Selecciona un nivel academico</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                          </select>
                      </div>

                      <!--=====================================
                      ENTRADA
                      ======================================-->

                      <div class="form-group col-sm-12 col-md-6">
                        <label>Phone Number (US Format)</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-phone"></i>
                              </div>
                            </div>
                            <input type="number" name="telefono" class="form-control phone-number">
                          </div>
                       </div>



                      <button type="submit" class="btn btn-primary mb-2">Submit</button>

                    </div>

                    </div>

                  </form>



   </section>
</div>



<!-- sample modal content -->
<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Miembros</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
