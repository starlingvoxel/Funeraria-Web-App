/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){

// 		console.log("respuesta", respuesta);

// 	}

// })//

$('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
    "deferRender": false,
	"retrieve": false,
	"processing": true,
  "responsive": false,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(_MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "<i class='fad fa-angle-right'></i>",
			"sPrevious": "<i class='fad fa-angle-left'></i>"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/
  var cont = 0;
$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-outline-primary agregarProducto");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
            var id = respuesta["id"];
      	    var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_venta"];
            var precio1 = respuesta["precio_venta"];

          	/*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    return;

        }
            cont++;

          	$(".nuevoProducto").append(

          	'<div class="form-row col-12" style="padding:2px 15px">'+

			  '<!-- Descripción del producto -->'+

	          '<div class="form-group col-12 col-md-6" style="padding-right:0px;margin-bottom:3px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-prepend"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fal fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="form-group col-4 col-sm-4 col-md-2">'+

	             '<input type="number" class="form-control nuevaCantidadProducto" id="cant'+cont+'" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

            '<!-- Precio del producto unidad -->'+

           '<div class="form-group col-4 col-sm-4 col-md-2 ingresoPrecio" style="padding-left:0px">'+

             '<div class="input-group">'+
             '<style>input[type=number]::-webkit-outer-spin-button,input[type=number]::-webkit-inner-spin-button {-webkit-appearance: none; margin: 0;}input[type=number] { -moz-appearance:textfield;} </style>'+
               '<span class="input-group"></i></span>'+


               '<input type="number" class="form-control nuevoPrecioProducto1"  precioReal1="'+precio1+'" id="precioUnidad'+cont+'" name="nuevoPrecioProducto1" value="'+precio1+'"  required>'+

             '</div>'+

           '</div>'+

	          '<!-- Precio del producto -->'+

	          '<div class="form-group col-4 col-sm-4 col-md-2 ingresoPrecio" style="padding-left:0px;padding-right:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group"></span>'+

	              '<input type="text" class="form-control nuevoPrecioProducto"  id="precioFin'+cont+'" "precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	        '</div>')

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPrecios()

	        // AGREGAR IMPUESTO

	        agregarImpuesto()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);


			localStorage.removeItem("quitarProducto");

      	}

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-outline-primary agregarProducto');

		}


	}


})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){
  cont = 0;
	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];

	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-outline-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO

        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function(){

	numProducto ++;

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+

	          '<div class="col-xs-6" style="padding-right:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

	              '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3 ingresoCantidad">'+

	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="0" stock nuevoStock required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+

	            '</div>'+

	          '</div>'+

	        '</div>');


	        // AGREGAR LOS PRODUCTOS AL SELECT

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){

	         	if(item.stock != 0){

		         	$("#producto"+numProducto).append(

						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
		         	)


		         }

	         }

        	 // SUMAR TOTAL DE PRECIOS

    		sumarTotalPrecios()

    		// AGREGAR IMPUESTO

	        agregarImpuesto()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nuevoPrecioProducto").number(true, 2);


      	}

	})

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/
var i = 0;
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	     $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})
/*=============================================
MODIFICAR PRECIO
=============================================*/
function preciounidad(cantidad,preciounidad){
  var suma = Number(cantidad * preciounidad);
 return suma;
}
var i=0;
$(".formularioVenta").on("change", "input.nuevoPrecioProducto1", function(){
  //var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto1");

        for(i=1;i<21;i++){

          if(i==1){
            var cant = $("#cant1").val();
            var pu =  $("#precioUnidad1").val();
            $("#precioFin1").val(preciounidad(cant,pu));
          }
          else if(i==2){
            var cant = $("#cant2").val();
            var pu =  $("#precioUnidad2").val();
            $("#precioFin2").val(preciounidad(cant,pu));
          }
          else if(i==3){
            var cant = $("#cant3").val();
            var pu =  $("#precioUnidad3").val();
            $("#precioFin3").val(preciounidad(cant,pu));
          }
          else if(i==4){
            var cant = $("#cant4").val();
            var pu =  $("#precioUnidad4").val();
            $("#precioFin4").val(preciounidad(cant,pu));
          }
          else if(i==5){
            var cant = $("#cant5").val();
            var pu =  $("#precioUnidad5").val();
            $("#precioFin5").val(preciounidad(cant,pu));
          }
          else if(i==6){
            var cant = $("#cant6").val();
            var pu =  $("#precioUnidad6").val();
            $("#precioFin6").val(preciounidad(cant,pu));
          }
          else if(i==7){
            var cant = $("#cant7").val();
            var pu =  $("#precioUnidad7").val();
            $("#precioFin7").val(preciounidad(cant,pu));
          }
          else if(i==8){
            var cant = $("#cant8").val();
            var pu =  $("#precioUnidad8").val();
            $("#precioFin8").val(preciounidad(cant,pu));
          }
          else if(i==9){
            var cant = $("#cant9").val();
            var pu =  $("#precioUnidad9").val();
            $("#precioFin9").val(preciounidad(cant,pu));
          }
          else if(i==10){
            var cant = $("#cant10").val();
            var pu =  $("#precioUnidad10").val();
            $("#precioFin10").val(preciounidad(cant,pu));
          }
          else if(i==11){
            var cant = $("#cant11").val();
            var pu =  $("#precioUnidad11").val();
            $("#precioFin11").val(preciounidad(cant,pu));
          }
          else if(i==12){
            var cant = $("#cant12").val();
            var pu =  $("#precioUnidad12").val();
            $("#precioFin12").val(preciounidad(cant,pu));
          }
          else if(i==13){
            var cant = $("#cant13").val();
            var pu =  $("#precioUnidad13").val();
            $("#precioFin13").val(preciounidad(cant,pu));
          }
          else if(i==14){
            var cant = $("#cant14").val();
            var pu =  $("#precioUnidad14").val();
            $("#precioFin14").val(preciounidad(cant,pu));
          }
        }




      	// SUMAR TOTAL DE PRECIOS

      	sumarTotalPrecios()

      	// AGREGAR IMPUESTO

          agregarImpuesto()

          // AGRUPAR PRODUCTOS EN FORMATO JSON

          listarProductos()
})
/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/


$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  //var precio1 = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto1");
  for(i=1;i<21;i++){

    if(i==1){
      var cant = $("#cant1").val();
      var pu =  $("#precioUnidad1").val();
      $("#precioFin1").val(preciounidad(cant,pu));
    }
    else if(i==2){
      var cant = $("#cant2").val();
      var pu =  $("#precioUnidad2").val();
      $("#precioFin2").val(preciounidad(cant,pu));
    }
    else if(i==3){
      var cant = $("#cant3").val();
      var pu =  $("#precioUnidad3").val();
      $("#precioFin3").val(preciounidad(cant,pu));
    }
    else if(i==4){
      var cant = $("#cant4").val();
      var pu =  $("#precioUnidad4").val();
      $("#precioFin4").val(preciounidad(cant,pu));
    }
    else if(i==5){
      var cant = $("#cant5").val();
      var pu =  $("#precioUnidad5").val();
      $("#precioFin5").val(preciounidad(cant,pu));
    }
    else if(i==6){
      var cant = $("#cant6").val();
      var pu =  $("#precioUnidad6").val();
      $("#precioFin6").val(preciounidad(cant,pu));
    }
    else if(i==7){
      var cant = $("#cant7").val();
      var pu =  $("#precioUnidad7").val();
      $("#precioFin7").val(preciounidad(cant,pu));
    }
    else if(i==8){
      var cant = $("#cant8").val();
      var pu =  $("#precioUnidad8").val();
      $("#precioFin8").val(preciounidad(cant,pu));
    }
    else if(i==9){
      var cant = $("#cant9").val();
      var pu =  $("#precioUnidad9").val();
      $("#precioFin9").val(preciounidad(cant,pu));
    }
    else if(i==10){
      var cant = $("#cant10").val();
      var pu =  $("#precioUnidad10").val();
      $("#precioFin10").val(preciounidad(cant,pu));
    }
    else if(i==11){
      var cant = $("#cant11").val();
      var pu =  $("#precioUnidad11").val();
      $("#precioFin11").val(preciounidad(cant,pu));
    }
    else if(i==12){
      var cant = $("#cant12").val();
      var pu =  $("#precioUnidad12").val();
      $("#precioFin12").val(preciounidad(cant,pu));
    }
    else if(i==13){
      var cant = $("#cant13").val();
      var pu =  $("#precioUnidad13").val();
      $("#precioFin13").val(preciounidad(cant,pu));
    }
    else if(i==14){
      var cant = $("#cant14").val();
      var pu =  $("#precioUnidad14").val();
      $("#precioFin14").val(preciounidad(cant,pu));
    }
  }
	//var precioFinal = $(this).val() * precio1.attr("precioRealh1");
  //var precioFinal = $(this).val() * $("#precioUnidad1").val();
  //console.log("precioreal1",precio1.attr("precioReal1"));
  //console.log("precio x cantidad",precioFinal);

	//precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){
    console.log("numero",Number($(this).val()));
		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(0);

		$(this).attr("nuevoStock", $(this).attr("stock"));

		//var precioFinal = $(this).val() * precio.attr("precioReal");
    var precioFinal = $(this).val() * $("#precio").val();
		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO

    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
//  var precioItem = $("#precioFin");
	var arraySumaPrecio = [];

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));


	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto();

});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

