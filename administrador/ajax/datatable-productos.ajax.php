<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/

	public function mostrarTablaProductos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}

  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/

		  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
           
		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/

		  	$item = "id";
		  	$valor = $productos[$i]["id_categoria"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		  	/*=============================================
 	 		STOCK
  			=============================================*/

  			if($productos[$i]["stock"] <= 10){

  				$stock = "<span style='width: 80%' class='label label-lg label-light-danger label-inline'>".$productos[$i]["stock"]."</span>";

  			}else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){

  				$stock = "<span style='width: 80%' class='label label-lg label-light-warning label-inline'>".$productos[$i]["stock"]."</span>";

  			}else{

  				$stock = "<span style='width: 80%' class='label label-lg label-light-success label-inline'>".$productos[$i]["stock"]."</span>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fal fa-edit'></i></button></div>";

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn  btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i style='color:#6777ef;font-size:1.1rem' class='fal fa-edit'></i></button><button class='btn btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i style='color:#fc544b;font-size:1.1rem' class='fal fa-trash-alt'></i></button></div>";

  			}


		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$productos[$i]["descripcion"].'",
			      "'.$categorias["categoria"].'",
			      "'.$stock.'",
			      "RD$ '.$productos[$i]["precio_compra"].'",
			      "RD$ '.$productos[$i]["precio_venta"].'",

			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   ']

		 }';

		echo $datosJson;


	}



}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();