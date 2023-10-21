<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Funeraria Alas de Paz</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
        integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <link rel="stylesheet" href="vistas/modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="vistas/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="vistas/modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="vistas/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="vistas/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="vistas/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <!-- CSS Libraries -->

    <link rel="stylesheet" href="vistas/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vistas/dist/assets/owl.theme.default.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="vistas/css/style.css">
    <link rel="stylesheet" href="vistas/css/components.css">
    <link rel="stylesheet" href="vistas/css/newcomponents.css">
    <link rel="stylesheet" href="vistas/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="vistas/dist/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vistas/css/skins/preloader.css">

    <link rel="stylesheet" type="text/css" href="vistas/dist/responsive.bootstrap4.min.css">

    <!-- SweetAlert 2 -->
    <script src="vistas/js/plugings/sweetalert2/sweetalert2.all.js"></script>
    <script>
    window.onload = function() {

        $('#pre').fadeOut();
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="vistas/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="vistas/dist/sparkline.min.js"></script>

    <script src="vistas/modules/jquery-ui/jquery-ui.min.js"></script>

    <script src="vistas/dist/owl.carousel.min.js"></script>
    <script src="vistas/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>

</head>

<body class="layout-3">

    <!--PRELOADER-->
    <div class="preloader" id="pre">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>

    <?php


  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
      /*=============================================
      NAVEGACION MOVIL
      =============================================*/
      echo '<div class="main-wrapper container">';
      include "componentes/navbar.php";

            /*=============================================
                contenido
                =============================================*/
                if(isset($_GET["ruta"])){


                  if ($_GET["ruta"] == "registros" || $_GET["ruta"] == "ajax-tabla") {
                    include "transacciones/".$_GET["ruta"].".php";
                  }
                  else if($_GET["ruta"] == "inicio" ||
                     $_GET["ruta"] == "transacciones" ||
                     $_GET["ruta"] == "categorias" ||
                     $_GET["ruta"] == "miembros" ||
                     $_GET["ruta"] == "productos" ||
                     $_GET["ruta"] == "usuarios1" ||
                     $_GET["ruta"] == "proveedores1" ||
                     $_GET["ruta"] == "ventas" ||
                     $_GET["ruta"] == "crear-venta" ||
                     $_GET["ruta"] == "editar-venta" ||
                     $_GET["ruta"] == "reportes" ||
                     $_GET["ruta"] == "crear-compra" ||
                     $_GET["ruta"] == "clientes" ||
                     $_GET["ruta"] == "parametros" ||
                     $_GET["ruta"] == "cuentasxcobrar" ||
                     $_GET["ruta"] == "Empresa" ||
                     $_GET["ruta"] == "salir"){

                    include "modulos/".$_GET["ruta"].".php";

                  }else{

                    include "modulos/404.php";

                  }

                }else{

                  include "modulos/inicio.php";

                }
      /*=============================================
        FOOTER
      =============================================*/

      include "componentes/footer.php";

      echo '</div>';

 }else{
         include "componentes/login.php";
   }
      ?>




    <script src="vistas/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Page Specific JS File -->
    <?php

    if ($_GET["ruta"] == "inicio") {
    echo'<script src="vistas/js/page/index.js"></script>';
    }  ?>


    <!-- DataTable JS File -->
    <script src="vistas/js/page/bootstrap-modal.js"></script>
    <!-- General JS Scripts -->

    <script src="vistas/modules/datatables/datatables.min.js"></script>
    <script src="vistas/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <script src="vistas/js/plantilla.js"></script>
    <script src="vistas/js/usuarios.js"></script>
    <script src="vistas/js/categorias.js"></script>
    <script src="vistas/js/productos.js"></script>
    <script src="vistas/js/clientes.js"></script>
    <script src="vistas/js/ventas.js"></script>





    <script src="vistas/js/font.js" crossorigin="anonymous">


    </script>
    <!-- Template JS File -->
    <script src="vistas/js/scripts.js"></script>
    <script src="vistas/js/custom.js"></script>


</body>

</html>