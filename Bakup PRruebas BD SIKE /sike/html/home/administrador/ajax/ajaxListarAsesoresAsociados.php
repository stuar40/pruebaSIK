<?php

include("../../config/db.php");
include("../../config/conexion.php");


$idProveedoAsesor=$_POST['idProveedoAsesor'];//captura la variable que recibe desde jquery proveedores.js
$sqlConsulta= "SELECT id,nombre,telefono,estado,empresa_id   FROM asesor where empresa_id = $idProveedoAsesor "; //realiza una consulta para ver los asesores que estas asociados al id del proveedor
//$sqlConsulta= "SELECT id,nombre,telefono,estado,empresa_id   FROM asesor     "; //realiza una consulta para ver los asesores que estas asociados al id del proveedor
$resulConsultaAsesoresAsociados=mysqli_query($con,$sqlConsulta);
             $resultadoConsulta=mysqli_query($con,$sqlConsulta); 
$resultadocontarFilas =mysqli_num_rows($resulConsultaAsesoresAsociados);
;
if( !$resulConsultaAsesoresAsociados ){

    die("Error");
}
else {
   
    
if ($resultadocontarFilas < 1){ //si la consulta tiena menos de 1 o mas filas NO se ejeuctara la intruccion
$arregloAsesorAsociado = 'replica';//es la respuesta que espera el JS en caso de no tener resultados
echo json_encode($arregloAsesorAsociado);
}
else {
   
    
   while($data2 = mysqli_fetch_assoc($resulConsultaAsesoresAsociados)){
       // $resultadoConsulta=mysqli_query($con,$sqlConsulta); //realiza la consulta nuevamente
        $arreglo["data"][]=$data2;
        //$data2= mysqli_fetch_assoc($resultadoConsulta);
        //$data2=mysqli_fetch_assoc($resulConsultaAsesoresAsociados);
  }
                        

echo json_encode($arreglo);
}
}
mysqli_free_result($resulConsultaAsesoresAsociados);
mysqli_close($con); 
?>