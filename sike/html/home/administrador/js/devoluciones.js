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
    $("#modalDevolucionesProductosSimilar").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
   
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
  
  // ---------------SUBMIT FORM GENERAR KARDEX   PRODUCTOS SIN ASIGNAR-----------------
$("#FormKardex").submit(function( event ) {
    // estado de inputs o botons habilita o deshabilita
    
    fechaKardex=$('#fechaKardex').val();
    fechaMesKardex=$('#fechaMesKardex').val();
    SeleccionSucursalAsignar=$('#SeleccionSucursalAsignar').val();
    action="cargarKardex"
    console.log(fechaKardex,fechaMesKardex,SeleccionSucursalAsignar,action);

    $.ajax({ //aquei se indica que vamos a hacer con los datos obtenidos del formulario
        type: "POST",
        url: "ajax/ajaxKardex.php",
        //data: parametros,
        data: { action:action,
                fechaKardex:fechaKardex,
                fechaMesKardex:fechaMesKardex,
                SeleccionSucursalAsignar:SeleccionSucursalAsignar},
        dataType: 'json', //indica que el valor que devuelve el ajax es json para poder manipular en js
        
        success: function(arreglo){
          console.log("RESPUESTA AJAX DATOS del KARDEX"); 
          console.log(arreglo);
          
         
         // condicionales dependiendo de la respuesta de DATA2 que provenga de AJAXAsesores.php 
        //if(data2.estado == 'replica'){
          if(arreglo == 'vacio'){
                Swal.fire({
                title: "FECHA SIN DATOS",
                icon: 'error',
                timer: 2000
                });
               
                console.log("Condicional rechazado no se encontro datos en kardex");  
                console.log(arreglo); 
              }
       
          else  {
            //aqui valida que si hay datos en la fecha seleccionada
                console.log("Condicional Mostrando datos KARDEX")
            $('#tablaKardex').DataTable().destroy();
               var tablaKardex = $("#tablaKardex").DataTable({
                
                  "ajax":{
                  "method":"POST",
                  "data": { action:action,
                            fechaKardex:fechaKardex,
                            fechaMesKardex:fechaMesKardex,
                            SeleccionSucursalAsignar:SeleccionSucursalAsignar},
                  "url":"ajax/ajaxKardex.php"
                  
              },
              
               
               "columns":[
                          {"data":"idkardex"},
                          {"data":"fecha"},
                          {"data":"factura"},
                          {"data":"detalle"},
                          {"data":"movimiento"},
                          {"data":"cantcompra"},
                          {"data":"preciocompra"},
                          {"data":"totalcompra"},
                          {"data":"cantventa"},
                          {"data":"precioventa"},
                          {"data":"totalventa"},
                          {"data":"existencia"}
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
                console.log(arreglo);
                   }
    }
});// fin del ajax GENERAL

            event.preventDefault();
   
  }); 
    //================acciones finalizada para ver asesor



}); // End Ready  //FIN DEL READY de la carga de la pagina 