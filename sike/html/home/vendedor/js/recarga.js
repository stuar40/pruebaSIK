$(document).ready(function() {



    creditos = $('#tablaRecargas').DataTable({

        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }


    });






    $("#guardar_saldo").submit(function(event) {
        $('#guardar_datos').attr("disabled", true);
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "ajax/ajaxRecarga.php",
            data: parametros,
            beforeSend: function(objeto) {

            },
            success: function(response) {

                if (response == 'replica') {
                    Swal.fire({
                        title: "El saldo de esta empresa ya ha sido agregado a esta sucursal", //titulo del modal
                        icon: 'error', //tipo de advertencia modal
                    });

                    $('#dinero').val('');
                    $('#sucursal').val('');
                    $('#idProveedor').val('');




                }

                if (response == 'successful') {
                    Swal.fire({
                        title: "Producto Guardado",
                        icon: 'success',
                    });
                    $('#dinero').val('');
                    $('#sucursal').val('');
                    $('#idProveedor').val('');


                }



            }




        });
        event.preventDefault();
    })



    //Editar Saldo de recargas

    $("#actualizar_producto").submit(function(event) {
        $('#guardar_datos').attr("disabled", true);
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "./ajax/ajaxRecarga.php",
            data: parametros,
            beforeSend: function(objeto) {

            },
            success: function(response) {


                if (response == 'successful') {
                    Swal.fire({
                        title: "Saldo Actualizado Correctamente",
                        icon: 'success',

                    });

                    $("#cerrar").click();
                    refrescar(1000);


                }



            }


        });

        event.preventDefault();
    });




}); // End Ready