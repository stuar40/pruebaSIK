<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = "";



///////Guardar Proveedor
if (isset($_POST['action']) == 'agregar_Proveedor' AND !empty($_POST['intencion'])) {
    # code...
          //  $dpi = "";                              
            $n1=$_POST['nombreComercial'];
            $n2 =$_POST['proveedorNIT'];
            $n3=$_POST['proveedorDireccion'];
            $n4 =$_POST['telefonoProveedor'];
            $n5=$_POST['descripcionProveedor'];
            

            $sqldpi= "SELECT nit FROM sike.empresa where nit =  $n2";
            $res1=mysqli_query($con,$sqldpi);
       
            while ($data=mysqli_fetch_row($res1)){
                                                $dpi = $data[0];
                                                }
    
            if ($dpi > 0)   {
                            echo 'replica';
                            }
            else    {

                    $sql="INSERT INTO `sike`.`empresa` (`nombre`, `nit`, `direccion`, `telefono`, `descripcion`)  
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
            

            $sqldpi= "SELECT correo  FROM asesor where correo =  $n2";
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
                                echo 'successful';
                                }
                else    {
    
                        $sql="UPDATE `sike`.`asesor` SET `nombre`='$n1', `telefono`='$n2', `correo`='$n3', `estado`='$n4', `empresa_id`='$n5' WHERE `id`='$n6'";
                        $res=mysqli_query($con,$sql);
                        if($res){
                                echo 'replica';
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
