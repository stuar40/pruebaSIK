
$(document).ready(function(){
    //===================VARIABLES ========================
   
    // boton editar  Proveedor
    //================FIN VARIABLEs

// ---------------SUBMIT FORM GUARDAR del Modal asignacion modal  PRODUCTOS SIN ASIGNAR-----------------
$("#Formguardar_Egresos").submit(function( event ) {
    // estado de inputs o botons habilita o deshabilita
    idSucursal=$('#SeleccionSucursalEgreso').val();
    descripcionEgreso=$.trim($("#descripcionEgreso").val());
    montoEgreso=$.trim($("#montoEgreso").val());
    fechaEgreso=$.trim($("#fechaEgreso").val());
    usuarioEgreso=$.trim($("#usuarioEgreso").val());

    
    
    
    console.log(idSucursal,descripcionEgreso,montoEgreso,fechaEgreso,usuarioEgreso);
    
   
    
    sucursal=$('select[id="SeleccionSucursalEgreso"] option:selected').text();
    console.log('El texto seleccionado es:',  $('select[id="SeleccionSucursalEgreso"] option:selected').text());
   
    
  
    action = "guardarEgreso";// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
    intencion = "guardarEgreso";
    //al presionar el boton nuevo la variable global action cambia a agregar producto 
   
  
           $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
              url: './ajax/ajaxEgresosEconomicos.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
              type: "POST",
              //dataType: 'json', 
              async: true,
              data: {action:action,
                idSucursal:idSucursal,
                descripcionEgreso:descripcionEgreso,
                montoEgreso:montoEgreso,
                fechaEgreso:fechaEgreso,
                usuarioEgreso:usuarioEgreso}, //envia valores al ajax action y el id
              success: function(data2){ //recibe una respuesta con una array json
                console.log("Respuesta AJAX egreso sin asignar");
                console.log(action);
               
                if(data2 == 'replica'){ // en caso de que el valor de data2 que viene del ajaxProveedore sea replica es porque la comparacion con BD ya existia el dato y no se pudo ejecutar la consulta 
                    Swal.fire({
                    title: "ERROR al asignar EGRESO ECONOMICO", //titulo del modal
                    icon: 'error', //tipo de advertencia modal
                    timer: 3000                     
                    });
                     // vacia el input ProveedorNIT del modal 
                    console.log("rechazado EGRESO ERROR");   // // imprime en consola para el desarrolador ver el valro que esta obteniendo 
                  }

                  else{// de lo contrario el msj sera usuario guardado 
                  Swal.fire({
                          title: "Egreso Registrado Correctamente",
                          icon: 'success',
                          timer: 2000
                          }).then(function() {
                            window.location = "nuevoEgresoEconomico.php";
                          });

                          console.log("Egreso Registrado Correctamente"); 
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

