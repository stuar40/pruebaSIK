//documento jquery que se activa en base a la funcion load 

$(document).ready(function(){


  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  // Insertar Asesor Proveedor

$("#guardar_asesor").submit(function( event ) {
    $('#guardar_datos').attr("disabled", true);
    var parametros = $(this).serialize();
       $.ajax({
                type: "POST",
                url: "ajax/ajaxProveedores2.php",
                error: function() {
                  console.log("No se ha podido obtener la información");
                },
                data: parametros,
                beforeSend: function(objeto){},
                success: function(response){
                console.log(response);
                if(response == 'replica'){
                        Swal.fire({
                        title: "El usuario Ya existe",
                        icon: 'error',
                        });
                        $('#telefonoAsesor').val('');
                        }
                if (response == 'successful' ) {
                    Swal.fire({
                            title: "Usuario Guardado",
                            icon: 'success',
                            });
                 
                $('#idProveedor').val('Seleccione Proveedor');
                $('#nombreAsesor').val('');
                $('#telefonoAsesor').val('');
                $('#correoAsesor').val('');
                $('#estadoAsesor').val('Seleccione Estado del Asesor');
                
            }
            }/*,
            error: function() {
              console.log("No se ha podido obtener la información");
            }*/
      });
    event.preventDefault();
  }) //fin de la funcion de instertar Asesor Proveedor




}); // End Ready  //FIN DEL READY de la carga de la pagina 
