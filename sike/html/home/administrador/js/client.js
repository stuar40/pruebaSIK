//Código para Datables

//$('#example').DataTable(); //Para inicializar datatables de la manera más simple

$(document).ready(function() {    

  tablaClientes =  $('#tablaClientes').DataTable({

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




//Insertar Productos

  $("#guardar_producto").submit(function(event) {
    $("#guardar_datos").attr("disabled", true);
    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "ajax/ajaxClient.php",
      data: parametros,
      beforeSend: function (objeto) {},
      success: function (response) {
        if (response == 'replica') {
          Swal.fire({
            title: "El usuario Ya existe",
            icon: "error",
          });
          $("#nitCliente").val("");
        } 
        if (response == 'successful' ) {
               
          Swal.fire({
              title: "Cliente Guardado",
              icon: 'success',
              });
          window.location = "../administrador/verCliente.php";
        }
      },
    });
    event.preventDefault();
});






//Editar Productos

$("#actualizar_cliente").submit(function(event) {
  $('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
      type: "POST",
      url: "ajax/ajaxClient.php",
      data: parametros,
      beforeSend: function(objeto) {

      },
      success: function(response) {

   
          if (response == 'successful') {
            Swal.fire({
              title: "Cliente Actualizado Correctamente",
              icon: 'success',
              
              });

              $("#cerrar").click();
              refrescar(1000);
            
            
          }
         


      }
      

  });

  event.preventDefault();
});

  









});











//Datos de los select

function recargarLista(){
    $.ajax({
        type:"POST",
        url:"./ajax/datos.php",
        data:"continente=" + $('#categoria').val(),
        success:function(r){
            $('#subcat').html(r);
        }
    });
}



// Obtener Datos

function obtener_datos(idproducto) {
  var action = 'obtener_datos';
  var id_producto = idproducto;


  $.ajax({
      url: './ajax/ajaxClient.php',
      type: "POST",
      async: true,
      data: { action: action, id_producto: id_producto },
      success: function(response) {
          if (response != 'error') {

              var info = JSON.parse(response);
              $('#eid').val(info.id);
             
              $('#nombresCliente2').val(info.nombre);
              $('#apellidosCliente2').val(info.apellido);
              $('#nitCliente2').val(info.nit);
              $('#telefonoCliente2').val(info.telefono);
              $('#direccionCliente2').val(info.direccion);
              $('#emailCliente2').val(info.correo);
          } else {

              console.log("No existen datos")

          }


      },
      error: function(error) {
          console.log(error);
      }

  });


}

function refrescar(tiempo){
  //Cuando pase el tiempo elegido la página se refrescará 
  setTimeout("location.reload(true);", tiempo);
}