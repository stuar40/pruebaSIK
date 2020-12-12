<?php


if ($_POST) {
    # code...
session_start();
include("../../config/db.php");
include("../../config/conexion.php");


$factura = $_POST["nfactura"];
$proveedor = $_POST["proveedor"];
$sucursal = $_POST["sucursal"];
$monto = $_POST["monto"];
$usuario = $_SESSION['user_id'];




$queryselect = "SELECT id, saldo FROM saldo
INNER JOIN recarga ON saldo.recarga_id = recarga.idrecarga 
WHERE saldo.sucursal_id = '$sucursal' AND recarga.empresa_id ='$proveedor'";
$result = mysqli_query($con,$queryselect);
while($rows = mysqli_fetch_assoc($result)){
$saldo = $rows['saldo'];
$idsaldo = $rows['id'];

}


$sql=" INSERT INTO `comprarecarga` ( `totalcompra`, `factura`, `usuarios_idusuarios`, `sucursal_idsucursal`, `empresa`) 
VALUES ('$monto', '$factura', '$usuario', '$sucursal', '$proveedor');";

$resp=mysqli_query($con,$sql);
if($resp){

    $nuevos= $saldo + $monto;
    $sql2 = "UPDATE `saldo` SET `saldo` = '$nuevos'   WHERE (`id` = '$idsaldo') ";
    

    $res2=mysqli_query($con,$sql2);
    if($res2){
        

    echo "Success";
    // consulta el nombre del proveedor para insertar en kardes detalles 
    $sqlNombreProveedor = "select nombre from empresa where id = '$proveedor'";
    $resultNombreProveedor = mysqli_query($con,$sqlNombreProveedor);
    while($rows2 = mysqli_fetch_assoc($resultNombreProveedor)){
    $nombreProveedorRecargas = $rows2['nombre'];
    }
    //insertar en el kardex el movimiento 
    $sqlKardex="INSERT INTO `kardex` (`factura`, `detalle`, `movimiento`, `cantcompra`, `preciocompra`, `totalcompra`, `existencia`, `sucursal_idsucursal`) 
        VALUES ('$factura', '$nombreProveedorRecargas', 'INGRESO', '1', '$monto', '$monto', '$nuevos', '$sucursal')";
        $resultadoKardex=mysqli_query($con,$sqlKardex);
    }
    else{
        die("Error".mysqli_error($con));
    }


}else{
    die("Error".mysqli_error($con));
}








}

?>