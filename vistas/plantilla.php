<?php



?>

<body>
    <div class="wrapper">
        <?php

                if(isset($_GET["ruta"])){
                    if(
                    $_GET["ruta"] == "inicio" || 
                    $_GET["ruta"] == "contacto" ||
                    $_GET["ruta"] == "planes" ||
                    $_GET["ruta"] == "checkout" ||
                    $_GET["ruta"] == "login" ||
                    $_GET["ruta"] == "perfil" ||
                    $_GET["ruta"] == "servicios" ||
                    $_GET["ruta"] == "registro" ||
                    $_GET["ruta"] == "salir"){
                        
                        include "modulos/".$_GET["ruta"].".php";
                    
                    }else{
                        include "modulos/404.php";
                    }
                }else{

                    include "modulos/inicio.php";
                    
                  }
                 
?>