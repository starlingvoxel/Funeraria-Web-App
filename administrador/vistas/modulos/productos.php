<div class="main-content">
    <section class="section">

        <div class="row">

            <div class="card col-sm-12 col-md-12">
                <div class="card-header">
                    <h4>Productos</h4>
                    <div class="card-header-action">
                        <div class="buttons">
                            <a href="" class=" btn btn-outline-primary" alt="default" data-toggle="modal"
                                data-target="#modalAgregarProducto">
                                <i class="fas fa-plus" style="font-size:8px"></i> Agregar producto
                            </a>
                            <a href="" class=" btn btn-outline-primary pull-right" onclick="window.print();">
                                <i class="fas fa-print" style="font-size:8px"></i> imprimir
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <table id="" class="table table-striped dt-responsive tablaProductos" style="width:100%">
                        <thead>
                            <tr>

                                <th style="width:10px">#</th>
                                <th>Imagen</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Stock</th>
                                <th>Costo</th>
                                <th>Precio</th>

                                <th>Acciones</th>
                            </tr>
                        </thead>

                    </table>


                    <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
                </div>
            </div>
        </div>

    </section>
</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<!-- sample modal content -->
<div id="modalAgregarProducto" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Productos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

                    <div class="form-group">

                        <div class="input-group">



                            <select class="form-control" id="nuevaCategoria" name="nuevaCategoria" required>

                                <option value="">Selecionar categoría</option>

                                <?php

                                $item = null;
                                $valor = null;

                                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                foreach ($categorias as $key => $value) {

                                  echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                                }

                                ?>

                            </select>

                        </div>

                    </div>

                    <!-- ENTRADA PARA EL CÓDIGO -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fad fa-barcode-read"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo"
                                placeholder="Ingresar código" required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA DESCRIPCIÓN -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fad fa-money-check-edit"></i>

                                </div>
                            </span>

                            <input type="text" class="form-control input-lg mayus" id="" name="nuevaDescripcion"
                                placeholder="Ingresar descripción" required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA STOCK -->
                    <div class="row">
                        <div class="form-group col-sm-6 col-12">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-inventory"></i>
                                    </div>
                                </span>
                                <input type="number" class="form-control input-lg" name="nuevoStock" min="0"
                                    placeholder="Stock" required>

                            </div>

                        </div>
                        <!-- ENTRADA PARA PRECIO COMPRA -->
                        <div class="form-group col-sm-6">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-coins"></i>
                                    </div>
                                </span>

                                <input type="number" class="form-control input-lg" id="nuevoPrecioCompra"
                                    name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>

                            </div>

                        </div>

                    </div>




                    <div class=" row">



                        <!-- ENTRADA PARA PRECIO VENTA -->

                        <div class="form-group col-sm-6 ">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-donate"></i>
                                    </div>
                                </span>

                                <input type="number" class="form-control input-lg" id="nuevoPrecioVenta"
                                    name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>

                            </div>


                        </div>
                        <br>



                        <!-- ENTRADA PARA PORCENTAJE -->

                        <div class="form-group col-6 col-sm-6">

                            <div class="input-group">

                                <input type="number" class="form-control nuevoPorcentaje" min="0" value="30" required>

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-percent"></i>
                                    </div>
                                </span>

                            </div>

                        </div>

                    </div>

                    <!-- ENTRADA PARA SUBIR FOTO -->
                    <div class="row">
                        <div class="panel col-12">Subir imagen <small class="help-block" style="">Peso máximo
                                2MB</small></div>
                        <div class="form-group custom-file col-12">



                            <input type="file" class="nuevaImagen custom-file-input custom-file-input"
                                name="nuevaImagen" value="vistas/img/example-image.jpg" id="customFile" lang="es"
                                required>
                            <label class="custom-file-label nuevaImagen border-container" for="customFile"
                                style="margin:3px 15px 0 12px; height:auto " lang="es">

                                <div class="" style="margin: 0 auto;width:100px;">
                                    <img src="vistas/img/news/share-post1.svg"
                                        style="width: auto;border:none;height:130px"
                                        class=" img-thumbnail previsualizar" width="200px" height="200px">
                                </div>
                            </label>


                        </div>

                        <div class="col-12">

                        </div>
                    </div>


                </div>

                <div class="modal-footer" style="margin-top:70px">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect">Guardar cambios</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>

        <?php

         $crearProducto = new ControladorProductos();
         $crearProducto -> ctrCrearProducto();

       ?>


    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- editar modal content -->
<div id="modalEditarProducto" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Editar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

                    <div class="form-group">

                        <div class="input-group">



                            <select class="form-control" name="editarCategoria" required>

                                <option id="editarCategoria"></option>

                            </select>

                        </div>

                    </div>

                    <!-- ENTRADA PARA EL CÓDIGO -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fad fa-barcode-read"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo"
                                placeholder="Ingresar código" required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA DESCRIPCIÓN -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fad fa-money-check-edit"></i>

                                </div>
                            </span>

                            <input type="text" class="form-control input-lg editarMayus" id="editarDescripcion"
                                name="editarDescripcion" placeholder="Ingresar descripción" required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA STOCK -->
                    <div class="row">
                        <div class="form-group col-sm-6 col-12">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-inventory"></i>
                                    </div>
                                </span>
                                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock"
                                    min="0" placeholder="Stock" required>

                            </div>

                        </div>
                        <!-- ENTRADA PARA PRECIO COMPRA -->
                        <div class="form-group col-sm-6">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-coins"></i>
                                    </div>
                                </span>

                                <input type="number" class="form-control input-lg" id="editarPrecioCompra"
                                    name="editarPrecioCompra" step="any" min="0" placeholder="Precio de compra"
                                    required>

                            </div>

                        </div>

                    </div>

                    <div class=" row">

                        <!-- ENTRADA PARA PRECIO VENTA -->

                        <div class="form-group col-sm-6 ">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-donate"></i>
                                    </div>
                                </span>

                                <input type="number" class="form-control input-lg" id="editarPrecioVenta"
                                    name="editarPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>

                            </div>


                        </div>
                        <br>

                        <!-- CHECKBOX PARA PORCENTAJE -->



                        <!-- ENTRADA PARA PORCENTAJE -->

                        <div class="form-group col-6 ">

                            <div class="input-group">

                                <input type="number" class="form-control nuevoPorcentaje" min="0" value="30" required>

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fad fa-percent"></i>
                                    </div>
                                </span>

                            </div>

                        </div>

                    </div>

                    <!-- ENTRADA PARA SUBIR FOTO -->

                    <div class="panel col-12">Subir imagen <small class="help-block" style="">Peso máximo 2MB</small>
                    </div>
                    <div class="form-group custom-file col-12">
                        <input type="file" class="nuevaImagen custom-file-input custom-file-input" name="editarImagen"
                            id="customFile" lang="es">
                        <label class="custom-file-label nuevaImagen border-container" for="customFile"
                            style="margin:3px 15px 0 12px; height:auto " lang="es">
                            <div class="" style="margin: 0 auto;width:175px;">
                                <img src="vistas/img/news/share-post1.svg" style="border:none;height:130px"
                                    class=" img-thumbnail previsualizar" width="200px" height="200px">
                                <input type="hidden" name="imagenActual" id="imagenActual">
                            </div>
                        </label>
                    </div>

                    <div class="col-12">

                    </div>


                </div>

                <div class="modal-footer" style="margin-top:70px">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect">Guardar cambios</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>

        <?php

         $editarProducto = new ControladorProductos();
         $editarProducto -> ctrEditarProducto();

       ?>


    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->





<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->


<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>