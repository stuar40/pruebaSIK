//documento jquery que se activa en base a la funcion load 

$(document).ready(function(){


// Insertar Proveedor

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
                        $('#proveedorNIT').val('');
                        }
                if (response == 'successful' ) {
                    Swal.fire({
                            title: "Usuario Guardado",
                            icon: 'success',
                            });
                 
                $('#nombreComercial').val('');
                $('#proveedorNIT').val('');
                $('#proveedorDireccion').val('');
                $('#telefonoProveedor').val('');
                $('#descripcionProveedor').val('');
               
                
            }
            }
      });
    event.preventDefault();
  }) //fin de la funcion de instertar Proveedor*/


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
                        $('#correoAsesor').val('');
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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  // Actualizar Asesor Proveedor

  $("#editar_asesor").submit(function( event ) { //id  del formulario donde esta el input
    $('#editar_asesor').attr("disabled", true); //nombre ???
    var parametros = $(this).serialize();
       $.ajax({
                type: "POST",
                url: "ajax/ajaxEditarAsesor.php",
                data: parametros,
                beforeSend: function(objeto){},
                success: function(response){
                 console.log(response);
                if(response == 'successful' ){
                        Swal.fire({
                        title: "El usuario Actualizado",
                        icon: 'success',
                        
                        });
                        $('#idAsesor').val('');
                        }
                if (response == 'replica') {
                    Swal.fire({
                            title: "Usuario No Existe",
                            icon: 'error',
                            });
                 
                $('#idProveedor').val('Seleccione Proveedor');
                $('#nombreAsesor').val('');
                $('#telefonoAsesor').val('');
                $('#correoAsesor').val('');
                $('#estadoAsesor').val('Seleccione Estado del Asesor');
                $('#idAsesor').val('');
                
            }
            }/*,
            error: function() {
              console.log("No se ha podido obtener la información");
            }*/
      });
    event.preventDefault();
  }) //fin de la funcion de Actualizar Asesor Proveedor

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  // Actualizar PROVEEDOR

  $("#editar_Proveedor").submit(function( event ) { //id  del formulario donde esta el input
    $('#editar_proveedor').attr("disabled", true); //nombre ???
    var parametros = $(this).serialize();
       $.ajax({
                type: "POST",
                url: "ajax/ajaxEditarProveedor.php",
                data: parametros,
                beforeSend: function(objeto){},
                success: function(response){
                 console.log(response);
                if(response == 'successful' ){
                        Swal.fire({
                        title: "El Proveedor Actualizado",
                        icon: 'success',
                        
                        });
                        $('#idAsesor').val('');
                        }
                if (response == 'replica') {
                    Swal.fire({
                            title: "Proveedor No Existe",
                            icon: 'error',
                            });
                 
                            $('#nombreComercial').val('');
                            $('#proveedorNIT').val('');
                            $('#proveedorDireccion').val('');
                            $('#telefonoProveedor').val('');
                            $('#descripcionProveedor').val('');
                            $('#idProveedor').val('');
                
            }
            }/*,
            error: function() {
              console.log("No se ha podido obtener la información");
            }*/
      });
    event.preventDefault();
  }) //fin de la funcion de Actualizar Asesor Proveedor




}); // End Ready  //FIN DEL READY de la carga de la pagina 
