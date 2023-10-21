<?php

/*============================================
            INSERTAR ADMIN
============================================*/
if(isset($_POST['agregar-admin'])){

   
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$password = $_POST['password'];

$opciones = array(
'cost' => 12
);
$password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

try{
    include_once'funciones/funciones.php'; 
    $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, apellido, password) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $usuario, $nombre, $apellido, $password_hashed); 
    $stmt->execute();
    $id_registro = $stmt->insert_id;
    
    if($id_registro > 0){
        $respuesta = array(
            'respuesta' => 'exito',
            'id_admin' => $id_registro

        );
    }else{
        $respuesta = array(
            'respuesta' => 'error',
            'id_admin' => $id_registro
        );
    }
    $stmt->close();
    $conn->close();
}catch(Exception $e){
    echo "Error: " . $e->getMessage();
}
die(json_encode($respuesta));

}

/*============================================
            LOGIN
============================================*/

if(isset($_POST['login-admin'])){

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try{
        include_once'funciones/funciones.php'; 
        $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?;");
        $stmt->bind_param("s", $usuario); 
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $apellido_admin, $password_admin);

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