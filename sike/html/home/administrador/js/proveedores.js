//documento jquery que se activa en base a la funcion load 

$(document).ready(function(){
//===================VARIABLES ========================
var fila; //captura valores de la fila para editar, ver, ver asesores asociado
var idProveedor=0; // incializa la variable del id del Proveedor como variable global para ser utilizada en mas opciones
var idAsesor=0;// incializa la variable del id del Asesor como variable global para ser utilizada en la opcion obtener datos y actualizar
// boton editar  Proveedor
//================FIN VARIABLEs
  
//incializa la tablaProveedores con la libreria DataTable que lista todos los proveedores
tablaProveedores = $('#tablaProveedores').DataTable({  // incializa la tabla proveedores
    "columnDefs":[{
      "targets": -1,
      "data":null,
      // incia 3 botones del dataTable 
      "defaultContent": "<div class='text-center'><div class='btn-group'> <button type='button' class='btn btn-info btnVer' data-backdrop='false'>ver</button> <button class='btn btn-primary btnEditar'>Editar</button>  <button class='btn btn-danger btnAsesor'>Asesor</button></div></div>"  
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
//incializa la tablaAsesores con la libreria DataTable que lista todos los asesores segun el Proveedor
tablaverAsesores = $('#tablaverAsesores').DataTable({
  "columnDefs":[{
    "targets": -1,
    "data":null,
    //configura 3 botones en la columana vacia del dataTable y su identificador lo coloca en el class en estos casos btnAsesor btnEditarAsesor
    "defaultContent": "<div class='text-center'><div class='btn-group'> <button type='button' class='btn btn-info btnVerAsesor' data-backdrop='false'>ver</button> <button class='btn btn-primary btnEditarAsesor'>Editar</button>  <button class='btn btn-danger btnBorrarAsesor'>Borrar</button></div></div>"  
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
//------------fin inicializacion de la estructura de DataTable 
  //boton que incia el modal de ingresar nuevo proveedor 
$("#nuevoProveedor").click(function(){
  $("#guardar_Proveedor").trigger("reset"); //vacia los campos de texto cuando se abree el modal
  $(".modal-header").css("background-color","#3b5998");//cambia de colo el header del modal
  $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
  $(".modal-title").text("Nuevo Proveedor");//titulo del header
  $("#Modal_Nuevo_Proveedor").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
  id=null;
  opcion = 1; //guardar
  action = 'agregar_Proveedor'; // la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
  //al presionar el boton nuevo la variable global action cambia a agregar producto 
}); // fin del modal


//------------btnEditar Proveedores del DataTable para cargar y editar datos del proveedor tomando base la fila 
$(document).on("click", ".btnEditar", function(){
  fila = $(this).closest("tr"); //varialbe que toma la fila del dataTable

  id = parseInt(fila.find('td:eq(0)').text()); // toma la 0 posicion de la fila donde se esta clickeando el btnEditar
  proveedor = fila.find('td:eq(1)').text();// toma la 1 posicion de la fila donde se esta clickeando el btnEditar
  telefono = fila.find('td:eq(2)').text();// toma la 2 primera posicion de la fila donde se esta clickeando el btnEditar
  descripcion = fila.find('td:eq(3)').text();// toma la 3 posicion de la fila donde se esta clickeando el btnEditar

  action = 'obtener_datos';// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
  //al presionar el boton nuevo la variable global action cambia a agregar producto 
  id_empleado = id; //genera una variable local que se utiliza para enviarse al ajax donde se valida la busqueda
  

          $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
            url: './ajax/ajaxProveedores.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
            type: "POST",
            async: true,
            data: {action:action, id_empleado:id_empleado }, //envia valores al ajax action y el id
            
            success: function(response){ //recibe una respuesta con una array json
              console.log("Imprimir Datos1");
              console.log(action);
             
                if (response != 'error') {

                
                    
                   console.log(response); // imprimimos en consola para saber el array que nos devuelve
                   var data2 = JSON.parse(response); //parsea a fotmato el array del ajax en json
                   
                   // data = JSON.parse(data);
                    $('#nombreComercial').val(data2.nombre); // carga el valor de data2.nombre en un input del modal nuevo_proveedor el cual tenga el id nombreComercial y los de abajo tambien
                    $('#proveedorNIT').val(data2.nit); // carga en el inpunt del modal con el id proveedorNIT lo que obtuvo de vuelta de la funcion obtener_datos del ajaxProveedore
                    $('#proveedorDireccion').val(data2.direccion);
                    $('#telefonoProveedor').val(data2.telefono);
                    $('#descripcionProveedor').val(data2.descripcion);
                    
  
                    $(".modal-header").css("background-color","#21c87a");//cambia de colo el header del modal
                    $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
                    $(".modal-title").text("Editar Proveedor");//titulo del header
                    $("#Modal_Nuevo_Proveedor").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
                    opcion = 2; //editar/*where id ='<!--$d1-->
                    idProveedor= id;
                    action = 'editar_Proveedor'; // la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
                    //al finalizar la carga de datos la variable global action cambia a editar  producto  para cuando le de en submit busque action= editar proveedor
                    console.log("Imprimir Datos2");
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


///-------------------boton ver Asesor en DataTable verAsesor----------------------
$(document).on("click", ".btnAsesor", function(){
  fila = $(this).closest("tr"); //variable que toma la fila del DataTable
  id = parseInt(fila.find('td:eq(0)').text()); //variable donde se almacena en un valor tipo Int la posicion 0 de la fila
  action = 'obtener_datos';// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
  //al presionar el boton nuevo la variable global action cambia a agregar producto 
  id_empleado = id;
  
                $(".modal-header").css("background-color","#21c87a");//cambia de colo el header del modal
                $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
                $(".modal-title").text("Ver Asesores");//titulo del header
                $("#Modal_Ver_Asesor").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
                opcion = 2; //editar
                idProveedor= id;
                action = 'verAsesores'; // la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
                //al finalizar la carga de datos la variable global action cambia a editar  producto  para cuando le de en submit busque action= editar proveedor
               
  
 
});
//////----------------------fin boton ver asesor--------------

//--- Busca Proveedor en base al input buscar que tiene ide txtSearch----------
  if($('#txtSearch').length){ // cuando se teclea en el input con id txtSearch captura los valores para luego buscarlos en la BD las que contengan la letra
    console.log("aqui ");
    $('#txtSearch').keyup(function(){ //captura los caracteres ingresados
      console.log("aqui3 ");
    const dataSearch = $('#txtSearch').val();
    const dataSearch3 = $('#txtSearch2').val();
    const action = 'searchContactKey';
    var dataContact = '';
    $.ajax({
    url: './ajax/ajaxProveedores.php',
    type: "POST",
    async: true,
    data:   {
    action:action, dataSearch:dataSearch,dataSearch3: dataSearch3
            },
        beforeSend: function(){
            
                                },
    success: function(response){
      console.log(response);
    if (response == 'notData') {
    dataContact = "No hay registros para mostrar55";
    }else
    {
    var info = JSON.parse(response);
    dataContact = info;
    }
    $('#rowsUsuarios').html(dataContact);
    },
    error: function(error){
      console.log(response);
    }
    });
    });
        }
//fin busqueda de proveedor



// JS para cuando realizan un POS con el boton Guardar del formulario  
// puede GUardar -- Editar  Proveedores
$("#guardar_Proveedor2").submit(function( event ) { // cuando tiene un submit el formulario  con el id guardar_Proveedor2 por un post del un boton del formulario se incia este evento
  //$('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  idProv = idProveedor; //en caso de tener id la variable global la almacena en una local
  console.log(idProveedor); // imprime en consola para el desarrolador ver el valro que esta obteniendo 
  console.log(idProv); // imprime en consola para el desarrolador ver el valro que esta obteniendo 
  console.log(action); // imprime en consola para el desarrolador ver el valro que esta obteniendo 

  intencion = 'intencion'; //incializa la variable para que pueda encajar en el AJAX 
  nombreComercial = $.trim($("#nombreComercial").val()); // toma el valor que contenga los inputs del formulario con el idnombreComercial y lo ingresa a una variable 
  proveedorNIT = $.trim($("#proveedorNIT").val());// toma el valor que contenga los inputs del formulario con el id proveedorNIT y lo ingresa a una variable 
  proveedorDireccion = $.trim($("#proveedorDireccion").val());
  telefonoProveedor = $.trim($("#telefonoProveedor").val());
  descripcionProveedor = $.trim($("#descripcionProveedor").val());

    $.ajax({ //aqui se indica que vamos a hacer con los datos obtenidos del formulario
              type: "POST",
              url: "ajax/ajaxProveedores.php", //indica el Ajax donde se procesara los parametros enviados 
              //data: parametros,
              data: {action:action, intencion:intencion,nombreComercial:nombreComercial,proveedorNIT:proveedorNIT,proveedorDireccion:proveedorDireccion, telefonoProveedor:telefonoProveedor,descripcionProveedor:descripcionProveedor,idProv:idProv},
              dataType: 'json', //indica que el valor que devuelve el ajax es json para poder manipular en js
              beforeSend: function(objeto){},
              success: function(data2){
                console.log("imprimir DATA"); 
                console.log(data2);// imprime en consola para el desarrolador ver el valro que esta obteniendo 
                console.log(data2[0]);// imprime en consola para el desarrolador ver el valro que esta obteniendo 
                console.log(data2[1]);
                console.log(opcion);// imprime en consola para el desarrolador ver el valro que esta obteniendo 
                console.log(idProv);// imprime en consola para el desarrolador ver el valro que esta obteniendo 

              
                if(data2 == 'replica'){ // en caso de que el valor de data2 que viene del ajaxProveedore sea replica es porque la comparacion con BD ya existia el dato y no se pudo ejecutar la consulta 
                      Swal.fire({
                      title: "El usuario Ya existe", //titulo del modal
                      icon: 'error', //tipo de advertencia modal
                      });
                      $('#proveedorNIT').val(''); // vacia el input ProveedorNIT del modal 
                      console.log("rechazado");   // // imprime en consola para el desarrolador ver el valro que esta obteniendo 
                    }
             
               else if(data2 == 'actualizado') // en caso de ser actualizado la respuesta del ajaxProveedor entonces la opcion completada fue un UPDATE en la BD
               {
                Swal.fire({
                  title: "El usuario Fue Actualizado",
                  icon: 'success',
                  });
                  $('#proveedorNIT').val('');
                  console.log("ActaualizadoProveedor");   
               }
                else  { // de lo contrario el msj sera usuario guardado 
                  Swal.fire({
                          title: "Usuario Guardado",
                          icon: 'success',
                          });

                          console.log("ingresado"); 
               
                        /*  $('#nombreComercial').val('');
                          $('#proveedorNIT').val('');
                          $('#proveedorDireccion').val('');
                          $('#telefonoProveedor').val('');
                          $('#descripcionProveedor').val('');*/
                          //console.log(data2);
                        

                          id=data2[0];
                          nombreProveedor=data2[1];
                          telefonoProveedor=data2[2];
                          descripcionProveedor=data2[3];
                         /* id=data2[0].id;
                          console.log("imprimir Variable");  
                          console.log(id);

                          
                          nombreProveedor=data2.resultado.nombre;
                          telefonoProveedor=data2.resultado.telefono;
                          descripcionProveedor=data2.resultado.descripcion;*/
                          tablaProveedores.row.add([id,nombreProveedor,telefonoProveedor,descripcionProveedor]).draw();

                         }
          }
    });
  event.preventDefault();
}) 
//************************************* */
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  // Insertar Asesor Pro

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

////////////////////////////////////descripcionProveedor/////////////////////////////////////////////////////////////////////////////////////////////////////////

  // Actualizar Asesor Prov

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





  //============== acciones para  ASESOR]



  // accion al clickear boton editar el ASESORs
  $(document).on("click", ".btnEditarAsesor", function(){
    //habilita o deshabilita campos o botones
    $('#ProveedorAsesor').prop('disabled', true);
    $('#nombreAsesor').prop('disabled', false);
    $('#telefonoAsesor').prop('disabled', false);
    $('#correoAsesor').prop('disabled', false);
    $('#estadoAsesor').prop('disabled', false);
    $('#btnGuardarAsesor').prop('disabled', false);
    const $estadoBTNGuardar = document.querySelector("#btnGuardarAsesor"); //selecciona el elemento del modal y lo pasa a una variable local
    $estadoBTNGuardar.style.display = "block"; // muestra el boton guardar
    
    fila = $(this).closest("tr");
  
    id = parseInt(fila.find('td:eq(0)').text());
    asesor = fila.find('td:eq(1)').text();
    telefono = fila.find('td:eq(2)').text();
    estadi = fila.find('td:eq(3)').text();
  console.log(id);
    action = 'obtener_datos_asesor';// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
    //al presionar el boton nuevo la variable global action cambia a agregar producto 
    id_empleado = id;
    
  
            $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
              url: './ajax/ajaxAsesores.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
              type: "POST",
              async: true,
              data: {action:action, id_empleado:id_empleado }, //envia valores al ajax action y el id
              
              success: function(response){ //recibe una respuesta con una array json
                console.log("Imprimir Datos1");
                console.log(action);
               
                  if (response != 'error') {
  
                  
                      
                     console.log(response); // imprimimos en consola para saber el array que nos devuelve
                     var data2 = JSON.parse(response); //parsea a fotmato el array del ajax en json
                     
                     // data = JSON.parse(data);
                      $('#ProveedorAsesor').val(data2.nombreProveedor); // carga el valor de data2.nombre en un input del modal nuevo_proveedor el cual tenga el id nombreComercial y los de abajo tambien
                      $('#ProveedorAsesor').prop('disabled', true);
                      $('#nombreAsesor').val(data2.nombre);
                      $('#telefonoAsesor').val(data2.telefono);
                      $('#correoAsesor').val(data2.correo);
                      $('#estadoAsesor').val(data2.estado);
                      
    
                      $(".modal-header").css("background-color","#21c87a");//cambia de colo el header del modal
                      $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
                      $(".modal-title").text("Editar Proveedor");//titulo del header
                      $("#Modal_Ver_Asesor").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
                      opcion = 2; //editar/*where id ='<!--$d1-->
                      idAsesor= id;
                      action = 'editar_Asesor'; // la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
                      //al finalizar la carga de datos la variable global action cambia a editar  producto  para cuando le de en submit busque action= editar proveedor
                      console.log("Imprimir Datos2");
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
  
  //================ finalizada  Editar asesor

  // ---------------VER ASESORES-----------------

  $(document).on("click", ".btnVerAsesor", function(){
    // estado de inputs o botons habilita o deshabilita
    $('#ProveedorAsesor').prop('disabled', true);
    $('#nombreAsesor').prop('disabled', true);
    $('#telefonoAsesor').prop('disabled', true);
    //$('#correoAsesor').prop('readonly', true);
    $('#correoAsesor').prop('disabled', true);
    //$('#estadoAsesor').attr('readonly', false);
    //$('#estadoAsesor').prop('disabled', true);
    

    const $estadoBTNGuardar = document.querySelector("#btnGuardarAsesor");//selecciona el elemento del modal y lo pasa a una variable local
    $estadoBTNGuardar.style.display = "none"; // oculta el boton guardar

    fila = $(this).closest("tr");
  
    id = parseInt(fila.find('td:eq(0)').text());
    asesor = fila.find('td:eq(1)').text();
    telefono = fila.find('td:eq(2)').text();
    estadi = fila.find('td:eq(3)').text();
  console.log(id);
    action = 'obtener_datos_asesor';// la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
    //al presionar el boton nuevo la variable global action cambia a agregar producto 
    id_empleado = id;
    
  
            $.ajax({ //ajax que va obtener valores de tabla de proveedor con id
              url: './ajax/ajaxAsesores.php', //al documento php ajax al cual iran los datos y de donde retornara valores de la consulta
              type: "POST",
              async: true,
              data: {action:action, id_empleado:id_empleado }, //envia valores al ajax action y el id
              
              success: function(response){ //recibe una respuesta con una array json
                console.log("Imprimir Datos1");
                console.log(action);
               
                  if (response != 'error') {
  
                  
                      
                     console.log(response); // imprimimos en consola para saber el array que nos devuelve
                     var data2 = JSON.parse(response); //parsea a fotmato el array del ajax en json
                     
                     // data = JSON.parse(data);
                      $('#ProveedorAsesor').val(data2.nombreProveedor); // carga el valor de data2.nombre en un input del modal nuevo_proveedor el cual tenga el id nombreComercial y los de abajo tambien
                      $('#nombreAsesor').val(data2.nombre);
                      $('#telefonoAsesor').val(data2.telefono);
                      $('#correoAsesor').val(data2.correo);
                      $('#estadoAsesor').val(data2.estado);
                      
    
                      $(".modal-header").css("background-color","#00dffc");//cambia de colo el header del modal
                      $(".modal-header").css("color","white"); //cambia el color de texto del header a blanco 
                      $(".modal-title").text("detalle Asesor");//titulo del header
                      $("#Modal_Ver_Asesor").modal("show"); //al clickear el boton nuevo proveedor lanza el modal que tiene el id Modal_Nuevo_Proveedor el cual es una clase alojada en /modal/editarProveedor llamada desde el archivo verProveedor
                      opcion = 2; //editar/*where id ='<!--$d1-->
                      idProveedor= id;
                      action = 'editar_Proveedor'; // la accion que va a buscar  en el ajaxProveedores.php en el cual va acompara la funcion para inciar al presionar el boton
                      //al finalizar la carga de datos la variable global action cambia a editar  producto  para cuando le de en submit busque action= editar proveedor
                      console.log("Imprimir Datos2");
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


// Funciones al realizar POST en el Formulario ListarAsesro
// Guardar - Editar -Eliminar ---- ASESOR
$("#ListarAsesor").submit(function( event ) {
  //$('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  idAse = idAsesor;// captura el idAsesor en una variable local
  console.log(idAse); // imprime el valor en consolar para desarrollador
  console.log(idAse);
  console.log(idAse);
  console.log(action);

  intencion = 'intencion';
  ProveedorAsesor = $.trim($("#ProveedorAsesor").val());
  nombreAsesor = $.trim($("#nombreAsesor").val());
  telefonoAsesor = $.trim($("#telefonoAsesor").val());
  correoAsesor =   $.trim($("#correoAsesor").val());
  estadoAsesor = $.trim($("#estadoAsesor").val());
  
    $.ajax({ //aquei se indica que vamos a hacer con los datos obtenidos del formulario
              type: "POST",
              url: "ajax/ajaxAsesores.php",
              //data: parametros,
              data: {action:action,intencion:intencion,ProveedorAsesor:ProveedorAsesor,nombreAsesor:nombreAsesor,telefonoAsesor:telefonoAsesor,correoAsesor:correoAsesor,estadoAsesor:estadoAsesor,idAse:idAse},
              dataType: 'json', //indica que el valor que devuelve el ajax es json para poder manipular en js
              beforeSend: function(objeto){},
              success: function(data2){
                console.log("imprimir DATA"); 
                console.log(data2);
                console.log(data2[0]);
                console.log(data2[1]);
                console.log(data2[2]);
                console.log(data2[3]);
                console.log(opcion);
                console.log(idAse);
                
               
               // condicionales dependiendo de la respuesta de DATA2 que provenga de AJAXAsesores.php 
              //if(data2.estado == 'replica'){
                if(data2 == 'replica'){
                      Swal.fire({
                      title: "El usuario Ya existe",
                      icon: 'error',
                      });
                      $('#proveedorNIT').val('');
                      console.log("rechazado");   
                    }
             // if (data2['estado'] == 'successful' ) {
               else if(data2 == 'actualizado')
               {
                Swal.fire({
                  title: "El Asesor Fue Actualizado",
                  icon: 'success',
                  });
                  $('#proveedorNIT').val('');
                  console.log("Actaualizado2020");  
                  // Recargo la página
                  location.reload(); 
               }
                else  {
                  Swal.fire({
                          title: "Usuario Guardado",
                          icon: 'success',
                          });

                          console.log("ingresado"); 
               
                      
                          id=data2[0];
                          nombreProveedor=data2[1];
                          telefonoProveedor=data2[2];
                          descripcionProveedor=data2[3];
                         /* id=data2[0].id;
                          console.log("imprimir Variable");  
                          console.log(id);

                          
                          nombreProveedor=data2.resultado.nombre;
                          telefonoProveedor=data2.resultado.telefono;
                          descripcionProveedor=data2.resultado.descripcion;*/
                          tablaProveedores.row.add([id,nombreProveedor,telefonoProveedor,descripcionProveedor]).draw();

                         }
          }
    });
  event.preventDefault();
}) 
//************************************* */

//-------------FUNCION SELECTED DE PROEVEDORE PARA ASESOR--------------

$("#seleccionaProveedor").change(function(){
  var parametros = $(this).serialize();
  idProveedoAsesor= $(this).val(); //obitne el value del option select que estamos seleccionamos
  //alert(idProveedoAsesor);
  action = 'cargar_Asesores';
  console.log(idProveedor); // imprime en consola para el desarrolador ver el valro que esta obteniendo 
  console.log(idProveedoAsesor); // imprime en consola para el desarrolador ver el valro que esta obteniendo 
  console.log(action); // imprime en consola para el desarrolador ver el valro que esta obteniendo 

  intencion = 'intencion'; //incializa la variable para que pueda encajar en el AJAX 
  
  $.ajax({ //aqui se indica que vamos a hacer con los datos obtenidos del formulario
    type: "POST",
    url: "ajax/ajaxAsesores.php", //indica el Ajax donde se procesara los parametros enviados 
    //data: parametros,
    data: {action:action,intencion:intencion,idProveedoAsesor:idProveedoAsesor},
    dataType: 'json', //indica que el valor que devuelve el ajax es json para poder manipular en js
    beforeSend: function(objeto){},
    success: function(data2){
      console.log("imprimir DATA"); 
      console.log(data2);// imprime en consola para el desarrolador ver el valro que esta obteniendo 
      console.log(data2[0]);// imprime en consola para el desarrolador ver el valro que esta obteniendo 
      console.log(data2[1]);
     
      console.log(idProveedoAsesor);// imprime en consola para el desarrolador ver el valro que esta obteniendo 

    
      if(data2 == 'replica'){ // en caso de que el valor de data2 que viene del ajaxProveedore sea replica es porque la comparacion con BD ya existia el dato y no se pudo ejecutar la consulta 
        tablaverAsesores.clear(); 
          Swal.fire({
            title: "Proveedor sin Asesores", //titulo del modal
            icon: 'error', //tipo de advertencia modal
            });
            tablaverAsesores.clear();
            console.log("rechazado la consulta de asesores de un proveedor");   // // imprime en consola para el desarrolador ver el valro que esta obteniendo 
          }
      else  { // de lo contrario el msj sera usuario guardado 
        /*Swal.fire({
                title: "Usuario Guardado",
                icon: 'success',
                });*/

                console.log("tablaAsesoresP"); 
                id=data2[0];
                nombreAsesor=data2[1];
                telefonoAsesor=data2[2];
                console.log("etrando a condicional de activo");
                  if(data2[3]=='1') //condicional que pasa el estado de 1/0 del asesor a un ACTIVO/INACTIVO
                      {
                        estadoAsesor="ACTIVO";
                      }
                  else
                      {
                        estadoAsesor="INACTIVO";
                    
                      } //fin de condicional
                     
                tablaverAsesores.clear();
                tablaverAsesores.row.add([id,nombreAsesor,telefonoAsesor,estadoAsesor]).draw();

               }
}
});
//event.preventDefault();

  
  //alert('Selected value: ' + $(this).val());

});


///------------FIN SELECTED






}); // End Ready  //FIN DEL READY de la carga de la pagina 


//==================AREA DE FUNCIONES=======================

 //Listar usuarios
 
//====================FIN de FUNCIONES=======================


// Insertar Proveedor Nuevo
/*
$("#guardar_Proveedor").submit(function( event ) {
    //$('#guardar_datos').attr("disabled", true);
    var parametros = $(this).serialize();
    action = 'agregar_Proveedor';
    intencion = 'intencion';
      $.ajax({ //aquei se indica que vamos a hacer con los datos obtenidos del formulario
                type: "POST",
                url: "ajax/ajaxProveedores.php",
                data: parametros,
                //data: {action:action, intencion:intencion },
                dataType: 'json', //indica que el valor que devuelve el ajax es json para poder manipular en js
                beforeSend: function(objeto){},
                success: function(data2){
                  console.log("imprimir DATA"); 
                  console.log(data2);
                  console.log(data2[0]);
                  console.log(data2[1]);
                  console.log(data2[2]);
                  console.log(data2[3]);
                 
                  
                 

                //if(data2.estado == 'replica'){
                  if(data2 == 'replica'){
                        Swal.fire({
                        title: "El usuario Ya existe",
                        icon: 'error',
                        });
                        $('#proveedorNIT').val('');
                        console.log("rechazado");   
                      }
               // if (data2['estado'] == 'successful' ) {
                  else  {
                    Swal.fire({
                            title: "Usuario Guardado",
                            icon: 'success',
                            });

                            console.log("ingresado"); 
                 
                          // $('#nombreComercial').val('');
                         //   $('#proveedorNIT').val('');
                           // $('#proveedorDireccion').val('');
                            //$('#telefonoProveedor').val('');
                            //$('#descripcionProveedor').val('');
                            
                            //console.log(data2);
                          

                            id=data2[0];
                            nombreProveedor=data2[1];
                            telefonoProveedor=data2[2];
                            descripcionProveedor=data2[3];
                         
                            tablaProveedores.row.add([id,nombreProveedor,telefonoProveedor,descripcionProveedor]).draw();

                           }
            }
      });
    event.preventDefault();
  }) //fin de la funcion de instertar Proveedor*/
  