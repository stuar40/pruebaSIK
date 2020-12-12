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

if (empty($_REQUEST['bol']) || empty($_REQUEST['su'])) {
	echo "No es posible generar la factura.";
} else {
	$bol= $_REQUEST['bol'];
	$sucursal = $_REQUEST['su'];
	$anulada = '';

//	$query_config   = mysqli_query($conection, "SELECT * FROM configuracion");
//	$result_config  = mysqli_num_rows($query_config);
//	if ($result_config > 0) {
//		$configuracion = mysqli_fetch_assoc($query_config);
//	}


	$query = mysqli_query($con, "SELECT boleta.idboleta,boleta.salida, CONCAT (empleados.nom1, ' ',empleados.apellido1) AS repartidor,
	CONCAT (sucursal.numero,' ',ubicacion.nombre) AS destino, empleados.telefono
	 FROM boleta
	INNER JOIN empleados ON boleta.repartidor = empleados.idempleados
	INNER JOIN sucursal ON sucursal.idsucursal = boleta.sucursal_idsucursal
	INNER JOIN ubicacion ON sucursal.ubicacion_idubicacion = ubicacion.idubicacion
	WHERE boleta.idboleta= $bol ");

	$result = mysqli_num_rows($query);
	if ($result > 0) {

		$boleta = mysqli_fetch_assoc($query);
		$no_boleta= $boleta['idboleta'];
		$fecha = $boleta['salida'];
		$repartidor =$boleta['repartidor'];
		$destino =$boleta['destino'];
		$telefono =$boleta['telefono'];
		$query_productos = mysqli_query($con, "SELECT producto.codigo,producto.descripcion,traslado.cantidad FROM traslado
		INNER JOIN producto ON traslado.producto_idproducto = producto.idproducto
		WHERE traslado.boleta_idboleta = $bol ");
		$result_detalle = mysqli_num_rows($query_productos);

		ob_start();
		include(dirname('__FILE__') . '/traslado.php');
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('letter', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
	
		$dompdf->stream('traslado_' . $no_boleta. '.pdf', array('Attachment' => 0));
		exit;
	}
}
