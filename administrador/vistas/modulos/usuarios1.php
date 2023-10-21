<div class="main-content">
    <section class="section">

        <div class="row">

            <div class="card col-sm-12 col-md-12">
                <div class="card-header">
                    <h4>Usuarios</h4>
                    <div class="card-header-action">
                        <div class="buttons">
                            <a href="" class=" btn btn-outline-primary" alt="default" data-toggle="modal"
                                data-target="#modalAgregarProducto">
                                <i class="fas fa-plus" style="font-size:8px"></i> Agregar usuario
                            </a>
                            <a href="" class=" btn btn-outline-primary pull-right" onclick="window.print();">
                                <i class="fas fa-print" style="font-size:8px"></i> imprimir
                            </a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table dt-responsive tablas" width="100%">


                        <thead>

                            <tr>

                                <th style="width:10px">#</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Foto</th>
                                <th>Perfil</th>
                                <th>Estado</th>
                                <th>Último login</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

$item = null;
$valor = null;

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

foreach ($usuarios as $key => $value){

echo ' <tr>
<td>1</td>
<td>'.$value["nombre"].'</td>
<td>'.$value["usuario"].'</td>';

if($value["foto"] != ""){

echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

}else{

echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

}

echo '<td>'.$value["perfil"].'</td>';

if($value["estado"] != 0){

echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

}else{

echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

}             

echo '<td>'.$value["ultimo_login"].'</td>
<td>

<div class="btn-group">
    
  <button class="btn btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i style="color:#6777ef;font-size:1.1rem" class="fal fa-edit"></i></button>

  <button class="btn btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i style="color:#fc544b;font-size:1.1rem" class="fal fa-trash-alt"></i></button>

</div>  

</td>

</tr>';
}


?>

                        </tbody>

                    </table>


                    <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
                </div>
            </div>
        </div>

    </section>
</div>