//documento jquery que se activa en base a la funcion load 

$(document).ready(function(){


// Insertar Usuarios

$("#guardar_Proveedor").submit(function( event ) {
    $('#guardar_datos').attr("disabled", true);
    var parametros = $(this).serialize();
       $.ajax({
                type: "POST",
                url: "ajax/ajaxProveedores.php",
                data: parametros,
                beforeSend: function(objeto){},
                success: function(response){
                if(response == 'replica'){
                        Swal.fire({
                        title: "El usuario Ya existe",
                        icon: 'error',
                        });
                        $('#cui').val('');
                        }
                if (response == 'successful' ) {
                    Swal.fire({
                            title: "Usuario Guardado",
                            icon: 'success',
                            });
                 
                $('#pnombre').val('');
                $('#snombre').val('');
                $('#papellido').val('');
                $('#sapellido').val('');
                $('#cui').val('');
                $('#fecha').val('');
                $('#usuario').val('');
                $('#email').val('');
                $('#pass').val('');
                $('#dir').val('');
                $('#telefono').val('');
                $('#estad').val('Seleccione Estado');
                $('#rol').val('Seleccione Tipo de Usuario');
                $('#sids').val('Seleccione Sucursal');
                $('#hora').val('Seleccione Horario');
                
            }
            }
      });
    event.preventDefault();
  })

}); // End Ready  //FIN DEL READY de la carga de la pagina 
