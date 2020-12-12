$().ready(function(){
    $('#guardar_producto').validate({
        rules:{
          nombresCliente:{
            required:true,
            minlength:3,
            maxlength:9
          }
        },
        messages:{
          nombresCliente:"Cosa"
        }
      })
  
 }); // End Ready