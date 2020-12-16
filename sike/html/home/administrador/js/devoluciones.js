$(document).ready(function(){
    //===================VARIABLES ========================
    
    //================FIN VARIABLEs

//incializa la tablaProveedores con la libreria DataTable que lista todos los proveedores
tablaDevoluciones = $('#tablaDevoluciones').DataTable({  // incializa la tabla proveedores

      
      //Para cambiar el lenguaje a español
  "language": {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
      }
  });    
  //------------fin inicializacion de la estructura de DataTable que lista los proveedores 

  //incializa la tablaVentas con la libreria DataTable que lista todas las facturas o ventas
tablaVentas = $('#tablaVentas').DataTable({  // incializa la tabla proveedores
  "columnDefs":[{
    "targets": -1,
    "data":null,
    // incia 3 botones del dataTable 
    "defaultContent": "<div class='text-center'><div class='btn-group'> <button type='button' class='btn btn-success btnCambiar'>Ver/Cambio<i class='far fa-eye'></i></button><button type='button' class='btn btn-warning btnIntercarmbiar'>Intercambio</button> <button type='button' class='btn btn-facebook btnDevolver'>Devolver</button> </div></div>"  
   }], 
  
  //Para cambiar el lenguaje a español
  "language": {
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "No se encontraron resultados",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sSearch": "Buscar:",
      "oPaginate": {
          "sFirst": "Primero",
          "sLast":"Último",
          "sNext":"Siguiente",
          "sPrevious": "Anterior"
       },
       "sProcessing":"Procesando...",
  }
});
//------------fin inicializacion de la estructura de DataTable que lista los  


  //incializa la tablaVentas con la libreria DataTable que lista todas las facturas o ventas
  tablaDetallesVentas = $('#tablaDetallesVentas').DataTable({  // incializa la tabla proveedores
  
    //Para cambiar el lenguaje a español
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast":"Último",
            "sNext":"Siguiente",
            "sPrevious": "Anterior"
         },
         "sProcessing":"Procesando...",
    }
  });
  //------------fin inicializacion de la estructura de DataTable que lista los  
  

    //------------Funcion Click del Boton Cambiar Producto 
  $("#cambiarProducto").click(function(){
  //$(document).on("click", ".cambiarProducto2", function(){
    $(".modal-header").css("background-color","#ffbc42");//cambia de colo el header del modal
    $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
    $(".modal-title").text("Devoluciones");//titulo del header
    //$("#modalGuardarAsignacionProducto").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
  const $estadoTablaVentas = document.querySelector("#contenedorTablaVentas");//selecciona el elemento del modal y lo pasa a una variable local
  $estadoTablaVentas.style.display = "Block"; // Muestra el boton guardar
  const $estadoTablaDevoluciones = document.querySelector("#contenedorTablaDevoluciones");//selecciona el elemento del modal y lo pasa a una variable local
  $estadoTablaDevoluciones.style.display = "none"; // oculta el boton guardar
  });
  //------------fin del Boton Cambiar Producto  

    //------------Funcion Click del Boton Cambiar Producto 
    $("#intercambiarProducto").click(function(){
      //$(document).on("click", ".cambiarProducto2", function(){
     
        $(".modal-header").css("background-color","#ffbc42");//cambia de colo el header del modal
        $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
        $(".modal-title").text("Devoluciones");//titulo del header
        //$("#modalGuardarAsignacionProducto").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
      const $estadoTablaVentas = document.querySelector("#contenedorTablaVentas");//selecciona el elemento del modal y lo pasa a una variable local
      $estadoTablaVentas.style.display = "Block"; // Muestra el boton guardar
      const $estadoTablaDevoluciones = document.querySelector("#contenedorTablaDevoluciones");//selecciona el elemento del modal y lo pasa a una variable local
      $estadoTablaDevoluciones.style.display = "none"; // oculta el boton guardar
      });
      //------------fin del Boton Cambiar Producto 

          //------------Funcion Click del Boton Cambiar Producto 
  $("#devolverProducto").click(function(){
    //$(document).on("click", ".cambiarProducto2", function(){
   
      $(".modal-header").css("background-color","#ffbc42");//cambia de colo el header del modal
      $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
      $(".modal-title").text("Devoluciones");//titulo del header
     // $("#modalDevolucionesProductosSimilar").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
     const $estadoTablaVentas = document.querySelector("#contenedorTablaVentas");//selecciona el elemento del modal y lo pasa a una variable local
      $estadoTablaVentas.style.display = "Block"; // Muestra el boton guardar
      const $estadoTablaDevoluciones = document.querySelector("#contenedorTablaDevoluciones");//selecciona el elemento del modal y lo pasa a una variable local
     $estadoTablaDevoluciones.style.display = "none"; // oculta el boton guardar
    });
    //------------fin del Boton Cambiar Producto 

      //------------Funcion Click del Boton Listar Devoluciones
  $("#listarDevoluciones").click(function(){
    //$(document).on("click", ".cambiarProducto2", function(){
   
      $(".modal-header").css("background-color","#ffbc42");//cambia de colo el header del modal
      $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
      $(".modal-title").text("Devoluciones");//titulo del header
     // $("#modalDevolucionesProductosSimilar").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
     const $estadoTablaDevoluciones = document.querySelector("#contenedorTablaDevoluciones");//selecciona el elemento del modal y lo pasa a una variable local
     $estadoTablaDevoluciones.style.display = "block"; // oculta el boton guardar
     const $estadoTablaVentas = document.querySelector("#contenedorTablaVentas");//selecciona el elemento del modal y lo pasa a una variable local
     $estadoTablaVentas.style.display = "none"; // oculta el boton guardar
    });
    //------------fin del Boton Cambiar Producto 
  
