<?php 

if ($_POST) {
    # code...

 
    session_start();
    include("../../config/db.php");
    include("../../config/conexion.php");
    //Guardar Saldo

    if (isset($_POST['action']) == 'agregar_saldo' and !empty($_POST['dinero'])) {
        # code...
  

        $proveedor = "";
        $n1=$_POST['idProveedor'];
        $n2 =$_POST['dinero'];
        $idsucursal = $_POST['sucursal'];
        $token = $_SESSION['user_id'];

        $sqlproveedor= "SELECT empresa_id FROM recarga where empresa_id = $n1 AND sucursal_id = $idsucursal";
        $res1=mysqli_query($con, $sqlproveedor);
        while ($data=mysqli_fetch_row($res1)) {
            $proveedor = $data[0];
        }
    
        if ($proveedor > 0) {
            echo 'replica';
        } else {
            $sql="INSERT INTO `sike`.`recarga` (`monto`, `empresa_id`,`sucursal_id` , `categoria_id`,`usuarios_id`) 
    VALUES ('$n2','$n1','$idsucursal','1','$token')";
            $res=mysqli_query($con, $sql);
            if ($res) {
                echo 'successful';
            } else {
                die("Error".mysqli_error($con));
            }
        }
        exit;
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