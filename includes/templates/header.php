<header class="header4" style="top: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-8">
                <a href="inicio" class="navbar-brand"><img src="img/logo1 - copia.png" class="img-responsive"
                        alt=""></a>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-4">

                <nav class="navbar navbar-default">
                    <div class="container">
                        <!-- ============================================================== 
                                                NAVBAR MOVIL
                         ============================================================== -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span>
                                <em></em>
                                <em></em>
                                <em></em>
                            </span>
                        </button>
                        <!-- ============================================================== 
                                                NAVBAR MOVIL
                         ============================================================== -->

                        <div id="navbar" class="navbar-collapse collapse pull-right">
                            <ul class="nav navbar-nav">
                                <li class="<?php if(isset($_GET["ruta"])){
                                                        if($_GET["ruta"] == "inicio")
                                                            {
                                                                echo "active";
                                                            }
                                                    }else{
                                                        echo "active";
                                                    } 
                                                    ?>">
                                    <a href="inicio">Home</a>
                                </li>
                                <li class="<?php if(isset($_GET["ruta"])){
                                                        if($_GET["ruta"] == "servicios")
                                                            {
                                                                echo "active";
                                                            }
                                                    }
                                                    ?>">
                                    <a href="servicios">Servicios </a>

                                </li>
                                <li class="<?php if(isset($_GET["ruta"])){
                                                        if($_GET["ruta"] == "planes")
                                                            {
                                                                echo "active";
                                                            }
                                                    }
                                                    ?>">
                                    <a href="planes">Planes</a>

                                </li>
                                <li class="<?php if(isset($_GET["ruta"])){
                                                        if($_GET["ruta"] == "contacto")
                                                            {
                                                                echo "active";
                                                            }
                                                    }
                                                    ?>">
                                    <a href="contacto">Contactanos</a>

                                </li>
                                <li class="dropdown dropdown-normal">

                                    <?php if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
                                        echo 
                                        "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'
                                        aria-haspopup='true' aria-expanded='false'><i
                                            class='fad fa-user font-size-20'></i>
                                        </a>
                                        <ul class='dropdown-menu dropdown-menu-v3' style='position: absolute;'>
                                        <li><a href='perfil'><i class='fad fa-address-book'></i> &nbsp&nbsp Perfil</a>
                                        </li>

                                        <li><a href='configracion'><i class='fad fa-cog'></i> &nbsp&nbsp Configracion</a>
                                        </li>

                                         <li><a href='salir'><i class='fad fa-power-off'></i></i> &nbsp&nbsp Cerrar
                                        session</a>
                                        </li>

                                        </ul>";
                                    }else{
                                        echo "<a href='login'><img src='img/perfil.jpg' class='img-responsive' style='width: 35px;
                                        height: 35px;
                                        border-radius: 15px;' alt=''></a>";
                                        }
                                 ?>
                                </li>
                                <li>
                                </li>
                            </ul>

                        </div>

                        <!--/.nav-collapse -->
                    </div>
                    <!--/.container-fluid -->
                </nav>
            </div>

        </div>
    </div>
</header>


<div class="clearfix"></div>