//------------btn
$(document).on("click", ".btnCambiar", function(){
  //Variables
  fila = $(this).closest("tr"); //variable que toma la fila 
  
  numFactura=parseInt(fila.find('td:eq(0)').text()); //obitne el value de la primera columan de la fila donde estamos clickeando que estamos seleccionamos
  fechaFactura=fila.find('td:eq(1)').text();
  nombreCliente=fila.find('td:eq(2)').text();
  totalFactura=parseInt(fila.find('td:eq(3)').text());
  

  action = 'cargar_DetalleVenta'; //la accion o el id al cual ingresara en el ajaxAsesores
  console.log(numFactura); // imprime en consola para el desarrolador ver el valro que esta obteniendo 
  console.log(action); // imprime en consola para el desarrolador ver el valro que esta obteniendo 
  
  
  //Estados de botones y campos 
      //Muestra la tabla donde estan los detalles de la factura al seleccinar un producto a intercambiar
      const $contenedorTablaDetalleVentas = document.querySelector("#contenedorTablaDetalleVentas");//selecciona el elemento del modal y lo pasa a una variable local
      $contenedorTablaDetalleVentas.style.display = "block"; // Muestra el boton guardar
      //Oculta el div  donde estan el formulario del producto a intercambiar
      const $contenedorFormIntercambio = document.querySelector("#contenedorFormIntercambio");//selecciona el elemento del modal y lo pasa a una variable local
      $contenedorFormIntercambio.style.display = "none"; // Muestra el boton guardar
      $('#numFacturaIntercambiar').val(numFactura); 
      $('#ClienteIntercambio').val(nombreCliente); 
      $('#fechaFacturaIntercambio').val(fechaFactura); 
      $('#totalFacturaIntercambio').val(totalFactura); 

      ///--------

      
                $('#tablaDetallesVentas').DataTable().destroy();
                 var tablaDetallesVentas = $("#tablaDetallesVentas").DataTable({
                  
                    "ajax":{
                    "method":"POST",
                    "data": {action:action,numFactura:numFactura},
                    "url":"ajax/ajaxDevoluciones.php"
                    
                },
    
                  "columns":[
                            
                            {"data":"iddetalleventa"},
                            {"data":"nombre"},
                            {"data":"precio"},
                            {"data":"cantidad"},
                            {"defaultContent": "<div class='text-center'><div class='btn-group'> <button type='button' class='btn btn-success btnCambiarProducto'>Cambiar</button> </div></div>"}
                            
                          ],

                           
                            //Para cambiar el lenguaje a español
                  "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                     },
                     "sProcessing":"Procesando...",
                  }
                          
                   });



  $(".modal-header").css("background-color","#ffbc42");//cambia de colo el header del modal
  $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
  $(".modal-title").text("Devoluciones");//titulo del header
  $("#modalIntercambiarProducto").modal("show"); //al clickear 



});
//------------btn del modal ver detalles ventas
$(document).on("click", ".btnCambiarProducto", function(){
      //Variables
      fila = $(this).closest("tr"); //variable que toma la fila 
        
      codDetalle=parseInt(fila.find('td:eq(0)').text()); //obitne el value de la primera columan de la fila donde estamos clickeando que estamos seleccionamos
      ProductoDetalle=fila.find('td:eq(1)').text();
      precioDetalle=fila.find('td:eq(2)').text();
      cantidadDetalle=parseInt(fila.find('td:eq(3)').text());

     
      //Estados de botones y campos 
     
     $('#codProductoIntercambiar').val(codDetalle); 
     $('#productoIntercambiar').val(ProductoDetalle); 
     $('#precioIntercambio').val(precioDetalle); 
     $('#cantidadIntercambiar').val(cantidadDetalle); 

  //Oculta la tabla donde estan los detalles de la factura al seleccinar un producto a intercambiar
  const $contenedorTablaDetalleVentas = document.querySelector("#contenedorTablaDetalleVentas");//selecciona el elemento del modal y lo pasa a una variable local
  $contenedorTablaDetalleVentas.style.display = "none"; // Muestra el boton guardar
//Muestra el div  donde estan el formulario del producto a intercambiar
  const $contenedorFormIntercambio = document.querySelector("#contenedorFormIntercambio");//selecciona el elemento del modal y lo pasa a una variable local
  $contenedorFormIntercambio.style.display = "Block"; // Muestra el boton guardar


});