//$("#nuevoTotalVenta").number(true, 2);

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

		$(this).parent().parent().removeClass("col-sm-4");

		$(this).parent().parent().addClass("col-sm-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			 ' <div class="form-group col-6 col-sm-6 col-md-6"> <label>Recibido:</label>'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-prepend"><div class="input-group-text"><i class="fad fa-dollar-sign"></i></div></span>'+

			 		'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="form-group col-6 col-sm-6 col-md-6 " id="capturarCambioEfectivo" style="padding-left:0px"><label>Cambio:</label> '+

			 	'<div class="input-group">'+

			 		'<span class="input-group-prepend"><div class="input-group-text"><i class="fad fa-dollar-sign"></i></div></span>'+

			 		'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+

			 	'</div>'+

			 '</div>'

		 )

		// Agregar formato al precio

		$('#nuevoValorEfectivo').number( true, 2);
      	$('#nuevoCambioEfectivo').number( true, 2);


      	// Listar método en la entrada
      	listarMetodos()


	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

		 	'<div class="col-12 col-sm-4 col-md-4" > <label>Codigo de transacción:</label>'+

                '<div class="input-group">'+

                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+

                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+

                '</div>'+

              '</div>')

	}



})

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoTipoPago").change(function(){

      listarTipos()


})

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	// Listar método en la entrada
     listarMetodos()


})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");
  var precioUnidad = $(".nuevoPrecioProducto1");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precioUnidad[i]).val(),
							  "total" : $(precio[i]).val()})

	}

	$("#listaProductos").val(JSON.stringify(listaProductos));

}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

	}

}
/*=============================================
LISTAR TIPO DE PAGO
=============================================*/

