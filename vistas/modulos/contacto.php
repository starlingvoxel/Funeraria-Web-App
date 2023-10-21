<div class="clearfix"></div>
<div class="page_head wow fadeInUp">
    <div class="container">
        <ul class="bcrumbs pull-right">
            <li><a href="#">Home</a></li>
            <li><?php echo ($_GET['ruta']);?></li>
        </ul>
    </div>
</div>
<div class="contact padding-vertical-70 wow fadeInUpBig">
    <div class="container">
        <div class="row">
            <div class="col-md-1 hidden-sm"></div>
            <div class="col-md-4 col-sm-6">
                <div class="cinfo margin-bottom-30">
                    <h3 class="h2 margin-top-30">Contactanos</h3>
                    <p>Ponte en contacto con nosotros.</p>
                    <p>Esperamos poder ayudarlo con todo lo que necesita, así que no dude en contactarnos en cualquier
                        momento, las 24 horas del día, los 7 días de la semana, ya que estamos a su disposición.</p>
                    <p class="abbr">
                        <i class="fa fa-map-marker"></i> Av. Enriquillo # 52, Santiago, R.D.
                        <br>

                        <i class="flaticon-black"></i> support@funeraria-alas-paz.com
                        <br>
                        <i class="flaticon-technology"></i> (829) 872 - 8425

                    </p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <form class="contact-form margin-bottom-30" id="contactForm"
                    action="https://demo.themesuite.com/funeral/classic/php/contact.php" method="post">
                    <div class="text-center">
                        <i class="flaticon-write"></i>
                        <h3 class="h2">Formulario de contacto</h3>
                    </div>
                    <input name="senderName" id="senderName" type="text" placeholder="Nombre" required="required" />
                    <input type="email" name="senderEmail" id="senderEmail" placeholder="Email " required="required" />
                    <input name="phoneno" id="phoneno" type="text" placeholder="Telefono" required="required" />
                    <textarea rows="4" name="message" id="message" placeholder="Mensaje"></textarea>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-md">Enviar mensaje</button>
                    </div>
                </form>

            </div>
            <div class="col-md-1 hidden-sm"></div>
        </div>
    </div>
</div>