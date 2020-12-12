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

if (empty($_REQUEST['empleado']) || empty($_REQUEST['ef'])) {
	echo "No es posible generar la factura.";
} else {
	$codempleado = $_REQUEST['empleado'];
	$nodespacho = $_REQUEST['ef'];
	$anulada = '';

//	$query_config   = mysqli_query($conection, "SELECT * FROM configuracion");
//	$result_config  = mysqli_num_rows($query_config);
//	if ($result_config > 0) {
//		$configuracion = mysqli_fetch_assoc($query_config);
//	}


$query_panadero = mysqli_query($con, "SELECT despacho.iddespacho, despacho.fecha, despacho.panadero,concat(empleados.nom1, ' ',empleados.nom2, ' ',empleados.apellido1, ' ',
empleados.apellido2 ) as panadero, CONCAT(sucursal.numero,' ',ubicacion.nombre) sucursal FROM despacho 
INNER JOIN empleados ON despacho.panadero= empleados.idempleados
INNER JOIN sucursal ON sucursal.idsucursal = despacho.sucursal_idsucursal
INNER JOIN ubicacion ON ubicacion.idubicacion = sucursal.ubicacion_idubicacion
where despacho.iddespacho = 	'$nodespacho' ");

$resultp = mysqli_num_rows($query_panadero);
if ($resultp > 0) {

	$panadero= mysqli_fetch_assoc( $query_panadero);
	$panaderos = $panadero['panadero'];

}



	$query = mysqli_query($con, "  SELECT despacho.iddespacho, despacho.fecha,empleados.usuario FROM despacho INNER JOIN empleados
	ON despacho.empleado_idempleado = empleados.idempleados where despacho.iddespacho = '$nodespacho'  ");

	$result = mysqli_num_rows($query);
	if ($result > 0) {

		$bodega = mysqli_fetch_assoc($query);
	

	

	

	//	if ($bodega['estatus'] == 2) {
	//		$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
	//	}

	$query_productos = mysqli_query($con, "SELECT CONCAT(insumos.nombre,' ',medidas.medidal) insumo, detalle_despacho.cantidad FROM despacho 
	INNER JOIN detalle_despacho ON detalle_despacho.despacho_iddespacho = despacho.iddespacho
	INNER JOIN insumos ON insumos.idinsumos = detalle_despacho.insumos_idinsumos
	INNER JOIN medidas ON  insumos.medidas_idmedidas = medidas.idmedidas
	WHERE despacho.iddespacho = '$nodespacho' ");
		$result_detalle = mysqli_num_rows($query_productos);

		ob_start();
		include(dirname('__FILE__') . '/pdfdespacho.php');
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('letter', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
	
		$dompdf->stream('Despacho_.pdf', array('Attachment' => 0));
		exit;
	}
}
