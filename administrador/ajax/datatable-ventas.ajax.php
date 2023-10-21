<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/

	public function mostrarTablaProductosVentas(){

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

		  	//$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		STOCK
  			=============================================*/

  			if($productos[$i]["stock"] <= 10){

  				$stock = "<span style='width: 100%' class='label label-lg label-light-danger label-inline'>".$productos[$i]["stock"]."</span>";

  			}else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){

  				$stock = "<span style='width: 100%' class='label label-lg label-light-warning label-inline'>".$productos[$i]["stock"]."</span>";

  			}else{

  				$stock = "<span style='width: 100%' class='label label-lg label-light-success label-inline'>".$productos[$i]["stock"]."</span>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/


		  	$botones =  "<div class='buttons'><button class='btn btn-outline-primary btn-sinHover agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'  style='color: #6993ff;background-color: #f3f6f9;border-color: transparent;'>".$productos[$i]["codigo"]."</button></div> ";
	 //$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>";
		  	$datosJson .='[


			      "'.$botones.'",
			      "'.$productos[$i]["descripcion"].'",
						"'.$productos[$i]["precio_venta"].'",
			      "'.$stock.'"

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
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();
