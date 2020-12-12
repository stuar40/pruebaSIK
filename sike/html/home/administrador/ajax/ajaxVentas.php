<?php 

if ($_POST) {
    # code...
session_start();
include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = $_SESSION['sucursal_id'];

if ($_POST['action'] == 'SearchContact') {
    # code...
if (!empty($_POST['id'])) {
    # code...
    $arrContact = array();
$intId = intval($_POST['id']);
$query_select = mysqli_query($con,"SELECT * FROM producto WHERE idproducto = $intId");
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


    $query_select = mysqli_query($con," SELECT producto.id as idproducto,producto.sku,producto.nombre,producto.descripcion,producto.presentacion,producto.marca,
    precios.existencia,precios.estado,precios.precio_venta,precios.precio_minimo,precios.precio_promocion,sucursal.id as idsucursal,sucursal.numero
    FROM producto INNER JOIN precios ON precios.producto_idproducto = producto.id
   INNER JOIN sucursal ON sucursal.id = precios.sucursal_idsucursal
    WHERE producto.sku = $searchData AND sucursal.id = $sucursal");
    mysqli_close($con);
$result = mysqli_num_rows($query_select);
if ($result > 0) {
    # code...
    $data = mysqli_fetch_assoc($query_select);
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    exit;
}
echo 'error';
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
if ($_POST['action'] == 'addVentaDetalle') {
if (empty($_POST['insumo']) || empty($_POST['cantidad']) || empty($_POST['precio']  )) {
    # code...
echo 'error';

}else{

$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$idproducto = $_POST['idproducto'];
$token = $_POST['token'];

$query_detalle_temp = mysqli_query($con,"CALL add_detalleventa_temp($idproducto, $cantidad, $token, $sucursal, $precio)");
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
$precioTotal = round($data['cantidad'] * $data['precio_venta'],2);
$sub_total = round($sub_total + $precioTotal,2);
$total = round($total + $precioTotal,2);

$detalleTabla .= '

<tr>
<td  colspan="4" class="text-center">'.$data['iddetalleventa_tmp'].'</td >
            <td  colspan="4" class="text-center">'.$data['nombre'].'</td >
            <td  colspan="4" class="text-center">'.$data['descripcion'].'</td >
            <td  colspan="4" class="text-center">'.$data['presentacion'].'</td >
            <td  colspan="4" class="text-center">'.$data['marca'].'</td >
            <td  class="text-center">'.$data['cantidad'].'</td >
            <td   class="text-center">'.$data['precio_venta'].'</td >
            <td  width="75px" class="text-center">'.$precioTotal.'</td >
          

<td class="text-center">
    <a class="link_delete" href="#" onclick="event.preventDefault(); 
    del_product_detalle('.$data['iddetalleventa_tmp'].');"><i class="fa fa-trash-alt"> Borrar</i></a>
    
    </td>

</tr>
';


}




$detalle_totales .= '
<tr>
            <td colspan="4" class="text-center"> Total Q.</td>
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

// Estrae datos del datalle_temp
if ($_POST['action'] == 'serchForDetalle') {

    if (empty($_POST['user']) ) {
        # code...
    echo 'error';
    
    }else{
   
    $token = $_POST['user'];
    
    $query= mysqli_query($con,"     SELECT tmp.iddetalleventa_tmp, tmp.producto_idproducto,producto.sku, 
    producto.nombre,producto.descripcion,producto.presentacion,
    producto.marca,tmp.cantidad,tmp.precio_venta from 
    detalleventa_tmp tmp inner join producto  on tmp.producto_idproducto = producto.id
    WHERE tmp.token_user  = $token ");
    $result = mysqli_num_rows($query);
    
    
    $detalleTabla = '';
    $detalle_totales = '';
    $sub_total = 0;
    $total = 0;
    $arrayData = array();
    
    if ($result > 0) {
        # code...
    
    while ($data = mysqli_fetch_assoc($query)) {$precioTotal = round($data['cantidad'] * $data['precio_venta'],2);
        $sub_total = round($sub_total + $precioTotal,2);
        $total = round($total + $precioTotal,2);
        
        $detalleTabla .= '
        
        <tr>
        <td  colspan="4" class="text-center">'.$data['iddetalleventa_tmp'].'</td >
                    <td  colspan="4" class="text-center">'.$data['nombre'].'</td >
                    <td  colspan="4" class="text-center">'.$data['descripcion'].'</td >
                    <td  colspan="4" class="text-center">'.$data['presentacion'].'</td >
                    <td  colspan="4" class="text-center">'.$data['marca'].'</td >
                    <td  class="text-center">'.$data['cantidad'].'</td >
                    <td   class="text-center">'.'Q. '. number_format($data['precio_venta'],2,".",",").'</td >
                    <td  width="75px" class="text-center">'.'Q. '. number_format($precioTotal,2,".",",").'</td >
                  
        
        <td class="text-center">
            <a class="link_delete" href="#" onclick="event.preventDefault(); 
            del_product_detalle('.$data['iddetalleventa_tmp'].');"><i class="fa fa-trash-alt"> Borrar</i></a>
            
            </td>
        
        </tr>
        ';
        
        
        }
        
        
        
        
        $detalle_totales .= '
        <tr>
                    <th colspan="23" class="text-center">'.'Total Q. '. number_format($total,2,".",",").'</th>
                  
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
//Eliminar detalle de compra

if ($_POST['action'] == 'del_product_detalle') {

    if (empty($_POST['id_detalle']) ) {
        # code...
    echo 'error';
    
    }else{
    $id_detalle = $_POST['id_detalle'];
    $token = $_POST['token'];

    
    $query= mysqli_query($con,"CALL del_detalleventa_temp ($id_detalle, $token) ");
    $result = mysqli_num_rows($query);
    
    
    $detalleTabla = '';
    $detalle_totales = '';
    $sub_total = 0;
    $total = 0;
    $arrayData = array();
    
    if ($result > 0) {
        # code...
    
    
        while ($data = mysqli_fetch_assoc($query)) {$precioTotal = round($data['cantidad'] * $data['precio_venta'],2);
            $sub_total = round($sub_total + $precioTotal,2);
            $total = round($total + $precioTotal,2);
            
            $detalleTabla .= '
            
            <tr>
            <td  colspan="4" class="text-center">'.$data['iddetalleventa_tmp'].'</td >
                        <td  colspan="4" class="text-center">'.$data['nombre'].'</td >
                        <td  colspan="4" class="text-center">'.$data['descripcion'].'</td >
                        <td  colspan="4" class="text-center">'.$data['presentacion'].'</td >
                        <td  colspan="4" class="text-center">'.$data['marca'].'</td >
                        <td  class="text-center">'.$data['cantidad'].'</td >
                        <td   class="text-center">'.'Q. '. number_format($data['precio_venta'],2,".",",").'</td >
                        <td  width="75px" class="text-center">'.'Q. '. number_format($precioTotal,2,".",",").'</td >
                      
            
            <td class="text-center">
                <a class="link_delete" href="#" onclick="event.preventDefault(); 
                del_product_detalle('.$data['iddetalleventa_tmp'].');"><i class="fa fa-trash-alt"> Borrar</i></a>
                
                </td>
            
            </tr>
            ';
            
            
            }
            
            
            
            
            $detalle_totales .= '
            <tr>
                        <th colspan="23" class="text-center">'.'Total Q. '. number_format($total,2,".",",").'</th>
                      
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



// Anuar Venta

if($_POST['action'] == 'anularVenta'){
    $token = $_POST['token'];
$query_del = mysqli_query($con, "DELETE FROM detalleventa_tmp WHERE token_user = $token");
mysqli_close($con);
if ($query_del) {
    # code...
    echo 'OK';
}else{

    echo 'Error no se pudo procesar';
}
}



// Procesar Venta
if($_POST['action'] == 'procesarVenta'){

    if (empty($_POST['codcliente']) ||  empty($_POST['codvendedor'])  ) {

        echo 'error primero';
    }

  
    


    else{



    
        $token = $_POST['codvendedor'];
    
    
              $query = mysqli_query($con,"SELECT * FROM detalleventa_tmp WHERE token_user = $token ");
        $result = mysqli_num_rows($query);

        if ($result > 0) {
            # code...
          

            
        $codcliente = $_POST['codcliente'];
        $nfactura = "0";
      
            $query_procesar = mysqli_query($con,"CALL venta($codcliente,$token,'$nfactura',$sucursal)");
            $result_detalle = mysqli_num_rows($query_procesar);

if($result_detalle ){
$data = mysqli_fetch_assoc($query_procesar);
echo json_encode($data, JSON_UNESCAPED_UNICODE);


}else
{
    echo 'error segundo ';
}


        }else{
            echo 'error tercero';
        }
mysqli_close($con);
exit;

    }



}








}
exit ;
?>