//------------btn
$(document).on("click", ".btnDevolver", function(){
  $(".modal-header").css("background-color","#ffbc42");//cambia de colo el header del modal
  $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
  $(".modal-title").text("Devoluciones");//titulo del header
  $("#modalAnularFactura").modal("show"); //al clickear 
});





  // ---------------SUBMIT FORM GENERAR KARDEX   PRODUCTOS SIN ASIGNAR-----------------
$("#formGuardarIntercambioProducto").submit(function( event ) {
    // estado de inputs o botons habilita o deshabilita
    
    numFacturaIntercambiar=$('#numFacturaIntercambiar').val();
    clienteIntercambiar=$('#ClienteIntercambio').val();
    codProductoIntercambiar=$('#codProductoIntercambiar').val();
    precioIntercambio=$('#precioIntercambio').val();
    cantidadIntercambiar=$('#cantidadIntercambiar').val();
    motivoIntercambio=$('#motivoIntercambio').val();
   
    action="guardarDevolucion";
    console.log(numFacturaIntercambiar);

    $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
      url: './ajax/ajaxDevoluciones.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
      type: "POST",
      //dataType: 'json', 
      async: true,
      data: { action:action,
        numFacturaIntercambiar:numFacturaIntercambiar,
        clienteIntercambiar:clienteIntercambiar,
        codProductoIntercambiar:codProductoIntercambiar,
        precioIntercambio:precioIntercambio,
        cantidadIntercambiar:cantidadIntercambiar,
        motivoIntercambio:motivoIntercambio}, //envia valores al ajax action y el id
      success: function(data2){ //recibe una respuesta con una array json
        console.log("Respuesta AJAX DEVOLUCION");
        console.log(action);
       
        if(data2 == 'replica'){ // en caso de que el valor de data2 que viene del ajaxProveedore sea replica es porque la comparacion con BD ya existia el dato y no se pudo ejecutar la consulta 
            Swal.fire({
            title: "ERROR al ingresar Devolucion", //titulo del modal
            icon: 'error', //tipo de advertencia modal
            timer: 3000                     
            });
             // vacia el input ProveedorNIT del modal 
            console.log("rechazado DEVOLUCION ERROR");   // // imprime en consola para el desarrolador ver el valro que esta obteniendo 
          }

          else{// de lo contrario el msj sera usuario guardado 
          Swal.fire({
                  title: "DEVOLUCION Registrada Correctamente",
                  icon: 'success',
                  timer: 2000
                  }).then(function() {
                    window.location = "devoluciones.php";
                  });

                  console.log("DEVOLUCION Registrada Correctamente"); 
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