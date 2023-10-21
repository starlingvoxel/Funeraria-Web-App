<?php

class Controladorplanes{

	/*=============================================
	MOSTRAR planes
	=============================================*/

	static public function ctrMostrarplanes($item, $valor){

		$tabla = "planes";

		$respuesta = Modeloplanes::mdlMostrar($tabla, $item, $valor);

		return $respuesta;

	}
		/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/

	static public function ctrMostrarServicios($item, $valor){

		$tabla = "servicio";

		$respuesta = Modeloplanes::mdlMostrar($tabla, $item, $valor);

		return $respuesta;

	}
		/*=============================================
	MOSTRAR planes y servicios
	=============================================*/

	static public function ctrMostrarServiciosPlanes($item, $valor){

		$tabla = "planes";

		$respuesta = Modeloplanes::mdlMostrarServiciosPlanes($tabla, $item, $valor);

		return $respuesta;

	}
}