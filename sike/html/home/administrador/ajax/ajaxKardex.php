<?php 

if ($_POST) { //=========================INCIO del if del AJAXX===============================================================================================================================================================
    # code...
//Varaibles y archivos de conexion externos
include("../../config/db.php");
include("../../config/conexion.php");



//=========================LISTA DE CONDICIONALES IF===============================================================================================================================================================

//////CARGAR DATOS DE la TABLA KARDEX************************************
if ($_POST['action']==='cargarKardex'){
    $fechaKardex=$_POST['fechaKardex'];
    $fechaMesKardex=$_POST['fechaMesKardex'];
    $SeleccionSucursalAsignar=$_POST['SeleccionSucursalAsignar'];
    
    
    $sqlConsulta= "SELECT * FROM kardex WHERE MONTH(fecha) = $fechaMesKardex AND YEAR(fecha) = $fechaKardex AND sucursal_idsucursal = $SeleccionSucursalAsignar"; //realiza una consulta para ver los asesores que estas asociados al id del proveedor
    
    $resulConsultaKardex=mysqli_query($con,$sqlConsulta); //Resultado de la consulta
    $resultadoConsulta=mysqli_query($con,$sqlConsulta); 
    $resultadocontarFilas =mysqli_num_rows($resulConsultaKardex); // cuenta cuantas filas tiene la consulta para poder realizar un while en caso de ser necesario
    
    if( !$resulConsultaKardex ){ //condicional si la consulta se ejecuta bien en el mysql en caso de no ejecutarse marca error
    
        die("Error");
    }
    else { //de lo contrario realizar lo siguiente en caso de ejecutarse correctamente la consulta
       
        
    if ($resultadocontarFilas < 1){ //si la consulta tiena menos de 1 o mas filas NO se ejeuctara la intruccion ya que no tiene ningun dato asociado
    $arreglo='vacio';//es la respuesta que espera el JS en caso de no tener resultados
    echo json_encode($arreglo); //devueve el valor para el javascript
    }
    else { //de lo contrario si eel resultado del contador de filas es mayo >=1  entonces si tienen algun dato ingresado y se imprimira en la tabla y see devolvera el valor al jquery
       //$arreglo='DatosKARDEX';
        
      //  
       while($data2 = mysqli_fetch_assoc($resultadoConsulta)){ //se recorre la consulta  
              $arreglo["data"][]=$data2; // se almacena las filas y columnas de la consulta en una variable multidimensional el cual se devolvera en formato json para su impresion en el datatable esto va a proveedores js 
            }
            echo json_encode($arreglo);
    }
    }
    mysqli_free_result($resulConsultaKardex);
    mysqli_close($con); 
   
   

} //fin del if que consulta datos del asesor 





//=========================FIN DE LISTA DE CONDICIONALES IF===============================================================================================================================================================
} //=========================fin del if del AJAXX===============================================================================================================================================================

//===================fin del archivo ajaxKARDEX
?>