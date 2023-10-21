<div class="single-content padding-vertical-50">
    <div class="container">

        <div class="row">

            <div class="col-md-12 col-sm-7 single-info wow fadeInUp">
                <div class="details">
                    <div class="padding-bottom-30"></div>
                    <h5>Inicia sesion</h5>
                    <form class="" id="login-usuario" name="login-usuario-form" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="ingUsuario" placeholder="Usuario" required autofocus>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="password" name="ingPassword" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="margin-top-10"></div>
                        <button type="submit" class="btn btn-primary btn-md">Iniciar sesion</button>
                        <?php
                        $login = new ControladorUsuarios();
                        $login -> ctrIngresoUsuario();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding-bottom-150"></div>
<div class="padding-bottom-150"></div>
<div class="padding-bottom-50"></div>