$(document).ready(function() {
    $('#agregar-admin').on('submit', function(e){
        e.preventDefault();
        //lo que hace serializeArray() es iterar en todo los campos y nos crea unos objetos con los datos
        var datos = $(this).serializeArray();
 
        $.ajax({
            //Asi leemos aquel Request que dice POST
            type: $(this).attr('method'),
            //Despues son los datos que queremos enviar a ajax
            data: datos,
            //A donde se van a enviar
            url: $(this).attr('action'),
            //tipo de datos
            dataType: 'json',
            //Y cuando la llamada sea exitosa/ data es la respuesta que nos va a retornar este llamado
        }).done( function(data){
            var resultado = data;
            if(resultado.respuesta === 'exito'){
                swal('Correcto',
                'El administrador ha sido agregado',
                'success')
            }else{
                swal(
                    'Error!',
                    'hubo un error',
                    'error')
            }
            
        }).fail( function(data){
            swal(
                'Error!',
                'hubo un error',
                'error')
        });
    });


    $('#login-admin').on('submit', function(e){
        e.preventDefault();
        //lo que hace serializeArray() es iterar en todo los campos y nos crea unos objetos con los datos
        var datos = $(this).serializeArray();
 
        $.ajax({
            //Asi leemos aquel Request que dice POST
            type: $(this).attr('method'),
            //Despues son los datos que queremos enviar a ajax
            data: datos,
            //A donde se van a enviar
            url: $(this).attr('action'),
            //tipo de datos
            dataType: 'json',
            //Y cuando la llamada sea exitosa/ data es la respuesta que nos va a retornar este llamado
        }).done( function(data){
            var resultado = data;
            if(resultado.respuesta === 'exitoso'){
                swal('Login correcto',
                'Bienvenido '+resultado.usuario+' !! ',
                'success')
                setTimeout(function(){
                     window.location.href = 'dashboard.php';
                     }, 2000
                     );

                
            }else{
                swal(
                    'Error!',
                    'Usuario o password incorrecto',
                    'error')
            }
            
        }).fail( function(data){
            swal(
                'Error!',
                'hubo un error',
                'error')
        });
    });
});



