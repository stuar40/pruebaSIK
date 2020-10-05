
$(document).ready(function(){

  

    if($('#txtSearch').length){

        $('#txtSearch').keyup(function(){
        const dataSearch = $('#txtSearch').val();
        const dataSearch3 = $('#txtSearch2').val();
        const action = 'searchContactKey';
        var dataContact = '';
        $.ajax({
        url: './ajax/ajaxUsuarios.php',
        type: "POST",
        async: true,
        data:   {
        action:action, dataSearch:dataSearch,dataSearch3: dataSearch3
                },
            beforeSend: function(){
                
                                    },
        success: function(response){
        if (response == 'notData') {
        dataContact = "No hay registros para mostrar";
        }else{
        var info = JSON.parse(response);
        dataContact = info;
        }
        $('#rowsUsuarios').html(dataContact);
        },
        error: function(error){
        }
        });
        });
            }
    //SDFAFSDSAFSD

    if($('#txtSearch2').length){
        $('#txtSearch2').keyup(function(){
        const dataSearch = $('#txtSearch2').val();
        const action = 'searchSucural';
        var dataContact = '';
        $.ajax({
        url: './ajax/ajaxUsuarios.php',
        type: "POST",
        async: true,
        data: {
        action:action, dataSearch2:dataSearch
        },
        beforeSend: function(){ },
        success: function(response){
        if (response == 'notData') {
            dataContact = "No hay registros para mostrar";
        }else{
        var info = JSON.parse(response);
        dataContact = info; 
        }
        $('#rowsUsuarios').html(dataContact);
        },
        error: function(error){
        }  
        });
        });
        }
        
    
    ///222
    if ($('#tblUsuarios').length) {
        fntusuarios();
        }


    if ($('#btn_nuevo_usuario').length) {
        $('#btn_nuevo_usuario').click(function(){
        $.ajax({
        url : window.location.href='nusuarios.php',
        });
        });
        }

    if ($('#idenviar').length) {
        $('#idenviar').click(function(){
        $.ajax({
        url : window.location.href='nusuarios.php',
        });
        });
        }
/// Insertar Usuarios

    $("#guardar_usuario").submit(function( event ) {
        $('#guardar_datos').attr("disabled", true);
        var parametros = $(this).serialize();
           $.ajax({
                    type: "POST",
                    url: "ajax/ajaxUsuarios.php",
                    data: parametros,
                    beforeSend: function(objeto){},
                    success: function(response){
                    if(response == 'replica'){
                            Swal.fire({
                            title: "El usuario Ya existe",
                            icon: 'error',
                            });
                            $('#cui').val('');
                            }
                    if (response == 'successful' ) {
                        Swal.fire({
                                title: "Usuario Guardado",
                                icon: 'success',
                                });
                     
                    $('#pnombre').val('');
                    $('#snombre').val('');
                    $('#papellido').val('');
                    $('#sapellido').val('');
                    $('#cui').val('');
                    $('#fecha').val('');
                    $('#usuario').val('');
                    $('#email').val('');
                    $('#pass').val('');
                    $('#dir').val('');
                    $('#telefono').val('');
                    $('#estad').val('Seleccione Estado');
                    $('#rol').val('Seleccione Tipo de Usuario');
                    $('#sids').val('Seleccione Sucursal');
                    $('#hora').val('Seleccione Horario');
                    
                }
                }
          });
        event.preventDefault();
      })

//Editar usuarios
$( "#editar_usuario" ).submit(function( event ) {
                                $('#actualizar_datos2').attr("disabled", true);
                            
                            var parametros = $(this).serialize();
                                $.ajax({
                                        type: "POST",
                                        url:  "ajax/ajaxUsuarios.php",
                                        data: parametros,
                                        beforeSend: function(objeto){
                                            $("#resultados_ajax2").html("Mensaje: Cargando...");
                                            },
                                        success: function(datos){
                                            
                                            $("#cerrar").click();
                                            $("#span").click();
                                            console.log(datos);
                                        
                                            fntusuarios();
                                            alert('Empleado editado correctamente');

                                        }
                                });
                                event.preventDefault();
                            })


   }); // FIN DEL READY de la carga de la pagina 

   //incian las funciones 


 //Listar usuarios
 function fntusuarios(){
    const action = 'listUsuarios';
    const data ='';
    $.ajax({
    url: './ajax/ajaxUsuarios.php',
    type: "POST",
    async: true,
    
    data:{action:action},
    
    beforeSend: function(){
    
    
    },
    
    success: function(response){
        if(response == 'notData'){
            data = "No hay datos para mostrar";
        }else{
    var data = JSON.parse(response);

    
        }
        $('#rowsUsuarios').html(data);
    }
    
    });
    
    }




function sendUsuario(idempleado){

    //funcion
    $url = 'editar_usuarios.php?idusuario='+idempleado;
    window.open($url);


}

// Obtener Datos

function obtener_datos(idempleados){
    var action = 'obtener_datos';
    var id_empleado = idempleados;
    
    
    $.ajax({
        url: './ajax/ajaxUsuarios.php',
        type: "POST",
        async: true,
        data: {action:action, id_empleado:id_empleado },
        success: function(response){
            if (response != 'error') {

                var info = JSON.parse(response);
                $('#id_usu').val(info.id);
                $('#pnombre2').val(info.pnom);
                $('#snombre2').val(info.snom);
                $('#papellido2').val(info.pape);
                $('#sapellido2').val(info.sape);
                $('#usuario2').val(info.nombre_usuario);
                $('#pass2').val(info.password);
                $('#telefono2').val(info.telefono);
                $('#cui2').val(info.dpi);
                $('#estad2').val(info.estado);
                $('#ridr2').val(info.roles_id);
                $('#sids2').val(info.sucursal_id);
                $('#fecha2').val(info.nacimiento);
                $('#dir2').val(info.direccion);
                $('#hora2').val(info.horarios_id);
                $('#email2').val(info.correo);
            }else{
            
             console.log("No existen datos")
            
                }
         

        },
        error: function(error){
        console.log(error);
        }
        
            });


}

//Cambiar de estado a los usuarios

function estado (idusuario) {
    const action ='situacion';
    var idusuario = idusuario;
    $.ajax({

type: "POST",
url: './ajax/ajaxUsuarios.php',
async: true,
data: {action:action, id:idusuario},

success:function(response){

    if (response == 'Realizado') {
        fntusuarios();
     
        Swal.fire({
            title: "Estado Actualizado",
            icon: 'success',
            });
      
    } else {
       
    }
 
 

},

error: function(error){
console.log(error);
},

    });
}