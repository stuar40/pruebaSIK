<?php 

if ($_POST) {
    # code...
session_start();
include("../../config/db.php");
include("../../config/conexion.php");

if ($_POST['action'] == 'SearchContact') {  
    # code...
if (!empty($_POST['id'])) {
    # code...
    $arrContact = array();
$intId = intval($_POST['id']);
$query_select = mysqli_query($con,"SELECT * FROM producto WHERE sku = $intId");
$num_rows = mysqli_num_rows($query_select);
if ($num_rows > 0) {
    # code...
    $arrContact = mysqli_fetch_assoc($query_select);
   
     echo  json_encode($arrContact, JSON_UNESCAPED_UNICODE);
 
}else{
echo "NOENCONTRADO";

}
exit;

}


}

// Buscar input
if ($_POST['action'] == 'infoProducto') {
    # code...
    $searchData = $_POST['producto'];
    $sucursal = $_POST['sucursal'];
    $query_select = mysqli_query($con,"SELECT producto.id,sku,producto.nombre,producto.descripcion,producto.presentacion,producto.marca FROM precios
    INNER JOIN producto ON producto.id = precios.producto_idproducto
    WHERE sku = '$searchData'  AND precios.sucursal_idsucursal = '$sucursal'  AND precios.estado = 'ACTIVO'");
    mysqli_close($con);
$result = mysqli_num_rows($query_select);
if ($result > 0) {
    # code...
    $data = mysqli_fetch_assoc($query_select);
    echo json_encode($data,JSON_UNESCAPED_UNICODE);

}
else{
echo 'noencontrado';


}
exit;
}

//listar
if ($_POST['action'] == 'listContact') {
    # code...


    $query_select = mysqli_query($con,"SELECT * FROM producto  ");

    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
        # code...
        $htmlTable = '';
        while ($row = mysqli_fetch_assoc($query_select)) {

            # code...
            $htmlTable .= '<tr>
            <th scope="row">'.$row['idproducto'].'</th>
            <th scope="row">'.$row['codigo'].'</th>
            <th scope="row">'.$row['descripcion'].'</th>
            <th scope="row">'.$row['estado'].' </th>
            <th scope="row">'.$row['empleados_idempleados'].'</th>
            </tr> ';
        }
    
        echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
    }else{
        
        echo "notData";
    }
    exit;
}

// Agregar producto a detalle temporal
if ($_POST['action'] == 'addCompraDetalle') {
if (empty($_POST['idproducto']) || empty($_POST['cantidad']) || empty($_POST['precio']  )) {
    # code...
echo 'error';

}else{
$idproducto = $_POST['idproducto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$token = $_SESSION['user_id'];


$query_detalle_temp = mysqli_query($con,"CALL add_detallecompra_temp($idproducto, $cantidad, $precio,$token)");
$result = mysqli_num_rows($query_detalle_temp);


$detalleTabla = '';
$detalle_totales = '';
$sub_total = 0;
$total = 0;
$arrayData = array();

if ($result > 0) {
    # code...

while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
    # code...
$precioTotal = round($data['cantidad'] * $data['precio_compra'],2);
$sub_total = round($sub_total + $precioTotal,2);
$total = round($total + $precioTotal,2);

$detalleTabla .= '

<tr>
<td colspan="4" class="text-center">'.$data['iddetalle_compra_temp'].'</td>
<td colspan="4" class="text-center">'.$data['nombre'].'</td>
<td colspan="4" class="text-center">'.$data['descripcion'].'</td>
<td colspan="4" class="text-center">'.$data['presentacion'].'</td>
<td colspan="4" class="text-center">'.$data['marca'].'</td>
<td class="text-center">'.$data['cantidad'].'</td>
<td class="text-center">'.$data['precio_compra'].'</td>
<td class="text-center">'.$precioTotal.'</td> 

<td class="text-center">
    <a class="link_delete" href="#" onclick="event.preventDefault(); 
    del_product_detalle('.$data['iddetalle_compra_temp'].');"><i class="fa fa-trash-alt"> Borrar</i></a>
    
    </td>

</tr>
';


}




$detalle_totales .= '
<tr>
            <td colspan="4" class="text-right"> Total Q.</td>
            <td class="text-right"> '.$total.'</td>
        </tr>
';

$arrayData['detalle'] = $detalleTabla;

$arrayData['totales'] = $detalle_totales;

echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
}else {
    # code...
    echo 'error';

}
mysqli_close($con);
}

   exit;
}

// Estrae datos del datalle_temp
if ($_POST['action'] == 'serchForDetalle') {

    if (empty($_POST['user']) ) {
        # code...
    echo 'error 1';
    
    }else{
   
    $token = $_SESSION['user_id'];
    
    $query= mysqli_query($con," SELECT tmp.iddetalle_compra_temp,producto.nombre, producto.descripcion,
    producto.presentacion,producto.marca,tmp.cantidad,tmp.precio_compra 
    FROM detalle_compra_temp tmp
    INNER JOIN producto on tmp.producto_idproducto = producto.id
    where tmp.token_user   = $token");
    $result = mysqli_num_rows($query);
    
    
    $detalleTabla = '';
    $detalle_totales = '';
    $sub_total = 0;
    $total = 0;
    $arrayData = array();
    
    if ($result > 0) {
        # code...
    
    while ($data = mysqli_fetch_assoc($query)) {
        # code...
    $precioTotal = round($data['cantidad'] * $data['precio_compra'],2);
    $sub_total = round($sub_total + $precioTotal,2);
    $total = round($total + $precioTotal,2);
    
    $detalleTabla .= '
    <tr>
    <td colspan="4" class="text-center">'.$data['iddetalle_compra_temp'].'</td>
    <td colspan="4" class="text-center">'.$data['nombre'].'</td>
    <td colspan="4" class="text-center">'.$data['descripcion'].'</td>
    <td colspan="4" class="text-center">'.$data['presentacion'].'</td>
    <td colspan="4" class="text-center">'.$data['marca'].'</td>
    <td class="text-center">'.$data['cantidad'].'</td>
    <td class="text-center">'.$data['precio_compra'].'</td>
    <td class="text-center">'.$precioTotal.'</td> 
    
    <td class="text-center">
        <a class="link_delete" href="#" onclick="event.preventDefault(); 
        del_product_detalle('.$data['iddetalle_compra_temp'].');"><i class="fa fa-trash-alt"> Borrar</i></a>
        
        </td>
    
    </tr>
    ';
    
    
    }
    
    
    
    
    $detalle_totales .= '
    <tr>
                <td colspan="4" class="text-right"> Total Q.</td>
                <td class="text-right"> '.$total.'</td>
            </tr>
    ';
    
    $arrayData['detalle'] = $detalleTabla;
    
    $arrayData['totales'] = $detalle_totales;
    
    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
    }else {
        # code...
        echo 'error 2';
    
    }
    mysqli_close($con);
    }
    
       exit;

}
//Eliminar detalle de compra

if ($_POST['action'] == 'del_product_detalle') {

    if (empty($_POST['id_detalle']) ) {
        # code...
    echo 'error';
    
    }else{
    $id_detalle = $_POST['id_detalle'];
    $token = $_SESSION['user_id'];
    
    $query= mysqli_query($con,"CALL del_detalle_temp($id_detalle,$token) ");
    $result = mysqli_num_rows($query);
    
    
    $detalleTabla = '';
    $detalle_totales = '';
    $sub_total = 0;
    $total = 0;
    $arrayData = array();
    
    if ($result > 0) {
        # code...
    
    while ($data = mysqli_fetch_assoc($query)) {
        # code...
    $precioTotal = round($data['cantidad'] * $data['precio_compra'],2);
    $sub_total = round($sub_total + $precioTotal,2);
    $total = round($total + $precioTotal,2);
    
    $detalleTabla .= '
    

    <tr>
    <td colspan="4" class="text-center">'.$data['iddetalle_compra_temp'].'</td>
    <td colspan="4" class="text-center">'.$data['nombre'].'</td>
    <td colspan="4" class="text-center">'.$data['descripcion'].'</td>
    <td colspan="4" class="text-center">'.$data['presentacion'].'</td>
    <td colspan="4" class="text-center">'.$data['marca'].'</td>
    <td class="text-center">'.$data['cantidad'].'</td>
    <td class="text-center">'.$data['precio_compra'].'</td>
    <td class="text-center">'.$precioTotal.'</td> 
    
    <td class="text-center">
        <a class="link_delete" href="#" onclick="event.preventDefault(); 
        del_product_detalle('.$data['iddetalle_compra_temp'].');"><i class="fa fa-trash-alt"> Borrar</i></a>
        
        </td>
    
    </tr>
    ';
    
    
    }
    
    
    
    
    $detalle_totales .= '
    <tr>
                <td colspan="4" class="text-right"> Total Q.</td>
                <td class="text-right"> '.$total.'</td>
            </tr>
    ';
    
    $arrayData['detalle'] = $detalleTabla;
    
    $arrayData['totales'] = $detalle_totales;
    
    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
    }else {
        # code...
        echo 'error';
    
    }
    mysqli_close($con);
    }
    
       exit;

}



// Anuar compra

if($_POST['action'] == 'anularCompra'){
    $token = $_SESSION['user_id'];
$query_del = mysqli_query($con, "DELETE FROM detalle_compra_temp WHERE token_user = $token");
mysqli_close($con);
if ($query_del) {
    # code...
    echo 'OK';
}else{

    echo 'Error no se pudo procesar';
}
}

// Procesar compra
if($_POST['action'] == 'procesarCompra'){

    if (empty($_POST['proveedor']) || empty($_POST['nfactura']) ||  empty($_POST['sucursal'])  ) {

        echo 'error1';
    }

    else{
        $token = $_SESSION['user_id'];
        $query = mysqli_query($con,"SELECT * FROM detalle_compra_temp WHERE token_user = $token ");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            # code...
            
        $proveedor = $_POST['proveedor'];
        $nfactura = $_POST['nfactura'];
        $sucursal = $_POST['sucursal'];
        $token = $_SESSION['user_id'];
            $query_procesar = mysqli_query($con, "CALL procesar_compra($proveedor, '$nfactura', $token, $sucursal)");
            $result_detalle = mysqli_num_rows($query_procesar);

if($result_detalle > 0){
$data = mysqli_fetch_assoc($query_procesar);
echo json_encode($data, JSON_UNESCAPED_UNICODE);


}else
{
    echo 'error2';
}


        }else{
            echo 'error3';
        }
mysqli_close($con);
exit;

    }



}



}
exit ;
?>