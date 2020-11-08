//documento jquery que se activa en base a la funcion load 

$(document).ready(function(){
    //===================VARIABLES ========================
   
    // boton editar  Proveedor
    //================FIN VARIABLEs

    //incializa la tablaAsignarProveedores con la libreria DataTable que lista todos los proveedores
    tablaProductosSinAsignar = $('#tablaProductosSinAsignar').DataTable({  // incializa la tabla proveedores
    "columnDefs":[{
      "targets": -1,
      "data":null,
      // incia 3 botones del dataTable 
      "defaultContent": "<div class='text-center'><div class='btn-group'> <button type='button' class='btn btn-success btnVerProductosSinAsignar'><i class='far fa-eye'></i></button> <button class='btn btn-warning btnAsignarProductosSinAsignar'>Asignar<i class='far fa-edit'></i></button>  </div></div>"  
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
    //------------fin inicializacion de la estructura de DataTable que lista los proveedores 

  
 //------SELECT que contiene las sucursales y que desplegara una tabla de productos sin asignar a la sucursal
    $("#SeleccionSucursalAsignar").change(function(){
    idSucursal=$(this).val();//obitne el value del option select que estamos seleccionamos
    action = 'cargarProductoSinAsignar'; //la accion o el id al cual ingresara en el ajax
    console.log("ingreso a select de sucursales a capturar ID");
    console.log(idSucursal);

  //  $('#tablaProductosSinAsignar').DataTable().destroy();//destruye el datatable en caso de haberse incializado antes
   //  var tablaProductosSinAsignar = $('#tablaProductosSinAsignar').DataTable({
     //   "ajax":{ //aqui se indica que vamos a hacer con los datos obtenidos del formulario
     $.ajax({//aqui se indica que vamos a hacer con los datos obtenidos del formulario
            type: "POST",
            url: "./ajax/ajaxAsignarProductos.php", //indica el Ajax donde se procesara los parametros enviados 
            data: {action:action,idSucursal:idSucursal},//parametros que va a enviar al ajax en POST
            success: function(arregloProductosSinAsignar){
                console.log("ingresando a succes de ajaxAsignarProductos a Sucursal");
                if(arregloProductosSinAsignar == 'replica'){ // en caso de que el valor de data2 que viene del ajax sea replica es porque la comparacion con BD ya existia el dato indica que no hay prductos sin asociar
                    Swal.fire({
                        title: "Sin Producto para Asignar", //titulo del modal
                        icon: 'error', //tipo de advertencia modal
                    });
                    tablaProductosSinAsignar = $('#tablaProductosSinAsignar').DataTable();
                    tablaProductosSinAsignar.clear(); //limpia la tabla 
                    tablaProductosSinAsignar.draw(); //incializa la tabla con ninguna fila
                    console.log("Sin Productos para Asignar");   // // imprime en consola para el desarrolador ver el valro que esta obteniendo 
                }//fin condicional en caso de no haber productos para asignar 
                else { // en caso de  haber productos carga datos a la tabla
                    sucursal=$('select[id="SeleccionSucursalAsignar"] option:selected').text();
                     $('#nombreSucursalSinAsignar').val(sucursal);
                    console.log("entrando cargar productos para asignar");
                    $('#tablaProductosSinAsignar').DataTable().destroy();//destruye el datatable en caso de haberse incializado antes
                    var tablaProductosSinAsignar = $("#tablaProductosSinAsignar").DataTable({
                        "ajax":{
                            "method":"POST",
                            "data": {action:action,idSucursal:idSucursal},
                            "url":"./ajax/ajaxAsignarProductos.php"
                        },//din del ajax dentro de otro DataTable
                        "columns":[
                            {"data":"id"},
                            {"data":"sku"},
                            {"data":"nombre"},
                            {"data":"marca"},
                            {"defaultContent": "<div class='text-center'><div class='btn-group'> <button type='button' class='btn btn-success btnVerProductosSinAsignar'><i class='far fa-eye'></i></button> <button class='btn btn-warning btnAsignarProductosSinAsignar'>Asignar<i class='far fa-edit'></i></button>  </div></div>"}
                        ],
                        "language": {
                            "lengthMenu": "Mostrar _MENU_ registros",
                            "zeroRecords": "No se encontraron resultados",
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sSearch": "Buscar:",
                            "oPaginate":{
                                "sFirst": "Primero",
                                "sLast":"Último",
                                "sNext":"Siguiente",
                                "sPrevious": "Anterior"
                            },
                             "sProcessing":"Procesando...",
                          }
                    });//fin de la funcion DataTable qeu se ejecuta dentro de la funcion datatable ya que primero tiene que comparar
                }//fin del else que carga productos a la tabla ya que hay productos para asignar a una sucursal
            }//fin de la opcion succes
        });//}//cerrando el Ajax General del DataTable
  //  }); //fucion datatable verasesores asociado 
});//Fin funcion select
 
 // --------------FIN DEL SELECT SeleccionSucursalAsignar
 
    // ---------------BOTON VER PRODUCTOS SIN ASIGNAR-----------------
    $(document).on("click", ".btnVerProductosSinAsignar", function(){
    // estado de inputs o botons habilita o deshabilita
    $('#codigoProductoSinAsignar').prop('disabled', true);
    $('#skuProductoSinAsignar').prop('disabled', true);
    $('#nombreProductoSinAsignar').prop('disabled', true);
    $('#descripcionProductoSinAsignar').prop('disabled', true);
    $('#presentacionProductoSinAsignar').prop('disabled', true);
    $('#marcaProductoSinAsignar').prop('disabled', true);
    $('#estadoProductoSinAsignar').prop('disabled', true);
    $('#subcategoriaProductoSinAsignar').prop('disabled', true);
    //const $estadoBTNGuardar = document.querySelector("#btnGuardarAsesor");//selecciona el elemento del modal y lo pasa a una variable local
    //  $estadoBTNGuardar.style.display = "none"; // oculta el boton guardar

    fila = $(this).closest("tr");
    idProductoSinAsignar = parseInt(fila.find('td:eq(0)').text());
    codigo = fila.find('td:eq(1)').text();
    nombreProducto = fila.find('td:eq(2)').text();
    marca = fila.find('td:eq(3)').text();
    console.log(idProductoSinAsignar);
    action = 'obtenerProductoSinAsignar';// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
    intencion = "ProductoSinAsignar";
    //al presionar el boton nuevo la variable global action cambia a agregar producto 
    
    $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
        url: './ajax/ajaxAsignarProductos.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
        type: "POST",
        //dataType: 'json', 
        async: true,
        data: {action:action,intencion:intencion,idProductoSinAsignar:idProductoSinAsignar}, //envia valores al ajax action y el id
        success: function(response){ //recibe una respuesta con una array json
          console.log("Respuesta AJAX Productos sin asignar");
          console.log(action);
         
            if (response != 'error') {
              console.log(response); // imprimimos en consola para saber el array que nos devuelve
               data3 = JSON.parse(response); //parsea a fotmato el array del ajax en json
               
              //  data2 = JSON.parse(data2);
                $('#codigoProductoSinAsignar').val(data3.id); // carga el valor de data2.nombre en un input del modal nuevo_proveedor el cual tenga el id nombreComercial y los de abajo tambien
                $('#skuProductoSinAsignar').val(data3.sku);
                $('#nombreProductoSinAsignar').val(data3.nombre);
                $('#descripcionProductoSinAsignar').val(data3.descripcion);
                $('#presentacionProductoSinAsignar').val(data3.presentacion);
                $('#marcaProductoSinAsignar').val(data3.marca);
                $('#estadoProductoSinAsignar').val(data3.estado);
                $('#subcategoriaProductoSinAsignar').val(data3.subcategoria);
                  
                $(".modal-header").css("background-color","#21c87a");//cambia de colo el header del modal
                $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
                $(".modal-title").text("Inforomacion del Producto");//titulo del header
                $("#modalVerProductoSinAsignar").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
                
                console.log("Fin de carga de datos de Producto sin Asignar");
                console.log(action);
            }
              else{
                    console.log("No existen datos");
                }
        },
        
        error: function(error){
            console.log(error);
        }
        
    });
    
}); 
    //================acciones finalizada para ver asesor

    // ---------------BOTON Asignar  PRODUCTOS SIN ASIGNAR-----------------
    $(document).on("click", ".btnAsignarProductosSinAsignar", function(){
    // estado de inputs o botons habilita o deshabilita
    $('#codigoProductoSinAsignar2').prop('disabled', true);
    $('#skuProductoSinAsignar2').prop('disabled', true);
    $('#nombreProductoSinAsignar2').prop('disabled', true);
    $('#descripcionProductoSinAsignar2').prop('disabled', true);
    $('#presentacionProductoSinAsignar2').prop('disabled', true);
    $('#marcaProductoSinAsignar2').prop('disabled', true);
    $('#estadoProductoSinAsignar2').prop('disabled', true);
    $('#sucursalProductoSinAsignar').prop('disabled', true);
    

    // vacia los campos que se cargaran 
    $('#existenciaProductoSinAsignar').val(''); // carga el valor de data2.nombre en un input del modal nuevo_proveedor el cual tenga el id nombreComercial y los de abajo tambien
    $('#costoProductoSinAsignar').val('');
    $('#precioVentaProductoSinAsignar').val('');
    $('#costoMinimoProductoSinAsignar').val('');
    $('#costoPromocionProductoSinAsignar').val('');
   

    //const $estadoBTNGuardar = document.querySelector("#btnGuardarAsesor");//selecciona el elemento del modal y lo pasa a una variable local
    //  $estadoBTNGuardar.style.display = "none"; // oculta el boton guardar

    fila = $(this).closest("tr");
  
    idProductoSinAsignar = parseInt(fila.find('td:eq(0)').text());
    codigo = fila.find('td:eq(1)').text();
    nombreProducto = fila.find('td:eq(2)').text();
    marca = fila.find('td:eq(3)').text();
    console.log(idProductoSinAsignar);
    action = "obtenerProductoSinAsignar";// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
    intencion = "ProductoSinAsignar";
    //al presionar el boton nuevo la variable global action cambia a agregar producto 
   
  
           $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
              url: './ajax/ajaxAsignarProductos.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
              type: "POST",
              //dataType: 'json', 
              async: true,
              data: {action:action,intencion:intencion,idProductoSinAsignar:idProductoSinAsignar}, //envia valores al ajax action y el id
              success: function(response){ //recibe una respuesta con una array json
                console.log("Respuesta AJAX Productos sin asignar");
                console.log(action);
               
                  if (response != 'error') {
                    console.log(response); // imprimimos en consola para saber el array que nos devuelve
                     data3 = JSON.parse(response); //parsea a fotmato el array del ajax en json
                     
                    //  data2 = JSON.parse(data2);
                      $('#codigoProductoSinAsignar2').val(data3.id); // carga el valor de data2.nombre en un input del modal nuevo_proveedor el cual tenga el id nombreComercial y los de abajo tambien
                      $('#skuProductoSinAsignar2').val(data3.sku);
                      $('#nombreProductoSinAsignar2').val(data3.nombre);
                      $('#descripcionProductoSinAsignar2').val(data3.descripcion);
                      $('#presentacionProductoSinAsignar2').val(data3.presentacion);
                      $('#marcaProductoSinAsignar2').val(data3.marca);
                      $('#estadoProductoSinAsignar2').val(data3.estado);
                      idSucursal=$('#SeleccionSucursalAsignar').val();
                     
                     sucursal=$('select[id="SeleccionSucursalAsignar"] option:selected').text();
                     $('#nombreSucursalSinAsignar').val(sucursal);
                     console.log('El texto seleccionado es:',  $('select[id="SeleccionSucursalAsignar"] option:selected').text());
                     console.log(idSucursal);
                     
                     
                     $("#SucursalAsignar").val(idSucursal).change();
                                            
                        $(".modal-header").css("background-color","#ffae1c");//cambia de colo el header del modal
                        $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
                        $(".modal-title").text("Asignar Precio al Producto");//titulo del header
                        $("#modalGuardarAsignacionProducto").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
                                        
                      
                      action = 'guardarAsignacionProducto'; // la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
                      //al finalizar la carga de datos la variable global action cambia a editar  producto  para cuando le de en submit busque action= editar proveedor
                      console.log("Fin de carga de datos de Producto sin Asignar");
                      console.log(action);
                    }else{
                  
                  console.log("No existen datos")
                  
                      }
              
  
              },
              error: function(error){
                console.log(error);
                }
              
            });
    
    
   
  }); 
    //================acciones finalizada para ver asesor


    // ---------------SUBMIT FORM GUARDAR del Modal asignacion modal  PRODUCTOS SIN ASIGNAR-----------------
    $("#formGuardarProductoSinAsignar").submit(function( event ) {
    // estado de inputs o botons habilita o deshabilita
    idProductoAsignar=$.trim($("#codigoProductoSinAsignar2").val());
    existencias=$.trim($("#existenciaProductoSinAsignar").val());
    precioCosto=$.trim($("#costoProductoSinAsignar").val());
    precioVenta=$.trim($("#precioVentaProductoSinAsignar").val());
    precioMinimo=$.trim($("#costoMinimoProductoSinAsignar").val());
    precioPromocion=$.trim($("#costoPromocionProductoSinAsignar").val());
    estadoProducto=$('select[id="estadoProductoSinAsignar"] option:selected').text();
    sucursalProducto=$("#sucursalProductoSinAsignar").val();
    usuarioEncargado=$("#usaurioProductoSinAsignar2").val();
    idSucursal=$('#SeleccionSucursalAsignar').val();
    
    console.log(usuarioEncargado,existencias,precioCosto,precioVenta,precioMinimo,precioPromocion,estadoProducto,idSucursal);
    
   
    
    sucursal=$('select[id="estadoProductoSinAsignar"] option:selected').text();
    console.log('El texto seleccionado es:',  $('select[id="estadoProductoSinAsignar"] option:selected').text());
    //const $estadoBTNGuardar = document.querySelector("#btnGuardarAsesor");//selecciona el elemento del modal y lo pasa a una variable local
    //  $estadoBTNGuardar.style.display = "none"; // oculta el boton guardar

    fila = $(this).closest("tr");
  
    action = "guardarPrecioProductoSinAsignar";// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
    intencion = "guardarProductoSinAsignar";
    //al presionar el boton nuevo la variable global action cambia a agregar producto 
   
  
           $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
              url: './ajax/ajaxAsignarProductos.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
              type: "POST",
              //dataType: 'json', 
              async: true,
              data: {action:action,intencion:intencion,idProductoSinAsignar:idProductoSinAsignar,
                existencias:existencias,
                precioCosto:precioCosto,
                precioVenta:precioVenta,
                precioMinimo:precioMinimo,
                precioPromocion:precioPromocion,
                estadoProducto:estadoProducto,
                idProductoAsignar:idProductoAsignar,
                idSucursal:idSucursal,
                usuarioEncargado:usuarioEncargado}, //envia valores al ajax action y el id
              success: function(data2){ //recibe una respuesta con una array json
                console.log("Respuesta AJAX PRRECIO sin asignar");
                console.log(action);
               
                if(data2 == 'replica'){ // en caso de que el valor de data2 que viene del ajaxProveedore sea replica es porque la comparacion con BD ya existia el dato y no se pudo ejecutar la consulta 
                    Swal.fire({
                    title: "ERROR al asignar PRECIO", //titulo del modal
                    icon: 'error', //tipo de advertencia modal
                    timer: 3000                     
                    });
                     // vacia el input ProveedorNIT del modal 
                    console.log("rechazado PRECIO ERROR");   // // imprime en consola para el desarrolador ver el valro que esta obteniendo 
                  }

                  else{// de lo contrario el msj sera usuario guardado 
                  Swal.fire({
                          title: "Precio Asignado Correctamente",
                          icon: 'success',
                          timer: 2000
                          }).then(function() {
                            window.location = "asignarPrecios.php";
                          });

                          console.log("Precio Asignado Correctamente"); 
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

