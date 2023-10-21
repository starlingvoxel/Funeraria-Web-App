<?php 

require_once "controladores/plantilla.controlador.php";
require_once "controladores/planes.controlador.php";
require_once "controladores/usuario_cliente.controlador.php";

require_once "modelos/planes.modelo.php";
require_once "modelos/usuario_cliente.modelo.php";


session_start();


include_once'includes/templates/head.php'; 
include_once'includes/templates/header.php'; 

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

include_once'includes/templates/footer.php'; 

?>