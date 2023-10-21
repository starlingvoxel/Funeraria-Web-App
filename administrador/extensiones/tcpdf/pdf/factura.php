<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";
class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){


//TRAEMOS LA INFORMACIÓN DE LA empresa
$itemVenta = "1";
$valorVenta = "1";
$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemVenta, $valorVenta);


//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);

$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(20, 20, 20, false);
$pdf->SetFont('helvetica', '', 14, '', true);
$pdf->AddPage('P', 'A4');

//---------------------------------------------------------
$bloque = <<<EOF


<table style="font-size:14px; text-align:center">
	<tr>

		<td style="width:300px"><img src="images/1.png"></td>

		<td>
		<b>FACTURA N.</b>$valorVenta
		<br>
			<b>Fecha</b> $fecha
			</td>
	</tr>

</table>


EOF;

$bloque1 = <<<EOF

<table style="font-size:13px;">


	<tr>
		<td >
			<div style="">
				<br><br>
				<b>FACTURAR A</b>
				<br>
				$respuestaCliente[nombre]
				<br><br>
				<br><br>
			</div>

		</td>

		<td style="text-align: right">

		<br><br><br>
		 <b>VENDEDOR</b>
		 <br>
			$respuestaVendedor[nombre]
		</td>

	</tr>


</table>

EOF;

$bloque6 = <<<EOF

<table style="font-size:14px; text-align:left; border-bottom: 1px solid black; border-top: 1px solid black">

	<tr>



	<td style="width:50%;">
		<b>Descripcion</b>
	</td>
	<td style="width:20%;">
		 <b>Cantidad</b>
	</td>

	<td style="width:30%;">
	 <b>Total</b>

	</td>


	</tr>

</table>


EOF;
$pdf->writeHTML($bloque, false, false, false, false, '');
$pdf->writeHTML($bloque1, false, false, false, false, '');
$pdf->writeHTML($bloque6, false, false, false, false, '');


// ---------------------------------------------------------


foreach ($productos as $key => $item) {

//echo  $item;
$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);


$bloque2 = <<<EOF

<table style="font-size:12px;">

	<tr>

	<td style="width:53%; text-align:left">
  $item[descripcion]
	</td>

		<td style="width:18%; text-align:left">
		&nbsp; $item[cantidad]
		</td>

		<td style="width:20%; text-align:left">
		 $ $precioTotal

		</td>

	</tr>

	<tr>

		<td style="width:20%; text-align:right">
		$ $valorUnitario Und
     <br>
		</td>


	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}


// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:12px; text-align:right ">

	<tr>

		<td style="width:75%;">
			 NETO:
		</td>

		<td style="width:80px;">
			$ $neto
		</td>

	</tr>

	<tr>

		<td style="width:75%;">
			 IMPUESTO:
		</td>

		<td style="width:80px;">
			$ $impuesto
		</td>

	</tr>

	<tr>

		<td style="width:75%;">
			 --------------------------
		</td>

	</tr>

	<tr>

		<td style="width:75%;">
			 TOTAL:
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>



</table>



EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO


ob_end_clean();

  /* Finalmente generamos el PDF */
  $pdf->Output('reporte.pdf');

//$pdf->Output('factura.pdf', 'D');
//$pdf->Output('factura.pdf','D');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>
