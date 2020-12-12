$(document).ready(function(){




    $("#txt_insumo").autocomplete({
        source: "./ajax/ajaxSInsumo.php",
        minLength: 2,
      
        select: function(event, ui) {
            event.preventDefault();
    
            $('#txt_insumo').val(ui.item.nombre);
            $('#txt_descripcion').val(ui.item.nombre);
            $('#txt_existencia').val(ui.item.existencia);
            $('#txt_idproducto').val(ui.item.idproducto);
            $('#txt_cantidad').val('');
            $('#p_venta').val(ui.item.precio_venta);
            $('#p_promocion').val(ui.item.precio_promocion);
            $('#p_minimo').val(ui.item.precio_minimo);
            $('#idPrecio').val(ui.item.precio_venta);
         
            $('#txt_precio').removeAttr('disabled');
            $('#txt_cantidad').removeAttr('disabled');
            $('#precios').removeAttr('disabled');
            // Mostrar Boton Agregar

            $('#add_product_venta').slideDown();
    
    
         }
    });
    
    
    $("#txt_descripcion" ).on( "keydown", function( event ) {
        if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
        {
            $("#txt_insumo" ).val("");
            $('#txt_cantidad').removeAttr('disabled');
            $('#add_product_compra').slideDown();
    
        }
        if (event.keyCode==$.ui.keyCode.DELETE){
            $("#txt_descripcion" ).val("");
            $("#txt_insumo" ).val("");
          
        }
    });
    
    });
    