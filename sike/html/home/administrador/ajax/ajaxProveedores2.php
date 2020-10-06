<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = "";




            /////////////////////////////////////////////////////////////////////////////////////////////////

//Guardar Asesor de Porveedor

if (isset($_POST['action']) == 'agregar_Asesor' AND !empty($_POST['intencion'])) {
    # code...
           //$numero = "";                              
            
            //$n1=$_POST[1];
            $n1 =$_POST['nombreAsesor'];
            $n2=$_POST['telefonoAsesor'];
            $n3 =$_POST['correoAsesor'];
            $n4=$_POST['estadoAsesor'];
            $n5=$_POST['idProveedor'];
            //$n5=$_POST[0];
            

            $sqldpi= "SELECT telefono FROM sike.asesor where telefono =  $n3";
            $res1=mysqli_query($con,$sqldpi);
       
            while ($data=mysqli_fetch_row($res1)){
                                                $numero = $data[0];
                                                }
    
            if ($numero > 0)   {
                            echo 'replica';
                            }
            else    {

                    $sql="INSERT INTO `sike`.`asesor` (`nombre`, `telefono`, `correo`, `estado`, `empresa_id`)   
                    VALUES ('$n1','$n2','$n3','$n4','$n5')";
                    $res=mysqli_query($con,$sql);
                    if($res){
                            echo 'successful';
                            }
                    else    {
                            die("Error".mysqli_error($con));
                            }
                    }
                    exit;
            } //fin del if que almacena datos del proveedor
            //////////////////////////////////////////

} //fin del if
?>
