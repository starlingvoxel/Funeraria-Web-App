/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function () {

  var idCliente = $(this).attr("idCliente");

  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({

    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {

      $("#idCliente").val(respuesta["id"]);
      $("#editarCliente").val(respuesta["nombre"]);
      $("#editarDocumentoId").val(respuesta["documento"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#editarTelefono").val(respuesta["telefono"]);
      $("#editarDireccion").val(respuesta["direccion"]);
      $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
    }

  })

})

/*=============================================
VER CLIENTE
=============================================*/
$(".tablas").on("click", ".btnVerCliente", function () {

  var idCliente = $(this).attr("idCliente");

  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({

    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {

      $("#veridCliente").val(respuesta["id"]);
      $("#VerCliente").val(respuesta["nombre"]);
      $("#VerDocumentoId").val(respuesta["documento"]);
      $("#VerEmail").val(respuesta["email"]);
      $("#VerTelefono").val(respuesta["telefono"]);
      $("#VerDireccion").val(respuesta["direccion"]);
      $("#VerFechaNacimiento").val(respuesta["fecha_nacimiento"]);
    }

  })

})


/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function () {

  var idCliente = $(this).attr("idCliente");

  swal({
    title: '¿Está seguro de borrar el cliente?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cliente!'
  }).then(function (result) {
    if (result.value) {

      window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
    }

  })

})



/*=============================================
EDITAR Proveedor
=============================================*/
$(".tablas").on("click", ".btnEditarProveedor", function () {

  var idProveedor = $(this).attr("idProveedor");

  var datos = new FormData();
  datos.append("idProveedor", idProveedor);

  $.ajax({

    url: "ajax/proveedor.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {


      $("#idProveedor").val(respuesta["id"]);
      $("#editarProveedor").val(respuesta["nombre"]);
      $("#editarDocumentoId").val(respuesta["documento"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#editarTelefono").val(respuesta["telefono"]);
      $("#editarDireccion").val(respuesta["direccion"]);
      $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
    }

  })

})

/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedor", function () {

  var idProveedor = $(this).attr("idProveedor");

  swal({
    title: '¿Está seguro de borrar el cliente?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cliente!'
  }).then(function (result) {
    if (result.value) {

      window.location = "index.php?ruta=proveedores1&idProveedor=" + idProveedor;
    }

  })

})
