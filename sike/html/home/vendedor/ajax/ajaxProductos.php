<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");







//Insertar producto
            if (isset($_POST['action']) == 'insertar' AND !empty($_POST['producto'])) {
                
  

                $nombre = "";                       
                $n1=$_POST['producto'];
                $n2 =$_POST['descripcion'];
                $n3=$_POST['presentacion'];
                $n4 =$_POST['marca'];
                $n5 =$_POST['categoria'];
                $n6=$_POST['subcategoria'];
                $sku =$_POST['sku'];
         
            
            
                $sqlproducto= "SELECT nombre FROM producto where sku = '$sku' ";
                $res1=mysqli_query($con,$sqlproducto);
                $row_ct = mysqli_num_rows($res1);
                                           
                if ($row_ct == 0) {
            
                $sql="INSERT INTO `producto`(sku,nombre,descripcion,presentacion,marca,estado_prod_id,subcategoria_id) 
                VALUES ('$sku','$n1','$n2','$n3','$n4','$n5','$n6')";
                $res=mysqli_query($con,$sql);
                if($res){
                   echo 'successful';
            
                }else{
                    die("Error".mysqli_error($con));
                }
            
            exit;} else{
                echo 'replica';
                
            }


            }




            // Obtener datos
if (isset($_POST['action']) == 'obtener_datos' AND !empty($_POST['id_producto']) ) {
    # code...
    if (!empty($_POST['id_producto'])) {
        # code...

    
        $arrProducto = array();
    $intId = intval($_POST['id_producto']);

    $query_select = mysqli_query($con,"SELECT p.id,p.nombre,p.descripcion,p.presentacion,p.marca,c.nombre as categoria,
    s.nombre as subcategoria, e.estado, c.id as idcategoria,s.id as idsubcategoria,p.estado_prod_id AS idestado 
    FROM producto p INNER JOIN subcategoria s ON p.subcategoria_id = s.id
    INNER JOIN categoria c ON c.id = s.categoria_id
    INNER JOIN estado_prod e ON e.id = p.estado_prod_id WHERE p.id  = $intId");
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





} //fin del if
?>
