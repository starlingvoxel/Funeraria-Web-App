<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">

    <a href="inicio" class="navbar-brand sidebar-gone-hide">Funeraria Alas de Paz</a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>

    <form class="form-inline ml-auto">


    </form>
    <ul class="navbar-nav navbar-right">


        <!--=============================================
                    NOTIFICACIONES
                  =============================================-->


        <!--=============================================
                    USER INFO
                  =============================================-->

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="vistas/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $_SESSION["nombre"]; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in <br> <?php echo $_SESSION["ultimo_login"]  ?> min ago </div>
                <a href="usuarios" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="salir" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>

    </ul>
</nav>








<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">

            <li class="nav-item <?php if($_GET["ruta"] == "inicio" ){echo "active";}?>">
                <a href="inicio" class="nav-link"><i class="fal fa-chart-line"></i><span>Dashboard</span></a>
            </li>

            <li class="nav-item <?php if($_GET["ruta"] == "productos"){echo "active";}?>">
                <a href="productos" class="nav-link">
                    <i class="fal fa-cowbell-more"></i>
                    <span>Productos</span></a>
            </li>

            <li class="nav-item <?php if($_GET["ruta"] == "categorias"){echo "active";}?>">
                <a href="categorias" class="nav-link"><i class="fal fa-list-ul"></i><span>Categorias</span></a>
            </li>

            <li class="nav-item <?php if($_GET["ruta"] == "clientes"){echo "active";}?>">
                <a href="clientes" class="nav-link"><i class="fal fa-user-plus"></i><span>Clientes</span></a>
            </li>

            <li
                class="nav-item <?php if($_GET["ruta"] == "ventas" || $_GET["ruta"] == "crear-venta"){echo "active";}?>">
                <a href="ventas" class="nav-link"><i class="fal fa-shopping-basket"></i></i><span>Ventas</span></a>
            </li>




        </ul>
    </div>
</nav>