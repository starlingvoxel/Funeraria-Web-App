<div class="clearfix"></div>
<div class="page_head wow fadeInUp">
    <div class="container">
        <ul class="bcrumbs pull-right">
            <li><a href="inicio">Home</a></li>
            <li><?php echo ($_GET['ruta']);?></li>
        </ul>
    </div>
</div>
<div class="checkout-content padding-vertical-50 wow fadeInUpBig">
    <div class="container">
        <form>


            <div class="clearfix"></div>
            <div class="margin-bottom-15"></div>
            <div class="clearfix"></div>
            <h2>Registro de Usuario</h2>
            <div class="checkout-content padding-vertical-20 ">

                <div class="container">
                    <form class="" id="" name="" method="post" action="">
                        <div class="margin-bottom-15"></div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>Apellido:</label>
                                <input type="text" name="apellido" id="apellido" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <label>Tipo documento</label>
                                <div class="cc-select">
                                    <i class="fa fa-angle-down"></i>
                                    <select>
                                        <option class="selected">Seleccionar</option>
                                        <option>Cedula</option>
                                        <option>Pasaporte</option>
                                        <option>RNC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-6">
                                <label>Documento</label>
                                <input type="text" name="documento" id="documento" placeholder="Documento">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Sexo:</label>
                                <div class="cc-select">
                                    <i class="fa fa-angle-down"></i>
                                    <select name="sexo">
                                        <option class="selected">Seleccionar</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <label>Estado civil:</label>
                                <div class="cc-select">
                                    <i class="fa fa-angle-down"></i>
                                    <select name="sexo">
                                        <option class="selected">Seleccionar</option>
                                        <option value="masculino">Casado</option>
                                        <option value="femenino">Soltero</option>
                                        <option value="femenino">Union libre</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Fecha de nacimineto:</label>
                                <input type="text" name="fec_nac" id="fec_nac" placeholder="Fecha de nacimineto">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>Numero:</label>
                                <input type="text" placeholder="Numero">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <label>Email:</label>
                                <input type="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Direccion:</label>
                                <input type="text" placeholder="Calle, numero, sector">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label>Provincia:</label>
                                <div class="cc-select">
                                    <i class="fa fa-angle-down"></i>
                                    <select>
                                        <option class="selected">Seleccionar</option>
                                        <option>Santiago</option>
                                        <option>Alaska</option>
                                        <option>Arizona</option>
                                        <option>Arkansas</option>
                                        <option>California</option>
                                        <option>Colorado</option>
                                        <option>Florida</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <label>Municipio:</label>
                                <div class="cc-select">
                                    <i class="fa fa-angle-down"></i>
                                    <select>
                                        <option class="selected">Select</option>
                                        <option>Santiago de los caballeros</option>
                                        <option>Alaska</option>
                                        <option>Arizona</option>
                                        <option>Arkansas</option>
                                        <option>California</option>
                                        <option>Colorado</option>
                                        <option>Florida</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>


                <div class="margin-bottom-50"></div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="pull-right btn btn-primary btn-md padding-horizontal-30">Proceder
                            al pago</button>
                    </div>
                </div>
                <?php $registro = new ModeloUsuarios();
                    $registro -> mdlIngresarUsuario("1","1");
               ?>
        </form>
    </div>
    </form>
</div>
</div>