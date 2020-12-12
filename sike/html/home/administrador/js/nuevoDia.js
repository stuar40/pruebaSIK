$(document).ready(function(){
$("#Formguardar_NuevoDia").submit(function( event ) {
    // estado de inputs o botons habilita o deshabilita
    idSucursal=$('#SeleccionSucursal').val();

    montoDia=$.trim($("#montoDia").val());

    console.log(idSucursal,montoDia);

    sucursal=$('select[id="SeleccionSucursal"] option:selected').text();
    console.log('El texto seleccionado es:',  $('select[id="SeleccionSucursal"] option:selected').text());
   
    action = "guardarDia";// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
    intencion = "guardarDia";
    //al presionar el boton nuevo la variable global action cambia a agregar producto 

           $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
              url: 'ajax/ajaxNuevoDia.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
              type: "POST",
              //dataType: 'json', 
              async: true,
              data: {action:action,
                idSucursal:idSucursal,
                montoDia:montoDia
              }, //envia valores al ajax action y el id
              success: function(data2){ //recibe una respuesta con una array json
                console.log("Respuesta AJAX egreso sin asignar");
                console.log(action);
               
                if(data2 == 'error'){ // en caso de que el valor de data2 que viene del ajaxProveedore sea replica es porque la comparacion con BD ya existia el dato y no se pudo ejecutar la consulta 
                    Swal.fire({
                    title: "ERROR ", //titulo del modal
                    icon: 'error', //tipo de advertencia modal
                    timer: 3000                     
                    });
                     // vacia el input ProveedorNIT del modal 
                    console.log("rechazado EGRESO ERROR");   // // imprime en consola para el desarrolador ver el valro que esta obteniendo 
                  }

                  else{// de lo contrario el msj sera usuario guardado 
                  Swal.fire({
                          title: "Nuevo Dia Ingresado",
                          icon: 'success',
                          timer: 2000
                          }).then(function() {
                            window.location = "nuevoDia.php";
                          });

                          console.log("Dia Registrado Correctamente"); 
                      }
              
  
              },
              error: function(error){
                console.log(error);
                }
              
            });
            
         event.preventDefault();
   
  }); 
    //================acciones finalizada para ver asesor

    }); // End Ready  //FIN DEL READY de la carga de la pagina 

