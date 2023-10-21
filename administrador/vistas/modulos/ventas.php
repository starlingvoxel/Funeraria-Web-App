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
                <h4>Administrar ventas</h4>
                <div class="card-header-action">

                    <div class="buttons">
                        <a href="crear-venta" class="btn btn-outline-primary"><i class="fas fa-plus"
                                style="font-size:8px"></i> Agregar venta</a>
                        <button type="button" class="btn btn-outline-primary" id="daterange-btn">

                            <span>
                                <i class="fal fa-calendar-alt"></i>

                                <?php

                   if(isset($_GET["fechaInicial"])){

                     echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];

                   }else{

                     echo 'Rango de fecha';

                   }

                 ?>
                            </span>

                            <i class="fal fa-caret-down"></i>

                        </button>
                    </div>


                </div>
            </div>


            <div class="card-body">

                <table id="example" class="tablas table table-striped tablas dt-responsive" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th style="width:70px">No factura</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Status</th>
                            <th>Neto</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {

           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td style="text-align: center">'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                  $fechaComparar = date('Y-m-d');
                  if($value["tipo_pago"] == "Credito" && $value["fechaVencimineto"] <= $fechaComparar){

                  echo '<td>  <button style="width:100%" class="btn btn-danger">'.$value["tipo_pago"].' Vencido</button></td>';

                }else if($value["tipo_pago"] == "Credito"){
                  echo '<td>  <button style="width:100%" class="btn btn-warning">'.$value["tipo_pago"].'</button></td>';

                }else{
                    echo '<td > <span class="label label-lg label-light-success label-inline">Pagada</span></td>';
                }

                echo '<td>$ '.number_format($value["neto"],2).'</td>

                  <td>$ '.number_format($value["total"],2).'</td>

                  <td>'.$value["fechaVencimineto"].'</td>

                  <td>

                    <div class="btn-group">



                      <button class="btn btnImprimirFactura" codigoVenta="'.$value["codigo"].'">

                        <i style="color:#6777ef;font-size:1.1rem" class="fad fa-print"></i>

                      </button>';

                      if($_SESSION["perfil"] == "administrador"){

                      echo '

                      <button class="btn btnEliminarVenta" idVenta="'.$value["id"].'"><i style="color:#fc544b;font-size:1.1rem" class="fad fa-trash-alt"></i></button>';

                    }

                    echo '</div>

                  </td>

                </tr>';
            }

        ?>

                    </tbody>

                </table>

                <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();

      ?>


            </div>

        </div>


    </section>

</div>