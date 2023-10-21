<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos){
		echo "entro";
		/*SET @usu_nombre='Palmaero';
SET @usu_password='4444';
SET @usu_foto='34';
SET @per_nombre='Eddy';
SET @per_apellido='Reyes';
SET @per_cod_sector='2';
SET @per_telefono='8719254';
SET @per_cod_sexo='1';
SET @per_cod_estcivil='1';
SET @per_tipo_doc='1';
SET @per_tipo_persona='1';
SET @per_email='vatuta12@gmail.com';
SET @per_fecha_nac='1';
SET @tel_indicativo_pais    ='849';*/
	/*	$usu_nombre="Victor";
		$usu_password="4444";
		$usu_foto="34";
		$per_nombre="Eddy";
		$per_apellido="Reyes";
		$per_cod_sector="2";
		$per_telefono="8719254";
		$per_cod_sexo="1";
		$per_cod_estcivil="1";
		$per_tipo_doc="1";
		$per_tipo_persona="1";
		$per_email="vatuta12@gmail.com";
		$per_fecha_nac="2022-06-02";
		$tel_indicativo_pais="849";
	//	mysqli_query($MyConnection ,"SET @p0='".$MyParam1."'");

		
		$stmt = Conexion::conectar()->prepare("CALL INSERT_usuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


		  $stmt->bindParam(1, $usu_nombre, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
			  $stmt->bindParam(2, $usu_password, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
			  $stmt->bindParam(3, $usu_foto, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
			  $stmt->bindParam(4, $per_nombre, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
			  $stmt->bindParam(5, $per_apellido, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
			  $stmt->bindParam(6, $per_cod_sector, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
			  $stmt->bindParam(7, $per_telefono, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
			  $stmt->bindParam(8, $per_cod_sexo, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
					$stmt->bindParam(9, $per_cod_estcivil, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
					$stmt->bindParam(10, $per_tipo_doc, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
					$stmt->bindParam(11, $per_tipo_persona, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
					$stmt->bindParam(12, $per_email, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
					$stmt->bindParam(13, $per_fecha_nac, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
					$stmt->bindParam(14, $tel_indicativo_pais, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);*/
					//$stmt = Conexion::conectar()->prepare("");
					$color = 'limitado';
					
					$stmt = Conexion::conectar()->prepare(" CALL pruebaC('$color')");
		echo "<pre>";
           var_dump($stmt);
		echo "</pre>";

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

		$stmt -> bindParam(":nombre", $datos, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 12);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;


	}

}