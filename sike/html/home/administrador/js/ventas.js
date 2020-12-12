$(document).ready(function() {

  
    $('#add_product_venta').slideUp();
    $("#precios").on("change",function(e){
        e.preventDefault();
        var otro=$("#precios").val();   
          
$("#idPrecio").val(otro);

var precio_total = $('#txt_cantidad').val()* $('#idPrecio').val();
$('#txt_precio_total').html(precio_total.toFixed(2));
var existencia = parseInt($('#txt_existencia').val());

// Ocultar el boton agregar si a cantidad es menor que 1

if ( $('#txt_cantidad').val() < 1 || isNaN( $('#txt_cantidad').val()) || ( $('#txt_cantidad').val() > existencia)) {

    $('#add_product_venta').slideUp();
} else {
    $('#add_product_venta').slideDown();

}



          });

    
    $("#nombre_cliente").autocomplete({
        source: "./ajax/ajaxClientesp.php",
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $('#id_cliente').val(ui.item.id);
            $('#nombre_cliente').val(ui.item.nombre);
            $('#direccion').val(ui.item.direccion);
            $('#nit').val(ui.item.nit);
    
    
         }
    });
    
    
    $("#nombre_cliente" ).on( "keydown", function( event ) {
        if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
        {
            $("#id_cliente" ).val("");
            $("#direccion" ).val("");
            $("#nit" ).val("");
    
        }
        if (event.keyCode==$.ui.keyCode.DELETE){
            $("#nombre_cliente" ).val("");
            $("#id_cliente" ).val("");
            $("#direccion" ).val("");
            $("#nit" ).val("");
        }
    });




    // BUSCAR PRODUCTO
    $('#txt_insumo').keyup(function(e) {

        e.preventDefault();
        var producto = $('#txt_insumo').val();
        const idempl = $('#idven').val();
        var action = 'infoProducto';
        if (producto != '') {

            $.ajax({
                url: 'ajax/ajaxVentas.php',
                type: "POST",
                async: true,
                data: { action: action, producto: producto, idempl: idempl },

                success: function(response) {

                    if (response != 'error') {

                        var info = JSON.parse(response);
                        
                        var producto = info.nombre + ' ' + info.descripcion + ' ' + info.presentacion + ' ' +info.marca;
                        $('#txt_descripcion').val(producto);
                        $('#txt_idproducto').val(info.idproducto);
                        $('#txt_existencia').val(info.existencia);
                     $('#txt_cantidad').val('');
                       $('#p_venta').val(info.precio_venta);
                       $('#p_promocion').val(info.precio_promocion);
                       $('#p_minimo').val(info.precio_minimo);
                       $('#idPrecio').val(info.precio_venta);
                        $('#txt_cantidad').removeAttr('disabled');
                        $('#precios').removeAttr('disabled');
                        // Mostrar Boton Agregar

                        $('#add_product_venta').slideDown();
                 

                    } else {
                        $('#txt_existencia').val('--');
                        $('#txt_descripcion').val('--');
                        $('#txt_cantidad').val('0');
                        $('#precios').attr('disabled', 'disabled');
                        $('#txt_precio_total').html('0.00');

                        //Bloquear cantidad

                        $('#txt_cantidad').attr('disabled', 'disabled');
                        $('#txt_precio').attr('disabled', 'disabled');
                        // Ocultar boton agregar
                        $('#add_product_venta').slideUp();

                    }
                },
                error: function(error) {

                }

            });

        }

    });

    //Validar la cantidad del producto antes de agregar

    $('#txt_cantidad').keyup(function(e) {
        e.preventDefault();
        var precio_total = $(this).val() * $('#idPrecio').val();
        $('#txt_precio_total').html(precio_total.toFixed(2));
        var existencia = parseInt($('#txt_existencia').val());

        // Ocultar el boton agregar si a cantidad es menor que 1

        if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia)) {

            $('#add_product_venta').slideUp();
        } else {
            $('#add_product_venta').slideDown();

        }

    });
    // Validar precio
    $('#txt_precio').keyup(function(e) {
        e.preventDefault();
        var precio_total = $(this).val() * $('#txt_cantidad').val();
        $('#txt_precio_total').html(precio_total.toFixed(2));

        // Ocultar el boton agregar si a cantidad es menor que 1

        if ($(this).val() < 1 || isNaN($(this).val())) {

            $('#add_product_venta').slideUp();
        } else {
            $('#add_product_venta').slideDown();

        }

    });


    //Agregar producto detalle

    $('#add_product_venta').click(function(e) {

       

        e.preventDefault();


        if ($('#txt_precio_total').html() > 0) {

            var codinsumo = $('#txt_insumo').val();
            var idproducto = $('#txt_idproducto').val();
            var cantidad = $('#txt_cantidad').val();
            var precio = $('#idPrecio').val();
            var token = $('#idven').val();
            var action = 'addVentaDetalle';

            $.ajax({
                url: 'ajax/ajaxVentas.php',
                type: "POST",
                async: true,
                data: { action: action, insumo: codinsumo, cantidad: cantidad, precio: precio, idproducto: idproducto, token: token },
                success: function(response) {

                    if (response != 'error') {
                        var info = JSON.parse(response);

                        $('#detalle_compra').html(info.detalle);

                        $('#detalle_totales').html(info.totales);
                        $('#txt_existencia').val('--');
                        $('#txt_descripcion').val('--');
                        $('#txt_cantidad').val('0');
                        $('#txt_precio').val('0');
                        $('#txt_precio_total').html('0.00');

                        $('#txt_cantidad').attr('disabled', 'disabled');
                        $('#precios').attr('disabled', 'disabled');
                        $('#add_product_venta').slideUp();
                        $('#txt_insumo').val(' '); 

                    } else {

                        console.log('No existen datos')
                    }

                    viewProcesar();
                },
                error: function(error) {

                }

            });

        }


    });

    // Anular Compra


    $('#btn_anular_venta').click(function(e) {
        e.preventDefault();

        var rows = $('#detalle_compra tr').length;

        if (rows > 0) {
            var action = 'anularVenta';
            var token = $('#idven').val();
            $.ajax({
                url: 'ajax/ajaxVentas.php',
                type: "POST",
                async: true,
                data: { action: action, token: token },

                success: function(response) {
                    console.log(response);
                    if (response != 'error') {
                        location.reload();
                    }


                },
                error: function(error) {

                }

            });
        }


    });


    // Facturar Venta

    $('#btn_procesar_venta').click(function(e) {
        e.preventDefault();

        var rows = $('#detalle_compra tr').length;

        if (rows > 0) {
            var action = 'procesarVenta';
            var codcliente = $('#id_cliente').val();
           var sucursal = $('#sucursal_id').val(); 

            var codvendedor = $('#idven').val();
            $.ajax({
                url: 'ajax/ajaxVentas.php',
                type: "POST",
                async: true,
                data: { action: action, codcliente: codcliente,  codvendedor: codvendedor,sucursal:sucursal },

                success: function(response) {

                    if (response != 'error') {
                        var info = JSON.parse(response);
                        //console.log(info);
                        generarPDF(info.usuarios_idusuarios, info.id)
                        location.reload();

                    } else {
                        console.log('no data');

                    }


                },
                error: function(error) {

                }

            });
        }


    });





}); //End Ready


