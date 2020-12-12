$(document).ready(function(){



    creditos =  $('#tablaComprasr').DataTable({

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


    $("#form_comprar").submit(function(event){


   


        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "./ajax/ajaxComprasr.php",
            data: parametros,
            beforeSend: function(objeto) {

            },
            success: function(response) {


                if (response == 'Success') {
                    Swal.fire({
                        title: "Compra realizada Satisfactoriamente",
                        icon: 'success',

                    }).then(function () {
              
                        location.reload();
                                         
                       })  ;

             


                }
                else{


                   
                }



            }


        });

        event.preventDefault();


    });


});

function refrescar(tiempo){
    //Cuando pase el tiempo elegido la página se refrescará 
    setTimeout("location.reload(true);", tiempo);
  }