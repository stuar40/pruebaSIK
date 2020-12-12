<?php 

if ($_POST) {
    # code...

 
    session_start();
    include("../../config/db.php");
    include("../../config/conexion.php");
    //Guardar Saldo

    if (isset($_POST['action']) == 'agregar_saldo' and !empty($_POST['idProveedor'])) {
        # code...
  

        $proveedor = "";
        $n1=$_POST['idProveedor'];
        $idsucursal = $_POST['sucursal'];
        $token = $_SESSION['user_id'];

        $query = "SELECT *  FROM saldo WHERE recarga_id = $n1  AND sucursal_id = $idsucursal ";
        $result = mysqli_query($con, $query);
        $row_ct = mysqli_num_rows($result);
     
        
        if ($row_ct == null) {
            $sql = "INSERT INTO `saldo` ( `recarga_id`, `sucursal_id`) VALUES ('$n1',  ' $idsucursal');";
            $res = mysqli_query($con, $sql);
            if ($res) {
                echo 'successfull';
            } else {
                die("Error" . mysqli_error($con));
            }
            mysqli_close($con);
            exit;
        } else {
            echo 'replica';
        }




    }




 //Editar asignación de datos
    if (isset($_POST['action']) == 'editar' AND !empty($_POST['eid'])) {      
  
        $n0 = $_POST['eid'];                    
        $n1=$_POST['eproducto'];
        $n2 =$_POST['edescripcion'];
        $n3=$_POST['epresentacion'];
        $n4 =$_POST['emarca'];
        $n5 =$_POST['eestado'];
        $n6=$_POST['esubcategoria'];
    
    
        $sql="UPDATE producto SET `nombre` = '$n1',`descripcion` = '$n2',`presentacion` = '$n3',
        `marca` = '$n4', `estado_prod_id` = '$n5',`subcategoria_id` = '$n6'
         WHERE (`id` = '$n0')";
        $res=mysqli_query($con,$sql);
        if($res){
           echo 'successful';
    
        }else{
            die("Error".mysqli_error($con));
        }
    
    exit;
    
    }





}

?>