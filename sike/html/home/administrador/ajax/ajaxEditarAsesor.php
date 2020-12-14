<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");


   //Actualizar datos Asesor de Porveedor

   if (isset($_POST['action']) == 'editar_Asesor' AND !empty($_POST['intencion'])) {
    # code...
           //$numero = "";                              
            
            //$n1=$_POST[1];
            $n1 =$_POST['nombreAsesor'];
            $n2=$_POST['telefonoAsesor'];
            $n3 =$_POST['correoAsesor'];
            $n4=$_POST['estadoAsesor'];
            $n5=$_POST['idProveedor'];
            $n6=$_POST['idAsesor'];
               

            $sqldpi= "SELECT id  FROM asesor where id = $n6";
            $res1=mysqli_query($con,$sqldpi);
       
            while ($data=mysqli_fetch_row($res1)){
                                                $numero = $data[0];
                                                }
    
            if ($numero > 0)   {
                $sql="UPDATE `asesor` SET `nombre`='$n1', `telefono`='$n2', `correo`='$n3', `estado`='$n4', `empresa_id`='$n5' WHERE `id`='$n6'";
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
