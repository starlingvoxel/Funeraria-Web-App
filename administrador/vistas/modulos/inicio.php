<?php $PrecioTotal = ControladorProductos::ctrMostrarSumaProductoPrecio();
      $CostoTotal = ControladorProductos::ctrMostrarSumaProductoCosto();

      $GanaciaTotal = $PrecioTotal["total"] - $CostoTotal["total"];
?>
<!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-title">Ganancias

                  </div>
                  <div class="card-stats-items">
                    <div class="card-stats-item" style="width: calc(100% / 2);">
                      <div class="card-stats-item-count">$<?php echo number_format($CostoTotal["total"],2); ?></div>
                      <div class="card-stats-item-label">Costo de Inventario</div>
                    </div>
                    <div class="card-stats-item" style="width: calc(100% / 2);">
                      <div class="card-stats-item-count">$<?php echo number_format($PrecioTotal["total"],2); ?></div>
                      <div class="card-stats-item-label">Precio de Inventario</div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <a href="productos"><i class="fal fa-archive"></i></a>

                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Ganancia</h4>
                  </div>
                  <div class="card-body">
                      $<?php echo number_format($GanaciaTotal,2); ?>
                  </div>
                </div>
              </div>
            </div>
            <?php include "vistas/modulos/inicio/grafico-ventas.php" ?>

          </div>
          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Budget vs Sales</h4>
                </div>
                <div class="card-body">
                  <canvas id="myChart" height="158"></canvas>
                </div>
              </div>
            </div>

          </div>


        </section>
      </div>
