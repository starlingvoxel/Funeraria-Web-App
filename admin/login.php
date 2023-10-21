<?php 
        session_start();
  
        if(isset($_GET['cerrar_sesion'])) {
            $_SESSION = array();
          }
        include_once'funciones/funciones.php'; 
         include_once'templates/head.php'; 
         ?>


<body class="fix-header card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register">
            <div class="login-box card">

                <div class="card-body">

                    <form class="form-horizontal form-material" id="login-admin" name="login-admin-form" method="post"
                        action="insertar-admin.php">
                        <h3 class="box-title m-b-20">Iniciar sesion</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="usuario"
                                    placeholder="Usuario">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex no-block align-items-center">

                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <input type="hidden" name="login-admin" value="1">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    name="login-admin" type="submit">Entrar</button>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" id="recoverform"
                        action="https://wrappixel.com/demos/admin-templates/material-pro/horizontal/index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you!
                                </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

</body>

</html>