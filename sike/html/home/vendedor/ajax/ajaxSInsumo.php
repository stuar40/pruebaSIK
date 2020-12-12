<?php
if (isset($_GET['term'])){
    session_start();
include("../../config/db.php");
include("../../config/conexion.php");
$dato =$_GET['term'];
$return_arr = array();
$sucursal = $_SESSION['sucursal_id'];
/* If connection to database, run sql statement. */
if ($con)
{
	
	$fetch = mysqli_query($con,"     SELECT producto.id as idproducto,producto.sku,producto.nombre,producto.descripcion,producto.presentacion,producto.marca,
    precios.existencia,precios.estado,precios.precio_venta,precios.precio_minimo,precios.precio_promocion,sucursal.id as idsucursal,sucursal.numero
    FROM producto INNER JOIN precios ON precios.producto_idproducto = producto.id
   INNER JOIN sucursal ON sucursal.id = precios.sucursal_idsucursal
    HAVING producto.nombre  LIKE '%$dato%' AND sucursal.id = $sucursal "); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$id_cliente=$row['idproducto'];
		$row_array['value'] = $row['nombre'] .' '. $row['descripcion'].' '. $row['presentacion'].' '. $row['marca']  ;
		$row_array['idproducto']=$id_cliente;
		$row_array['nombre']=$row['nombre'] .' '. $row['descripcion'].' '. $row['presentacion'].' '. $row['marca']   ;
        $row_array['existencia']=$row['existencia'];
        $row_array['idproducto']=$row['idproducto'];
        $row_array['precio_venta']=$row['precio_venta'];
        $row_array['precio_promocion']=$row['precio_promocion'];
        $row_array['precio_minimo']=$row['precio_minimo'];
		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>