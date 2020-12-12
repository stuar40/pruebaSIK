//Código para Datables

//$('#example').DataTable(); //Para inicializar datatables de la manera más simple

$(document).ready(function() {    

  creditos =  $('#tablaProductos').DataTable({

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
    $('#guardar_datos').attr("disabled", true);
    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "./ajax/ajaxProductos.php",
        data: parametros,
        beforeSend: function(objeto) {

        },
        success: function(response) {

            if (response == 'replica') {
              Swal.fire({
                title: "El producto ya Existe", //titulo del modal
                icon: 'error', //tipo de advertencia modal
                });

              
                $('#producto').val('');
                $('#descripcion').val('');
                $('#presentacion').val('');
                $('#marca').val('');
                $('#sku').val('');
                $('#categoria').val('Seleccionar');
                $('#subcategoria').val('Seleccionar');
                 

            }
            if (response == 'successful') {
              Swal.fire({
                title: "Producto Guardado",
                icon: 'success',
                }).then(function () {
                
                  location.reload();
                                  
                }) ;
                
                
                ;
              

            }



        }


    });
    event.preventDefault();
});






//Editar Productos

$("#actualizar_producto").submit(function(event) {
  $('#guardar_datos').attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
      type: "POST",
      url: "./ajax/ajaxProductos.php",
      data: parametros,
      beforeSend: function(objeto) {

      },
      success: function(response) {

   
          if (response == 'successful') {
            Swal.fire({
              title: "Producto Actualizado Correctamente",
              icon: 'success',
              
              });

              $("#cerrar").click();
              refrescar(1000);
            
            
          }
         


      }
      

  });

  event.preventDefault();
});

  



$("#nuevoProducto").click(function(event){
  
  event.preventDefault();

  window.location = "nuevoProducto.php";


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
      url: './ajax/ajaxProductos.php',
      type: "POST",
      async: true,
      data: { action: action, id_producto: id_producto },
      success: function(response) {
          if (response != 'error') {

              var info = JSON.parse(response);
              $('#eid').val(info.id);
              $('#eproducto').val(info.nombre);
              $('#edescripcion').val(info.descripcion);
              $('#epresentacion').val(info.presentacion);
              $('#emarca').val(info.marca);
              $('#eestado').val(info.idestado);
              $('#ecategoria').val(info.idcategoria);
              $('#esubcategoria').val(info.idsubcategoria);
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