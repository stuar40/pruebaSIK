$(document).ready(function(){


    $('#monto').keyup(function(e){
        e.preventDefault();
        var monto = $(this).val();
var  saldod =  $('#saldod').val();

var montoa = parseInt(monto);
var saldob = parseInt(saldod);

if (montoa < saldob) {
    
$('#procesar').show();
    
}

else{

    $('#procesar').hide();

}




    });






    creditos =  $('#tablaVentasr').DataTable({

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



$("#empresa").on("change",function(e){
    e.preventDefault();

    var idempresa =$("#empresa").val(); 

action = 'consulta';

$.ajax({
    url: './ajax/ajaxVentasr.php',
    type: "POST",
    async: true,
    data: {idempresa:idempresa,action:action },

    success: function(response) {

        if (response != 'error') {

          
            
            $("#saldod").val(response);
     

        } else {
         
            $('#procesar').hide();
        }
    },
    error: function(error) {

    }

});









});







    $("#form_comprar").submit(function(event){




        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "./ajax/ajaxVentasr.php",
            data: parametros,
            beforeSend: function(objeto) {

            },
            success: function(response) {


                if (response == 'successful') {
                    Swal.fire({
                        title: "Recarga realizada Satisfactoriamente",
                        icon: 'success',

                    });

                    $("#cerrar").click();
                    refrescar(1000);


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



  function Validacion(){
    if($('#monto') < $('#saldod')){


$('#procesar').show();


    }else{

        $('#procesar').hide();

    }
}

