<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");







//Insertar producto
            if (isset($_POST['action']) == 'insertar' && !empty($_POST['nombresCliente'])) {


                $nit = "";
                $nombresCliente=$_POST['nombresCliente'];
                $apellidosCliente=$_POST['apellidosCliente'];
                $nitCliente=$_POST['nitCliente'];
                $telefonoCliente=$_POST['telefonoCliente'];
                $direccionCliente=$_POST['direccionCliente'];
                $emailCliente=$_POST['emailCliente'];

                $sqlproducto= "SELECT nit FROM clientes where nit = '$nitCliente' ";
                $res1=mysqli_query($con,$sqlproducto);
                    while ($data=mysqli_fetch_row($res1))
                                                {
            $nit = $data[0];
                                                }                              
                
            if ($nit > 0) {
                echo 'replica';
            }
            else{
            
                $sql="INSERT INTO `protec_db`.`clientes` (`nombre`, `apellido`, `nit`, `telefono`, `direccion`, `correo`)
                VALUES('$nombresCliente', '$apellidosCliente', '$nitCliente', '$telefonoCliente', '$direccionCliente', '$emailCliente')";
                $res=mysqli_query($con,$sql);
                if($res){
                   echo 'successful';
            
                }else{
                    die("Error".mysqli_error($con));
                }
            }
            exit;

            }

            // Obtener datos
if (isset($_POST['action']) == 'obtener_datos' AND !empty($_POST['id_producto']) ) {
    # code...
    if (!empty($_POST['id_producto'])) {
        # code...

    
        $arrProducto = array();
    $intId = intval($_POST['id_producto']);

    $query_select = mysqli_query($con,"SELECT * FROM clientes where id = $intId");
    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
        # code...
        $arrProducto = mysqli_fetch_assoc($query_select);
       
         echo  json_encode($arrProducto, JSON_UNESCAPED_UNICODE);
    
    }else{
    echo "error";
    
    }
    exit;
    
    }


}




if (isset($_POST['action']) == 'editar' && !empty($_POST['eid'])) {
                
  
    $n0 = $_POST['eid'];                    
    $nombresCliente=$_POST['nombresCliente2'];
    $apellidosCliente=$_POST['apellidosCliente2'];
    $nitCliente=$_POST['nitCliente2'];
    $telefonoCliente=$_POST['telefonoCliente2'];
    $direccionCliente=$_POST['direccionCliente2'];
    $emailCliente=$_POST['emailCliente2'];


    $sql=" UPDATE clientes SET `nombre` = '$nombresCliente', `apellido` = '$apellidosCliente', `nit` = '$nitCliente', 
    `telefono` = '$telefonoCliente' ,`direccion`='$direccionCliente',`correo`='$emailCliente' WHERE (`id` = '$n0')";
    $res=mysqli_query($con,$sql);
    if($res){
       echo 'successful';

    }else{
        die("Error".mysqli_error($con));
    }

exit;

}


} //fin del if
?>