function listarTipos(){

	var listaMetodos = "";

	if($("#nuevoTipoPago").val() == "Efec"){

		$("#listaTipoPago").val("Contado");

	}else{

		$("#listaTipoPago").val("Credito");

	}

}

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}

}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitarAgregarProducto();

})


/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");

})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');
    console.log(fechaInicial,fechaFinal);
    var capturarRango = $("#daterange-btn").html();
    console.log(capturarRango);
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker .opensleft .opensright .range_inputs .cancelBtn").on("click", function(){


	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker .opensright .ltr .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");
  console.log(textoHoy);
	if(textoHoy == "Hoy"){

		var d = new Date();

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		 if(mes < 10){

	 	var fechaInicial = año+"-0"+mes+"-"+dia;
	 	var fechaFinal = año+"-0"+mes+"-"+dia;

	 }else if(dia < 10){

	 	var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;
	 }else if(mes < 10 && dia < 10){

	 	var fechaInicial = año+"-0"+mes+"-0"+dia;
	 	var fechaFinal = año+"-0"+mes+"-0"+dia }else{

	 	var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		 }

		dia = ("0"+dia).slice(-2);
		mes = ("0"+mes).slice(-2);

		var fechaInicial = año+"-"+mes+"-"+dia;
		var fechaFinal = año+"-"+mes+"-"+dia;

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})
