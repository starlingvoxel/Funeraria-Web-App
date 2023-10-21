 <header class="topbar">
     <nav class="navbar top-navbar navbar-expand-md navbar-light">
         <!-- ============================================================== -->
         <!-- Logo -->
         <!-- ============================================================== -->
         <div class="navbar-header">
             <a class="navbar-brand" href="index.html">
                 <!-- Logo icon -->
                 <b>

                     <!-- Light Logo icon -->
                     <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                 </b>
                 <!--End Logo icon -->
                 <!-- Logo text -->
                 <span>

                     <!-- Light Logo text -->
                     <img src="assets/images/logo-light-text1.png" class="light-logo" alt="ALAS DE PAZ" />
                 </span>
             </a>
         </div>
         <!-- ============================================================== -->
         <!-- End Logo -->
         <!-- ============================================================== -->
         <div class="navbar-collapse">
             <!-- ============================================================== -->
             <!-- toggle and nav items -->
             <!-- ============================================================== -->
             <ul class="navbar-nav mr-auto mt-md-0">
                 <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                         href="javascript:void(0)"><i class="ti-close mdi mdi-menu"></i></a> </li>
             </ul>
             <!-- ============================================================== -->
             <!-- User profile and search -->
             <!-- ============================================================== -->
             <ul class="navbar-nav my-lg-0">

                 <!-- ============================================================== -->
                 <!-- Profile -->
                 <!-- ============================================================== -->
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                             src="assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                     <div class="dropdown-menu dropdown-menu-right scale-up">
                         <ul class="dropdown-user">
                             <li>
                                 <div class="dw-user-box">
                                     <div class="col-sm-12 u-img">
                                         <img src="assets/images/users/1.jpg" alt="user" />
                                     </div>
                                     <div class="col-sm-9 u-text">
                                         <h4>

                                             <?php echo $_SESSION['nombre'], " ", $_SESSION['apellido'];?>

                                         </h4>
                                         <p class="text-muted">varun@gmail.com</p>

                                     </div>
                                 </div>
                             </li>

                             <li role="separator" class="divider"></li>
                             <li>
                                 <a href="login.php?cerrar_sesion=true"><i class="fa fa-power-off"></i> Cerrar
                                     sesion</a>
                             </li>
                         </ul>
                     </div>
                 </li>

             </ul>
         </div>
     </nav>
 </header>