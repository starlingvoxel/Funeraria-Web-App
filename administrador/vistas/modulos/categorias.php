 <!-- Main Content -->
 <div class="main-content">
        <section class="section">

          <?php

if($_SESSION["perfil"] == "Vendedor"){

echo '<script>

  window.location = "inicio";

</script>';

return;

}

?>

  <div class="card">

    <div class="card-header">
      <h4>Categorias</h4>
      <div class="card-header-action">

        <a href="" class="col-sm-12 btn btn-outline-primary" alt="default" data-toggle="modal" data-target="#modalAgregarCategoria">
          <i class="fas fa-plus" style="font-size:8px"></i> Agregar categoria
        </a>
      </div>

    </div>

    <div class="card-body">

        <table id="example" class="tablas table dt-responsive" style="width:100%">

      <thead>

       <tr>

         <th style="width:10px">#</th>
         <th>Categoria</th>
         <th>Acciones</th>


       </tr>

      </thead>

      <tbody>

      <?php

        $item = null;
        $valor = null;

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        foreach ($categorias as $key => $value) {

          echo ' <tr>

                  <td>'.($key+1).'</td>

                  <td class="text-uppercase">'.$value["categoria"].'</td>

                  <td>

                    <div class="btn-group">

                      <button class="btn btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i style="color:#6777ef;font-size:1.1rem" class="fad fa-edit"></i></button>';

                      if($_SESSION["perfil"] == "administrador"){

                        echo '<button class="btn btnEliminarCategoria" idCategoria="'.$value["id"].'"><i  style="color:#fc544b;font-size:1.1rem" class="fad fa-trash-alt"></i></button>';

                      }

                    echo '</div>';
        }

      ?>


      </tbody>

     </table>

    </div>

  </div>

</section>

</div>

<!--=====================================
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form role="form" method="post">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Categorias</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>



      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="card-body">

          <!-- ENTRADA PARA EL NOMBRE -->

            <div class="input-group">

              <span class="input-group-prepend">
              <div class="input-group-text"><i class="fad fa-th-list"></i></div>
              </span>
              <input type="text" class="form-control input-lg mayus" name="nuevaCategoria" placeholder="Ingresar categoría" required>

            </div>



        </div>

      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar categoría</button>

      </div>

      <?php

        $crearCategoria = new ControladorCategorias();
        $crearCategoria -> ctrCrearCategoria();

      ?>

    </form>

  </div>

</div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form role="form" method="post">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" >
        <h4 class="modal-title">Editar categoría</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="card-body">

          <!-- ENTRADA PARA EL NOMBRE -->

            <div class="input-group">

                <span class="input-group-prepend">
                <div class="input-group-text"><i class="fad fa-th-list"></i></div>
                </span>

              <input type="text" class="form-control input-lg editarMayus" name="editarCategoria" id="editarCategoria" required>

               <input type="hidden"  name="idCategoria" id="idCategoria" required>

            </div>

        </div>

      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>

      </div>

    <?php

        $editarCategoria = new ControladorCategorias();
        $editarCategoria -> ctrEditarCategoria();

      ?>

    </form>

  </div>

</div>

</div>

<?php

$borrarCategoria = new ControladorCategorias();
$borrarCategoria -> ctrBorrarCategoria();

?>
