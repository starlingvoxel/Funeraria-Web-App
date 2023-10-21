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
      <!--=====================================
      EL FORMULARIO
      ======================================-->
    <div class="row">
      <div class="card col-12">
        <div class="card-header"><h4>Administrar ventas</h4></div>
              <form role="form" method="post" class="formularioVenta">
                <div class="card-body">
                  <div class="form-row">
                    <!--=====================================
                    ENTRADA DEL CÓDIGO
                    ======================================-->

                    <div class="form-group col-6 col-sm-6 col-md-3 ">
                      <label>No factura:</label>

                      <div class="input-group">
                      <?php

                      $item = null;
                      $valor = null;

                      $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                      if(!$ventas){

                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                      }else{

                        foreach ($ventas as $key => $value) {


                        }

                        $codigo = $value["codigo"] + 1;

                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';


                      }

                      ?>


                    </div>

                    </div>

                    <!--=====================================
                    ENTRADA DEL VENDEDOR
                    ======================================-->

                    <div class="form-group col-6 col-sm-6 col-md-3">

                      <label>Vendedor:</label>

                      <div class="input-group">

                      <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                      <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                    </div>


                    </div>

                    <!--=====================================
                    ENTRADA DEL CLIENTE
                    ======================================-->

                    <div class="form-group col-sm-12">

                      <label>Vendido a:</label>

                        <div class="input-group">
                      <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                      <option value="">Seleccionar cliente</option>

                      <?php

                        $item = null;
                        $valor = null;

                        $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                         foreach ($categorias as $key => $value) {

                           echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                         }

                      ?>

                      </select>

                      <span class="input-group-addon">
                        <button type="button" class="btn btn-default btn-sm"
                        data-toggle="modal" data-target="#modalAgregarCliente" data-dimdiss="modal">
                          Agregar cliente</button>
                        </span>

                    </div>

                    </div>

                    <!--=====================================
                    ENTRADA DEL TIPO DE PAGO
                    ======================================-->

                    <div class="form-group col-6 col-sm-6 col-md-5 ">

                      <div>

                          <label>Pago:</label>
                        <div class="input-group">

                            <select class="form-control" id="nuevoTipoPago" name="nuevoTipoPago"  required>

                                <option value="">Seleccione</option>
                                <option value="Efec">Contado</option>
                                <option value="C">Crédito</option>

                            </select>

                        </div>

                      </div>

                        <input type="hidden" id="listaTipoPago" name="listaTipoPago">

                    </div>


                    <!--=====================================
                          ENTRADA DE LA FECHA Vencimineto
                          ======================================-->

                          <div class="form-group col-6 col-sm-6 col-md-5 ">
                            <label>Vence:</label>

                            <?php $fecha_actual = date('m/d/Y'); ?>
                            <div class="input-group ">
                              <span class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fal fa-calendar"></i>
                                </div>
                              </span>

                              <input type="text" name="nuevaFechaVencimineto" class="form-control pull-right" id="datepicker" value="<?php echo $fecha_actual?>">
                            </div>


                            <!-- /.input group -->
                          </div>

                    <!--=====================================
                        BOTON + AGREGAR ARTICULO
                      ======================================-->

                      <div class="form-group col-sm-12">
                       <a data-toggle="modal" href="#myModal" id="btnAgregarArt"><i class="fal fa-plus" style="font-size:11px"></i>  Agregar articulos

                       </a>
                      </div>



                    <!--=====================================
                        TABLA DE PRODUCTOS
                        ======================================-->

                        <div class="col-12">

                          <table class="table" style="margin-bottom:0px">

                            <thead>
                              <tr>
                                <th style="width:50%;padding:0">Descripcion</th>
                                <th style="width:17%;padding:0px 5px 0px 0px">Cant</th>
                                <th style="width:17%;padding:0px 5px 0px 0px">Precio unidad</th>
                                <th style="width:16%;padding:0px 5px 0px 0px">Sub Total</th>
                              </tr>

                            </thead>



                          </table>

                        </div>

                    <!--=====================================
                      ENTRADA PARA AGREGAR PRODUCTO
                      ======================================-->

                      <div class="col-12 nuevoProducto">



                      </div>

                      <input type="hidden" id="listaProductos" name="listaProductos">

                      <hr>

                          <!--=====================================
                          ENTRADA COMENTARIO
                          ======================================-->
                          <div class="form-group col-12 col-sm-12 col-md-6" >
                            <label>Comentario:</label>
                            <textarea class="form-control" style="height:84px" rows="3" id="nuevoComentarioVenta" name="nuevoComentarioVenta"></textarea>
                          </div>

                          <!--=====================================
                          ENTRADA IMPUESTOS Y TOTAL
                          ======================================-->

                          <div class="col-sm-12 col-md-6">

                            <table class="table">

                              <thead>

                                <tr>
                                  <th style="padding:0">Impuesto</th>
                                  <th style="padding:0">Total</th>
                                </tr>

                              </thead>

                              <tbody>

                                <tr>

                                  <td style="width: 50%;padding:0 10px 0 0">

                                    <div class="input-group">

                                      <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required value="0">

                                       <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                                       <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                                       <span class="input-group-prepend">
                                         <div class="input-group-text">
                                           <i class="fal fa-percent"></i>
                                         </div>
                                       </span>

                                    </div>

                                  </td>

                                   <td style="width: 50%;padding:0">

                                    <div class="input-group">

                                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                      <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                                      <input type="hidden" name="totalVenta" id="totalVenta">


                                    </div>

                                  </td>

                                </tr>

                              </tbody>

                            </table>

                          </div>

                          <!--=====================================
                              ENTRADA MÉTODO DE PAGO
                              ======================================-->

                              <div class="form-row col-12 col-m4">

                                <div class="form-group col-sm-4">
                                  <label>Metodo de Pago:</label>
                                   <div class="input-group">

                                    <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                      <option value="">Seleccione método de pago</option>
                                      <option value="Efectivo">Efectivo</option>
                                      <option value="TC">Tarjeta Crédito</option>
                                      <option value="TD">Tarjeta Débito</option>
                                    </select>

                                  </div>

                                </div>

                                <div class="form-row cajasMetodoPago col-sm-8" style="padding-right:0px"></div>

                                <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                              </div>


                  </div> <!-- form-row -->
                </div> <!-- card-body -->
                <!--=====================================
                BOX FOOTER
                ======================================-->
                <div class="card-footer">
                  <!-- boton deshabilitado de ipirmir ticket de ventas -->
                <!--  <button style="margin-bottom: 3px;" type="submit" id="enviar1" name="enviar1" class="btn  btn-outline-success col-sm-12 col-md-2 pull-right" value="0">Guardar e Imprimir</button>-->

                  <button style="margin-bottom: 2%;float: right !important;" name="enviar1" value="1" type="submit"  class="btn btn-success col-sm-12 col-md-2 pull-right ">Guardar</button>

                </div>

              </form>
      </div>
    </div>
  </section>
</div>


        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();

        ?>









<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class=" modal-dialog" ><!--style="width: 65% !important;"-->
    <div class=" modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Productos</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

      <div class="modal-body">

        <table  style="width: 100%" id="tblarticulos" class="table tablaVentas">
          <thead>

           <th style="text-align:center">Código</th>
           <th style="weight:40%;">Descrip.</th>
           <th style="weight:15%;">Precio</th>
           <th style="weight:15px">Stock</th>
          </thead>
          <tbody>

          </tbody>

        </table>

      </div>
      <div class="modal-footer">
        <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
