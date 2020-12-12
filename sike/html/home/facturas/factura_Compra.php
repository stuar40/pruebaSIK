<?php

//print_r($_REQUEST);
//exit;
//echo base64_encode('2');
//exit;
//	session_start();
//	if(empty($_SESSION['active']))
//	{
//		header('location: ../');
//	}

include("../config/db.php");
include("../config/conexion.php");
require_once '../pdf/vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_REQUEST['prov']) || empty($_REQUEST['f'])) {
	echo "No es posible generar la factura.";
} else {
	$codProveedor = $_REQUEST['prov'];
	$noFactura = $_REQUEST['f'];
	$anulada = '';

//	$query_config   = mysqli_query($conection, "SELECT * FROM configuracion");
//	$result_config  = mysqli_num_rows($query_config);
//	if ($result_config > 0) {
//		$configuracion = mysqli_fetch_assoc($query_config);
//	}


	$query = mysqli_query($con, "SELECT encabezado_compra.id as compra, encabezado_compra.factura as factura,encabezado_compra.status as estatus, 
	encabezado_compra.fecha as fecha, usuarios.nombre_usuario as usuario,
	 empresa.nombre as proovedor, empresa.nit as nit, empresa.telefono as telempresa,
	   empresa.direccion ,asesor.nombre as Asesor 
   FROM encabezado_compra inner join usuarios on usuarios.id = encabezado_compra.usuarios_idusuarios
   inner join empresa on empresa.id = encabezado_compra.proveedor_idproveedor
   inner join asesor ON asesor.empresa_id = empresa.id 
   where encabezado_compra.id = $noFactura     AND empresa.id = $codProveedor  ");

	$result = mysqli_num_rows($query);
	if ($result > 0) {

		$factura = mysqli_fetch_assoc($query);
		$no_factura = $factura['factura'];
		$adquisicion = $factura['compra'];

		if ($factura['estatus'] == 2) {
			$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
		}

		$query_productos = mysqli_query($con, "SELECT encabezado_compra.totalcompra as totalcompra,encabezado_compra.id as id, CONCAT(producto.nombre,' ',producto.descripcion) as insumo,producto.presentacion, producto.marca,
		detallecompra.cantidad as cantidad, detallecompra.precio_compra as precio,		(detallecompra.cantidad * detallecompra.precio_compra ) as total
	   FROM encabezado_compra inner join detallecompra on detallecompra.encabezado_compra_id = encabezado_compra.id
	   inner join producto on producto.id = detallecompra.producto_idproducto 
	   where encabezado_compra.id = $adquisicion ");
		$result_detalle = mysqli_num_rows($query_productos);

		ob_start();
		include(dirname('__FILE__') . '/factura.php');
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('letter', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
	
		$dompdf->stream('factura_' . $no_factura . '.pdf', array('Attachment' => 0));
		exit;
	}
}
