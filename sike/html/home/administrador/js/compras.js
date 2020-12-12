
$(document).ready(function(){


// BUSCAR PRODUCTO
$('#txt_insumo').keyup(function(e){

e.preventDefault();
var producto = $(this).val();
var action = 'infoProducto';
var sucursal = $('#idsucursal').val();
if (producto != '') {
   
    $.ajax({
        url: 'ajax/ajaxCompras.php',
        type: "POST",
        async: true,
        data: {action:action, producto:producto,sucursal:sucursal },
        
        success: function(response){

            console.log(response)
        
if (response != 'noencontrado') {

    
    var info = JSON.parse(response);
    var descripcion = info.nombre + ' ' + info.descripcion + ' ' +info.presentacion;
    $('#txt_descripcion').val(descripcion) ;
    $('#txt_cantidad').val(1);
    $('#txt_idproducto').val(info.id);
    //Activar cantidad y precio
    $('#txt_cantidad').removeAttr('disabled');
    $('#txt_precio').removeAttr('disabled');
    // Mostrar Boton Agregar

    $('#add_product_compra').slideDown();



}else{


    $('#txt_descripcion').val('');
    $('#txt_cantidad').val('');
    $('#txt_cantidad').attr('disabled', 'disabled');
    $('#txt_precio').attr('disabled', 'disabled');
    $('#add_product_compra').slideUp();

}



        },
        error: function(error){
        
        }
        
        });
    
}

});

//Validar la cantidad del producto antes de agregar

$('#txt_cantidad').keyup(function(e){
e.preventDefault();
var precio_total = $(this).val() * $('#txt_precio').val();
$('#txt_precio_total').html(precio_total.toFixed(2));

// Ocultar el boton agregar si a cantidad es menor que 1

if ($(this).val() < 1 || isNaN($(this).val() )) {
    
    $('#add_product_compra').slideUp();
}else{
$('#add_product_compra').slideDown();

}

});
// Validar precio
$('#txt_precio').keyup(function(e){
    e.preventDefault();
    var precio_total = $(this).val() * $('#txt_cantidad').val();
    $('#txt_precio_total').html(precio_total.toFixed(2));
    
    // Ocultar el boton agregar si a cantidad es menor que 1
    
    if ($(this).val() < 1 || isNaN($(this).val() )) {
        
        $('#add_product_compra').slideUp();
    }else{
    $('#add_product_compra').slideDown();
    
    }
    
    });


//Agregar producto detalle

$('#add_product_compra').click(function(e){

e.preventDefault();


if ($('#txt_precio').val() > 0) {
    var idproducto = $('#txt_idproducto').val();
    var codinsumo = $('#txt_insumo').val();
    var cantidad = $('#txt_cantidad').val();
    var precio = $('#txt_precio').val();
    var action = 'addCompraDetalle';

    $.ajax({
url: 'ajax/ajaxCompras.php',
type: "POST",
async: true,
data: { action:action, idproducto:idproducto,cantidad:cantidad,precio:precio},
success: function(response){

if (response != 'error') {
    var info = JSON.parse(response);

    $('#detalle_compra').html(info.detalle);

    $('#detalle_totales').html(info.totales);

    $('#txt_existencia').val('--');
    $('#txt_insumo').val('');
    $('#txt_descripcion').val('--');
    $('#txt_cantidad').val('0');
    $('#txt_precio').val('0');
    $('#txt_precio_total').html('0.00');

    $('#txt_cantidad').attr('disabled', 'disabled');
    $('#txt_precio').attr('disabled', 'disabled');
    $('#add_product_compra').slideUp();

}else{

    console.log('No existen datos')
}

viewProcesar();
},
error: function(error){

}

    });
    
}


});

// Anular Compra


$('#btn_anular_compra').click(function(e){
e.preventDefault();

var rows = $('#detalle_compra tr').length;

if (rows > 0) {
    var action = 'anularCompra';
    $.ajax({
url: 'ajax/ajaxCompras.php',
type: "POST",
async : true,
data: {action:action},

success: function(response){
console.log(response);
if (response != 'error') {
    location.reload();
}


},
error:function(error){
    
}

    });
}


});


// Facturar compra

$('#btn_procesar_compra').click(function(e){
    e.preventDefault();
    
    var rows = $('#detalle_compra tr').length;
    
    if (rows > 0) {
    var action = 'procesarCompra';
    var codproveedor = $('#proveedor').val();
    var nfactura = $('#nfactura').val();
    var sucursal = $('#sucursal').val();
        $.ajax({
    url: 'ajax/ajaxCompras.php',
    type: "POST",
    async : true,
    data: {action:action, proveedor:codproveedor, nfactura:nfactura, sucursal:sucursal},
    
    success: function(response){

if (response != 'error') {
var info = JSON.parse(response);
//console.log(info);
generarPDF(info.proveedor_idproveedor,info.id)
  location.reload();

}else{
console.log('no data');

}

    
    },
    error:function(error){
        
    }
    
        });
    }
    
    
    });
    



 
 }); //End Ready
 
 
// Funcion para generar PDF

function generarPDF(proveedor,factura){
var ancho = 1000;
var alto = 800;
// calcular posicion x,y para centrar la venta

var x= parseInt((window.screen.width/2) - (ancho/2));
var y= parseInt((window.screen.width/2) - (alto/2));

$url = '../facturas/factura_Compra.php?prov='+proveedor+'&f='+ factura;
window.open($url,"Factura","left"+x+",top="+y+",height"+alto+",width"+ancho+",scrollbar=si,location=no,resizable=si,menubar=no")
}






// Borrar producto Temporal

function del_product_detalle(iddetalle_compra){
    var action = 'del_product_detalle';
    var id_detalle = iddetalle_compra;
    
    //funcion
    
    $.ajax({
        url: 'ajax/ajaxCompras.php',
        type: "POST",
        async: true,
        data: {action:action, id_detalle:id_detalle },
        success: function(response){
        
            if (response != 'error') {
                var info = JSON.parse(response);
            
                $('#detalle_compra').html(info.detalle);

                $('#detalle_totales').html(info.totales);
                
                 $('#txt_descripcion').val('--');
                $('#txt_cantidad').val('0');
                $('#txt_precio').val('0');
                $('#txt_precio_total').html('0.00');
               
               $('#txt_cantidad').attr('disabled','disabled');
               $('#txt_precio').attr('disabled','disabled');
               $('#add_product_compra').slideUp();
        
            
            }else{
            
                $('#detalle_compra').html('');
        
                $('#detalle_totales').html('');
            }
     viewProcesar();

        },
        error: function(error){
        
        }
        
            });


}




// Mostrar / Ocultar boton procesar compra
function viewProcesar(){
    if($('#detalle_compra tr').length > 0){
$('#btn_procesar_compra').show();


    }else{

        $('#btn_procesar_compra').hide();

    }
}









// Biscar detalle de producto
function serchForDetalle(id){
var action = 'serchForDetalle';
var user = id;

//funcion

$.ajax({
    url: 'ajax/ajaxCompras.php',
    type: "POST",
    async: true,
    data: {action:action, user:user },
    success: function(response){
    
        if (response != 'error') {
            var info = JSON.parse(response);
        
         $('#detalle_compra').html(info.detalle);
        
         $('#detalle_totales').html(info.totales);
         
    
        
        }else{
        
            console.log('No existen datos')
        }
 viewProcesar();
    
    },
    error: function(error){
    
    }
    
        });

 }


 function sucursal() {
        
 
    var idsucursal = document.getElementById("sucursal").value;
    $('#idsucursal').val(idsucursal);

}