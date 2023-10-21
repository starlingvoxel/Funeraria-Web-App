<div class="clearfix"></div>
<div class="page_head wow fadeInUp">
    <div class="container">
        <ul class="bcrumbs pull-right">
            <li><a href="inicio">Home</a></li>
            <li><?php echo ($_GET['ruta']);?></li>
        </ul>
    </div>
</div>
<div class="pricing-content padding-top-20 padding-bottom-70">
    <div class="container">
        <div class="section-head text-center margin-bottom-40 wow fadeInUpBig">
            <h3 class="h2">Nuestros planes de precios</h3>
            <p>Ver y comparar planes.</p>
        </div>

        <div class="clearfix"></div>
        <div class="pricing-1 wow fadeInUpBig" style="visibility: visible; animation-name: fadeInUpBig;">
            <div class="pricing-1-inner">
                <?php
                 $item = null;
                 $item1 = "id_plan";
                 $valor = null;
                $planes = ControladorPlanes::ctrMostrarplanes($item1, $valor);
                $servicios = ControladorPlanes::ctrMostrarServicios($item, $valor);
                $plan_ser = ControladorPlanes::ctrMostrarServiciosPlanes($item, $valor);
              ?>
                <ol>
                    <li></li>
                    <?php 
                        foreach ($planes as $key => $lista_planes) {  ?>

                    <li>
                        <p><?php echo $lista_planes['descripcion'] ?></p>
                    </li>

                    <?php }  //fin foreach PLANES?>
                </ol>
                <ul>
                    <li>
                        <p>Servicios</p>
                    </li>
                    <?php foreach ($planes as $key => $precio) { ?>

                    <li>
                        <p>$<?php echo $precio['precio'] ?></p>
                    </li>

                    <?php }  //fin foreach PRECIO?>
                </ul>
                <?php 
                     
                
                foreach ($servicios as $key => $lista_servicios) {  
                   
                    ?>

                <ul>
                    <li>
                        <p><?php echo $lista_servicios['descrip_servicio'] ?></p>
                    </li>
                    <?php foreach ($plan_ser as $key => $combi) {  
                        
                        if($lista_servicios['id_servicio'] == $combi['cod_serv'] ){?>
                    <li><i class="flaticon-check"></i></li>
                    <?php }else{
                        //echo " <li> </li>";
                       
                    }}?>
                </ul>



                <?php  } //fin foreach SERVICIOS  ?>
                <div class="margin-bottom-30"></div>
                <div class="clearfix"></div>
                <ul>
                    <li>
                    </li>
                    <?php 
                    
                
                    foreach ($planes as $key => $valor) {  ?>

                    <li>
                        <form class="form-horizontal form-material" id="agregar-planes" name="agregar-planes"
                            method="post" action="checkout">
                            <input type="hidden" name="precio" value=<?php echo $valor['precio'];?>>
                            <input type="hidden" name="plan" value=<?php echo $valor['descripcion'];?>>
                            <button type="submit" class=" btn btn-primary btn-md">Elegir Plan</button>
                        </form>
                    </li>
                    <?php }  //fin foreach BOTONES?>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>