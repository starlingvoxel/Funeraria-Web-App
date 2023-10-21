<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="main-content">


    <section class="content">

        <div class="card">
            <div class="card-header">
                <h4>Clientes</h4>
                <div class="card-header-action">

                    <a href="" class=" btn btn-outline-primary" alt="default" data-toggle="modal"
                        data-target="#modalAgregarCliente">
                        <i class="fas fa-plus" style="font-size:8px"></i> Agregar producto
                    </a>

                </div>
            </div>


            <div class="card-body">

                <table id="example" class="table table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Total compras</th>
                            <th>Última compra</th>
                            <th>Ingreso al sistema</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

          $item = null;
          $valor = null;

          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

          foreach ($clientes as $key => $value) {


            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>



                    <td>'.$value["telefono"].'</td>


                    <td>'.$value["compras"].'</td>

                    <td>'.$value["ultima_compra"].'</td>

                    <td>'.$value["fecha"].'</td>

                    <td>

                      <div class="btn-group">
                        <button class="btn btnVerCliente" data-toggle="modal" data-target="#modalVerCliente" idCliente="'.$value["id"].'">
                        <i style="color:#6777ef;font-size:1.1rem" class="fad fa-expand-wide"></i></button>
                        <button class="btn btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'">
                        <i style="color:#6777ef;font-size:1.1rem" class="fad fa-edit"></i></button>';//i class="fas fa-expand-arrows-alt"


                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btnEliminarCliente" idCliente="'.$value["id"].'"><i style="color:#fc544b;font-size:1.1rem" class="fad fa-trash-alt"></i></button>';

                      }

                      echo '</div>

                    </td>

                  </tr>';

            }

        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header">
                    <h4 class="modal-title">Agregar cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>



                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fal fa-user"></i>
                                    </div>
                                </span>
                                <input type="text" class="form-control input-lg" name="nuevoCliente"
                                    placeholder="Ingresar nombre" required>


                            </div>

                        </div>

                        <!-- ENTRADA PARA EL DOCUMENTO ID -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fal fa-credit-card-blank"></i>
                                    </div>

                                </span>

                                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId"
                                    placeholder="Ingresar documento" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fal fa-envelope"></i>
                                    </div>

                                </span>

                                <input type="email" class="form-control input-lg" name="nuevoEmail"
                                    placeholder="Ingresar email" value="INFO@INFO" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL TELÉFONO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fal fa-phone"></i>
                                    </div>
                                </span>

                                <input type="text" class="form-control input-lg" name="nuevoTelefono"
                                    placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask
                                    required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA DIRECCIÓN -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fal fa-map-marker"></i>
                                    </div>
                                </span>

                                <input type="text" class="form-control input-lg" name="nuevaDireccion"
                                    placeholder="Ingresar dirección" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fal fa-calendar"></i>
                                    </div>
                                </span>
                                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento"
                                    placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'"
                                    data-mask required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cliente</button>

                </div>

            </form>

            <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header">

                    <h4 class="modal-title">Editar cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">



                    <!-- ENTRADA PARA EL NOMBRE -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-user"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente"
                                required>
                            <input type="hidden" id="idCliente" name="idCliente">
                        </div>

                    </div>

                    <!-- ENTRADA PARA EL DOCUMENTO ID -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-key"></i>
                                </div>
                            </span>

                            <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId"
                                id="editarDocumentoId" required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA EL EMAIL -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-envelope"></i>
                                </div>
                            </span>

                            <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail"
                                required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA EL TELÉFONO -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-phone"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono"
                                data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA DIRECCIÓN -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-map-marker"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion"
                                required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-calendar"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="editarFechaNacimiento"
                                id="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

                        </div>

                    </div>



                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>

            </form>

            <?php

        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();

      ?>



        </div>

    </div>

</div>

<!--=====================================
MODAL VER CLIENTE
======================================-->
<div id="modalVerCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header">

                    <h4 class="modal-title">Detalle cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">



                    <!-- ENTRADA PARA EL NOMBRE -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-user"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="VerCliente" id="VerCliente" required>
                            <input type="hidden" id="idCliente" name="idCliente">
                        </div>

                    </div>

                    <!-- ENTRADA PARA EL DOCUMENTO ID -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-key"></i>
                                </div>
                            </span>

                            <input type="number" min="0" class="form-control input-lg" name="VerDocumentoId"
                                id="VerDocumentoId" required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA EL EMAIL -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-envelope"></i>
                                </div>
                            </span>

                            <input type="email" class="form-control input-lg" name="VerEmail" id="VerEmail" required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA EL TELÉFONO -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-phone"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="VerTelefono" id="VerTelefono"
                                data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA DIRECCIÓN -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-map-marker"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="VerDireccion" id="VerDireccion"
                                required>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                    <div class="form-group">

                        <div class="input-group">

                            <span class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fal fa-calendar"></i>
                                </div>
                            </span>

                            <input type="text" class="form-control input-lg" name="VerFechaNacimiento"
                                id="VerFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

                        </div>

                    </div>



                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>



                </div>

            </form>

            <?php

        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();

      ?>



        </div>

    </div>

</div>


<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>