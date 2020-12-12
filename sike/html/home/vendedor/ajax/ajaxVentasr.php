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



$queryselect = "SELECT id, saldo FROM saldo WHERE sucursal_id = '$sucursal' AND recarga_id = '$empresa'";
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
$queryselect = "SELECT id, saldo FROM saldo WHERE sucursal_id = '$sucursal' AND recarga_id = '$empresa'";
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