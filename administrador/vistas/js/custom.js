/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

/*=============================================
CAMBIANDO A MAYUSCULAS
=============================================*/

$(".mayus").keyup(function(){

  let str = $(".mayus").val();

  $(".mayus").val(str.toUpperCase());
})

$(".editarMayus").keyup(function(){

  let str = $(".editarMayus").val();

  $(".editarMayus").val(str.toUpperCase());
})