// Funcion para generar PDF

function generarPDF(empleado, encabezado) {
    var ancho = 1000;
    var alto = 800;
    // calcular posicion x,y para centrar la venta

    var x = parseInt((window.screen.width / 2) - (ancho / 2));
    var y = parseInt((window.screen.width / 2) - (alto / 2));

    $url = '../facturas/factura_Venta.php?empleado=' + empleado + '&ef=' + encabezado;
    window.open($url, "Factura", "left" + x + ",top=" + y + ",height" + alto + ",width" + ancho + ",scrollbar=si,location=no,resizable=si,menubar=no")
}






// Borrar producto Temporal

function del_product_detalle(iddetalle_venta) {
    var action = 'del_product_detalle';
    var id_detalle = iddetalle_venta;
    var token = $('#idven').val();


    //funcion

    $.ajax({
        url: 'ajax/ajaxVentas.php',
        type: "POST",
        async: true,
        data: { action: action, id_detalle: id_detalle, token: token },
        success: function(response) {

            if (response != 'error') {
                var info = JSON.parse(response);

                $('#detalle_compra').html(info.detalle);

                $('#detalle_totales').html(info.totales);

                $('#txt_descripcion').val('--');
                $('#txt_cantidad').val('0');
                $('#txt_precio').val('0');
                $('#txt_precio_total').html('0.00');

                $('#txt_cantidad').attr('disabled', 'disabled');
                $('#txt_precio').attr('disabled', 'disabled');
                $('#add_product_venta').slideUp();


            } else {

                $('#detalle_compra').html('');

                $('#detalle_totales').html('');
            }
            viewProcesar();

        },
        error: function(error) {

        }

    });


}




// Mostrar / Ocultar boton procesar compra
function viewProcesar() {
    if ($('#detalle_compra tr').length > 0) {
        $('#btn_procesar_venta').show();


    } else {

        $('#btn_procesar_venta').hide();

    }
}




// Biscar detalle de producto
function serchForDetalle(id) {
    var action = 'serchForDetalle';
    var user = id;

    //funcion

    $.ajax({
        url: 'ajax/ajaxVentas.php',
        type: "POST",
        async: true,
        data: { action: action, user: user },
        success: function(response) {

            if (response != 'error') {
                var info = JSON.parse(response);

                $('#detalle_compra').html(info.detalle);

                $('#detalle_totales').html(info.totales);



            } else {

                console.log('No existen datos')
            }
            viewProcesar();

        },
        error: function(error) {

        }

    });

}

