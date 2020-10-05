<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = "";


//Guardar Usuarios

if (isset($_POST['action']) == 'agregar_usuario' AND !empty($_POST['intencion'])) {
    # code...
            $dpi = "";                              
            $n1=$_POST['pnombre'];
            $n2 =$_POST['snombre'];
            $n3=$_POST['papellido'];
            $n4 =$_POST['sapellido'];
            $n5=$_POST['fecha'];
            $n6 =$_POST['usuario'];
            $n7=$_POST['telefono'];
            $n8=$_POST['dir'];
            $n9 =$_POST['cui'];
            $n10=$_POST['pass'];
            $n11=$_POST['email'];
            $n12=$_POST['estad'];
            $n13 =$_POST['rol'];
            $n14=$_POST['hora'];
            $n15=$_POST['sids'];

            $sqldpi= "SELECT dpi FROM usuarios where dpi = $n9";
            $res1=mysqli_query($con,$sqldpi);
       
            while ($data=mysqli_fetch_row($res1)){
                                                $dpi = $data[0];
                                                }
    
            if ($dpi > 0)   {
                            echo 'replica';
                            }
            else    {

                    $sql="INSERT INTO `sike`.`usuarios` (`pnom`, `snom`, `pape`, `sape`, `nacimiento`, `nombre_usuario`,
                    `telefono`, `direccion`, `dpi`, `password`, `correo`, `estado`, `roles_id`, `horarios_id`, `sucursal_id`) 
                    VALUES ('$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8','$n9','$n10','$n11','$n12','$n13','$n14','$n15')";
                    $res=mysqli_query($con,$sql);
                    if($res){
                            echo 'successful';
                            }
                    else    {
                            die("Error".mysqli_error($con));
                            }
                    }
                    exit;
            }



} //fin del if
?>
