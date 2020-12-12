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
	$codEmpleado = $_REQUEST['empleado'];
	$noFactura = $_REQUEST['ef'];
	$anulada = '';

//	$query_config   = mysqli_query($conection, "SELECT * FROM configuracion");
//	$result_config  = mysqli_num_rows($query_config);
//	if ($result_config > 0) {
//		$configuracion = mysqli_fetch_assoc($query_config);
//	}


	$query = mysqli_query($con, " SELECT e.id AS idencabezado,e.numfactura,e.fecha,e.totalfactura,e.estatus,u.direccion,u.nombre_usuario,
	CONCAT(s.numero, ' ',em.nombre) AS sucursal,
    CONCAT(c.nombre,' ',c.apellido) AS nombre,c.nit
    FROM encabezado_venta e 
    INNER JOIN usuarios u ON e.usuarios_idusuarios = u.id
    INNER JOIN sucursal s ON s.id = e.sucursal_idsucursal
    INNER JOIN clientes c ON c.id = e.clientes_id
    INNER JOIN empresa em ON  em.id = s.datos_empresa_id1
    WHERE e.usuarios_idusuarios =  $codEmpleado AND e.id = $noFactura ORDER BY e.id DESC LIMIT 1 ");

	$result = mysqli_num_rows($query);
	if ($result > 0) {

		$factura = mysqli_fetch_assoc($query);
		$no_factura = $factura['idencabezado'];
	

		if ($factura['estatus'] == 2) {
			$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
		}

		$query_productos = mysqli_query($con, "     SELECT p.sku,p.nombre,p.descripcion,p.presentacion,p.marca,d.cantidad,d.precio
		FROM encabezado_venta e INNER JOIN detalleventa d ON d.encabezado_venta_id = e.id
		INNER JOIN producto p ON p.id = d.producto_idproducto
		WHERE e.id = $no_factura ");
        $result_detalle = mysqli_num_rows($query_productos);



;

		ob_start();
		include(dirname('__FILE__') . '/facturav.php');
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
