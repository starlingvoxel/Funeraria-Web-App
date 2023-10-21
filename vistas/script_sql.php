<?php

/*SELECT * FROM planes 
INNER JOIN planes_servicios 
ON planes.id_plan = planes_servicios.cod_plan 
INNER JOIN servicio 
ON planes_servicios.cod_serv = servicio.id_servicio;
*/
$sql = " SELECT * FROM planes";
                    $sql .= " INNER JOIN planes_servicios";   
                    $sql .= " ON planes.id_plan = planes_servicios.cod_plan"; 
                    $sql .= " INNER JOIN servicio";
                    $sql .= " ON planes_servicios.cod_serv = servicio.id_servicio";

                  

?>



<section class="seccion contenedor">

    <h2>Calendario de Eventos</h2>



    <?php

    try {

      require_once('includes/funciones/bd_conexion.php');

      $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";

      $sql .= " FROM eventos ";

      $sql .= " INNER JOIN categoria_evento ";

      $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";

      $sql .= " INNER JOIN invitados ";

      $sql .= " ON eventos.id_inv = invitados.invitado_id ";

      $sql .= " ORDER BY evento_id ";

      $resultado = $conn->query($sql);

    } catch (\Exception $e) {

      echo $e->getMessage();

    }



    ?>



    <div class="calendario">

        <?php

        $calendario = array();

        while($eventos = $resultado->fetch_assoc()) {





          //obtiene la fecha del eventos



          $fecha = $eventos['fecha_evento'];



          $evento = array(

            'titulo' => $eventos['nombre_evento'],

            'fecha' => $eventos['fecha_evento'],

            'hora' => $eventos['hora_evento'],

            'categoria' => $eventos['cat_evento'],

            'icono' => 'fa'. " " . $eventos['icono'],

            'invitado' => $eventos['nombre_invitado'] . " " . $eventos ['apellido_invitado']



          );



          $calendario[$fecha][] = $evento;



          ?>

        <?php   }  //wile de fetch_assoc()   ?>





        <?php

        //Imprime todo los eventos

        foreach ($calendario as $dia => $lista_eventos) { ?>

        <h3>

            <i class="fa fa-calendar"></i>

            <?php

            //Cambiar formato de hora de ingles a es unix

            setlocale(LC_TIME, 'es_ES.UTF-8');

            //windows

            setlocale(LC_TIME, 'spanish');

            //fecha en ingles y no deja modificaciones con los formatos de arriba

//             echo date( "F j, Y", strtotime($dia) );

            echo strftime( "%A, %d de %B del %Y ", strtotime($dia) );  ?>

        </h3>

        <?php foreach ($lista_eventos as $eventos) { ?>

        <div class="dia">

            <p class="titulo"><?php echo $evento ['titulo']; ?> </p>

            <p class="hora">

                <i class="fa fa-clock" aria-hidden="true"></i>

                <?php echo $evento['fecha'] . " " . $evento['hora']; ?>

            </p>

            <p>

                <i class="<?php echo $evento['icono']; ?>" aria-hidden="true"></i>

                <?php echo $evento['categoria']; ?>
            </p>

            <p>

                <i class="fa fa-user" aria-hidden="true"></i>

                <?php echo $evento['invitado']; ?>

            </p>





        </div>

        <?php  } //fin foreach eventos ?>



        <?php    } //fin foreach de dias   ?>



        <pre>

          <?php var_dump($calendario); ?>

        </pre>



    </div>



    <?php

      $conn->close();

     ?>



</section>



<?php include_once 'includes/templates/footer.php'; ?>