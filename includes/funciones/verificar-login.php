<?php

/*============================================
            LOGIN
============================================*/

if(isset($_POST['login-usuario'])){

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try{
        include_once'bd_conexion.php'; 
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE usuario = ?;");
        $stmt->bind_param("s", $usuario); 
        $stmt->execute();
        $stmt->bind_result($id_usuario, $usuario_usuario, $nombre_usuario, $apellido_usuario, $email_usuario, $password_usuario, $telefono_usuario, $admin, $usuario);

        if($stmt->affected_rows){
           $exite = $stmt->fetch();
           if($exite){
                session_start();
                $_SESSION['usuario'] = $usuario_admin;
                $_SESSION['nombre'] = $nombre_admin;
                $_SESSION['apellido'] = $apellido_admin;
                if(password_verify( $password,  $password_admin)) {
                    //Inicia sesión
                   
                     $respuesta = array(
                         'respuesta' => 'exitoso',
                         'usuario' => $nombre_admin
                     );
                  } else {
                     $respuesta = array(
                         'respuesta' => 'error'
                     );
                  }
       
        }else{
            $respuesta = array(
                'respuesta' => 'error'
               
            );
        }
        }
        $stmt->close();
        $conn->close();
        
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}