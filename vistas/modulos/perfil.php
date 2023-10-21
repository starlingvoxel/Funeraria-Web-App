<div class="single-content padding-vertical-50">
    <div class="container">
        <div class="section-head text-center margin-bottom-30 wow fadeInUp"
            style="visibility: visible; animation-name: fadeInUp;">
            <h3 class="h2">Perfil</h3>

        </div>

        <div class="row">
            <aside class="col-md-3 col-sm-5 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                <div class="frame text-center margin-bottom-50">
                    <img src="img/perfil.jpg" class="img-responsive" alt="">
                    <h4>Starling Vasquez</h4>
                </div>

            </aside>
            <div class="col-md-9 col-sm-7 single-info wow fadeInUp"
                style="visibility: visible; animation-name: fadeInUp;">
                <div class="">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class=" " data-toggle="tab" href="#Informacion" role="tab"
                                aria-selected="true">Mi informacion</a> </li>
                        <li class="nav-item"> <a class="" data-toggle="tab" href="#dependientes" role="tab"
                                aria-selected="false">Agregar dependientes</a> </li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!--==================================================
                                        Informacion
                        ==================================================-->
                        <div class="tab-pane active" id="Informacion" role="tabpanel">
                            <div class="card-body">
                                <div class="details">
                                    <div class="padding-bottom-30"></div>

                                    <p><i class="fa fa-user"></i> <b>Nombre:</b> Starling Vasquez</p>
                                    <p><i class="fa fa-calendar"></i> <b>Fecha de cumpleanos:</b> 28/04/1999</p>


                                    <div class="padding-bottom-30"></div>
                                    <h5>Mis dependientes</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Estado</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Starling Vasquez</td>
                                                    <td>Activo</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Daivel Canela</td>
                                                    <td>Activo</td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="padding-bottom-30"></div>
                                    <a class="active" data-toggle="tab" href="#dependientes" role="tab"
                                        aria-selected="false">Agregar
                                        Dependientes</a>

                                </div>
                            </div>
                        </div>
                        <!--==================================================
                                        DEPENDINTES
                        ==================================================-->
                        <div class="tab-pane" id="dependientes" role="tabpanel">
                            <div class="checkout-content padding-vertical-30 ">

                                <div class="container">
                                    <form class="" id="dependiente" name="dependiente" method="post"
                                        action="views/datosPOST.php">
                                        <div class="margin-bottom-15"></div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-6">
                                                <label>Nombre:</label>
                                                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                                            </div>
                                            <div class="col-md-5 col-sm-6">
                                                <label>Apellido:</label>
                                                <input type="text" name="apellido" id="apellido" placeholder="Apellido">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6">
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
                                            <div class="col-md-7 col-sm-6">
                                                <label>Documento</label>
                                                <input type="text" name="documento" id="documento"
                                                    placeholder="Documento">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-6">
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

                                            <div class="col-md-5 col-sm-6">
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
                                            <div class="col-md-5 col-sm-6">
                                                <label>Fecha de nacimineto:</label>
                                                <input type="text" name="fec_nac" id="fec_nac"
                                                    placeholder="Fecha de nacimineto">
                                            </div>
                                            <div class="col-md-5 col-sm-6">
                                                <label>Numero:</label>
                                                <input type="text" placeholder="Numero">
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-10">
                                                <label>Email:</label>
                                                <input type="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <label>Direccion:</label>
                                                <input type="text" placeholder="Calle, numero, sector">
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-5 col-sm-6">
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

                                            <div class="col-md-5 col-sm-6">
                                                <label>Municipio:</label>
                                                <div class="cc-select">
                                                    <i class="fa fa-angle-down"></i>
                                                    <select>
                                                        <option class="selected">Seleccionar</option>
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
                                    <div class="col-md-10">
                                        <button type="submit"
                                            class="pull-right btn btn-primary btn-md padding-horizontal-30">Guardar</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</div>
<div class="padding-bottom-70"></div>