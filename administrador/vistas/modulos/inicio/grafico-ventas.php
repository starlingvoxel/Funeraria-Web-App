<?php 
//$ventas = ControladorVentas::ctrSumaTotalVentas();
$subscribers = new ControladorVentas();
$ventas = $subscribers->ctrSumaTotalVentas();
 ?>
<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="card card-statistic-2">
        <div class="card-chart">
            <canvas id="balance-chart" height="65"></canvas>
        </div>
        <div class="card-icon shadow-primary bg-primary">
            <i class="fal fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>Ventas</h4>
            </div>
            <div class="card-body">
                $<?php echo number_format($ventas["total"],2); ?>
            </div>
        </div>
    </div>
</div>


<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);


$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {

  #Capturamos sólo el año y el mes
  $fecha = substr($value["fecha"],0,7);

  #Introducir las fechas en arrayFechas
  array_push($arrayFechas, $fecha);

  #Capturamos las ventas
  $arrayVentas = array($fecha => $value["total"]);

  #Sumamos los pagos que ocurrieron el mismo mes
  foreach ($arrayVentas as $key => $value) {

    $sumaPagosMes[$key] += $value;
  }

}


$noRepetirFechas = array_unique($arrayFechas);


?>

<script>
var balance_chart = document.getElementById("balance-chart").getContext('2d');

var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

var myChart = new Chart(balance_chart, {
    type: 'line',
    data: {
        labels: [0,
            <?php
    if($noRepetirFechas != null){
      foreach($noRepetirFechas as $key){
        echo " '".$key."',";
      }
    }else{
       echo "0";
    }

    ?>0
        ],
        datasets: [{
            label: 'Ventas',
            data: [0,
                <?php

        if($noRepetirFechas != null){

          foreach($noRepetirFechas as $key){

            echo "'".$sumaPagosMes[$key]."',";


          }



        }else{

           echo "0";

        }

        ?>0
            ],
            backgroundColor: balance_chart_bg_color,
            borderWidth: 3,
            borderColor: 'rgba(63,82,227,1)',
            pointBorderWidth: 0,
            pointBorderColor: 'transparent',
            pointRadius: 3,
            pointBackgroundColor: 'transparent',
            pointHoverBackgroundColor: 'rgba(63,82,227,1)',
        }]
    },
    options: {
        layout: {
            padding: {
                bottom: -1,
                left: -1
            }
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                gridLines: {
                    display: false,
                    drawBorder: false,
                },
                ticks: {
                    beginAtZero: true,
                    display: false
                }
            }],
            xAxes: [{
                gridLines: {
                    drawBorder: false,
                    display: false,
                },
                ticks: {
                    display: false
                }
            }]
        },
    }
});
</script>