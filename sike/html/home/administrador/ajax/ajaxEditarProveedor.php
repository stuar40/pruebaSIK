<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");


   //Actualizar datos  Porveedor

   if (isset($_POST['action']) == 'editar_Proveedor' AND !empty($_POST['intencion'])) {
    # code...
           //$numero = "";                              
            
            //$n1=$_POST[1];
            $n1 =$_POST['nombreComercial'];
            $n2=$_POST['proveedorNIT'];
            $n3 =$_POST['proveedorDireccion'];
            $n4=$_POST['telefonoProveedor'];
            $n5=$_POST['descripcionProveedor'];
            $n6=$_POST['idProveedor'];
            

            $sqldpi= "SELECT id FROM sike.empresa where id = $n6";
            $res1=mysqli_query($con,$sqldpi);
       
            while ($data=mysqli_fetch_row($res1)){
                                                $numero = $data[0];
                                                }
    
            if ($numero > 0)   {
                $sql="UPDATE `sike`.`empresa` SET `nombre`='$n1', `nit`='$n2', `direccion`='$n3', `telefono`='$n4', `descripcion`='$n5' WHERE `id`='$n6'";
                    $res=mysqli_query($con,$sql);
                    if($res){
                            echo 'successful';
                            }
                    else    {
                            die("Error".mysqli_error($con));
                            }
                            }
            else    {
                echo 'replica' ;
                    
                    }
                    exit;
            } //fin del if que almacena datos del proveedor
            //////////////////////////////////////////

} //fin del if
?>
