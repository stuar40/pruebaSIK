<?php 

if ($_POST) {
    session_start();
include("../../config/db.php");
include("../../config/conexion.php");


if (isset($_POST['action']) == 'nuevar' AND !empty($_POST['telefono'])) {

$factura = $_POST["nfactura"];
$empresa = $_POST["empresa"];
$trecarga =$_POST["trecarga"];
$monto =$_POST["monto"];
$telefono =$_POST["telefono"];
$usuario = $_SESSION['user_id'];
$sucursal =$_SESSION['sucursal_id'];



$queryselect = "SELECT id, saldo FROM saldo
INNER JOIN recarga ON saldo.recarga_id = recarga.idrecarga 
WHERE saldo.sucursal_id = '$sucursal' AND recarga.empresa_id = '$empresa'";
$result = mysqli_query($con,$queryselect);
while($rows = mysqli_fetch_assoc($result)){
$saldo = $rows['saldo'];
$idsaldo = $rows['id'];

}

$sql=" INSERT INTO `ventarecarga` ( `totalventa`, `descripcion`, `factura`, `usuarios_idusuarios`, `sucursal_idsucursal`, `numero`, `empresa`) 
VALUES ( '$monto', '$trecarga', '$factura', '$usuario', '$sucursal', '$telefono', '$empresa');
";

$resp=mysqli_query($con,$sql);
if($resp){

$nuevos= $saldo - $monto;
    $sql2 = "UPDATE `saldo` SET `saldo` = '$nuevos'   WHERE (`id` = '$idsaldo') ";


    $res2=mysqli_query($con,$sql2);
    if($res2){
    
    echo "successful";
    //KARDEX
    // consulta el nombre del proveedor para insertar en kardes detalles 
        $sqlNombreProveedor = "select nombre from empresa where id = '$empresa'";
        $resultNombreProveedor = mysqli_query($con,$sqlNombreProveedor);
        while($rows2 = mysqli_fetch_assoc($resultNombreProveedor)){
        $nombreProveedorRecargas = $rows2['nombre'];
        }
    //insertar en el kardex el movimiento 
    $sqlKardex="INSERT INTO `kardex` (`factura`, `detalle`, `movimiento`, `cantventa`, `precioventa`, `totalventa`, `existencia`, `sucursal_idsucursal`) 
    VALUES ('$factura', '$nombreProveedorRecargas', 'EGRESO', '1', '$monto', '$monto', '$nuevos', '$sucursal')";
    $resultadoKardex=mysqli_query($con,$sqlKardex);
    
    }
    else{
        die("Error".mysqli_error($con));
    }


}else{
    die("Error".mysqli_error($con));
}




}



if (isset($_POST['action']) == 'consulta' AND !empty($_POST['idempresa'])) 
{

    $empresa = $_POST['idempresa'];
    $sucursal =$_SESSION['sucursal_id'];
$queryselect = "SELECT id, saldo FROM saldo
INNER JOIN recarga ON saldo.recarga_id = recarga.idrecarga 
WHERE saldo.sucursal_id = '$sucursal' AND recarga.empresa_id = '$empresa'";
$result = mysqli_query($con,$queryselect);
if($result){
while($rows = mysqli_fetch_assoc($result)){
$saldo = $rows['saldo'];
$idsaldo = $rows['id'];

echo $saldo ;

}
}else{

    echo 'error';
}




}







}




?>