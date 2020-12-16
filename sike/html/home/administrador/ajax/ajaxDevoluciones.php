<?php 

if ($_POST) {
    # code...

include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = "";


//===================incio del archivo ajaxAsesore

//////CARGAR DATOS DE la TABLA KARDEX************************************
if ($_POST['action']==='cargar_DetalleVenta'){
   
    $numFactura=$_POST['numFactura'];//captura la variable que recibe desde jquery proveedores.js
    $sqlConsulta= "SELECT numfactura,iddetalleventa,nombre,precio,cantidad FROM detalleventa inner join encabezado_venta on detalleventa.encabezado_venta_id=encabezado_venta.id inner join producto on detalleventa.producto_idproducto=producto.id WHERE numfactura = $numFactura "; //realiza una consulta para ver los asesores que estas asociados al id del proveedor
    //$sqlConsulta= "SELECT id,nombre,telefono,estado,empresa_id   FROM asesor     "; //realiza una consulta para ver los asesores que estas asociados al id del proveedor
    
    
    
    $resulConsultaDetalleVentas=mysqli_query($con,$sqlConsulta); //Resultado de la consulta
    $resultadoConsulta=mysqli_query($con,$sqlConsulta); 
    $resultadocontarFilas =mysqli_num_rows($resulConsultaDetalleVentas); // cuenta cuantas filas tiene la consulta para poder realizar un while en caso de ser necesario
    
    if( !$resulConsultaDetalleVentas ){ //condicional si la consulta se ejecuta bien en el mysql en caso de no ejecutarse marca error
    
        die("Error");
    }
    else { //de lo contrario realizar lo siguiente en caso de ejecutarse correctamente la consulta
       
        
    if ($resultadocontarFilas < 1){ //si la consulta tiena menos de 1 o mas filas NO se ejeuctara la intruccion ya que no tiene ningun dato asociado
    $arregloDetalleVentas = 'replica';//es la respuesta que espera el JS en caso de no tener resultados
    echo json_encode($arregloDetalleVentas); //devueve el valor para el javascript
    }
    else { //de lo contrario si eel resultado del contador de filas es mayo >=1  entonces si tienen algun dato ingresado y se imprimira en la tabla y see devolvera el valor al jquery
       
        
       while($data2 = mysqli_fetch_assoc($resulConsultaDetalleVentas)){ //se recorre la consulta  
           
            $arreglo["data"][]=$data2; // se almacena las filas y columnas de la consulta en una variable multidimensional el cual se devolvera en formato json para su impresion en el datatable esto va a proveedores js 
            
      }
                            
    
    echo json_encode($arreglo); //esto va   a proveedores js en la funcion del selectproveedores
    }
    }
    mysqli_free_result($resulConsultaDetalleVentas);
    mysqli_close($con); 
   
   

} //fin del if que consulta datos del asesor 

///////Guardar  guardarDevolucion
if ($_POST['action'] == 'guardarDevolucion') {
    //console.log("Entro A Guardar");
    # code...
    $data2 = array();
    $action = $_POST['action'];
        //  $dpi = "";       
        $numFacturaIntercambiar =$_POST["numFacturaIntercambiar"];
        $clienteIntercambiar=$_POST['clienteIntercambiar'];
        $codProductoIntercambiar =$_POST['codProductoIntercambiar'];
        $precioIntercambio=$_POST['precioIntercambio'];
        $cantidadIntercambiar=$_POST['cantidadIntercambiar'];
        $motivoIntercambio=$_POST['motivoIntercambio'];

        $sql="INSERT INTO `devolucion` (`facturadevolucion`, `detallefacturadevolucion`, `movimientodevolucion`, `productodevolucion`, `preciodevolucion`, `cantidaddevolucion`, `motivodevolucion`) 
        VALUES ('$numFacturaIntercambiar', '$codProductoIntercambiar', 'INTERCAMBIO', '$codProductoIntercambiar', '$precioIntercambio', '$cantidadIntercambiar', '$motivoIntercambio')";
           
           $res=mysqli_query($con,$sql);
            
            if($res){
                        $data2='successful';
                    }
                else    {
                        die("Error".mysqli_error($con));
                        }
            
                
                echo json_encode($data2); //devuelve el resultado
                exit;
        
            
} //fin 



} //=========================fin del if del AJAXX===============================================================================================================================================================

 //===================fin del archivo ajaxAsesores
?>