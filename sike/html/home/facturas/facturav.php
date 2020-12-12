<?php
	$subtotal 	= 0;
	$iva 	 	= 0;
	$impuesto 	= 0;
	$tl_sniva   = 0;
	$total 		= 0;
// print_r($query_productos); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php echo $anulada; ?>
<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="../../img/logosikes.png">
				</div>
			</td>
			<td class="info_empresa">
				
				<div>
					<span class="h2"></span>
					<p></p>
					<p></p>
					<p>NIT:</p>
					<p>Teléfono: </p>
			        <p>Email: </p> 
				</div>
				<?php
					
				 ?>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Factura</span>
					<p>No. Factura: <strong><?php echo $factura['numfactura']; ?></strong></p>
					<p>Fecha: <?php echo $factura['fecha']; ?></p>
				
					<p>Empleado: <?php echo $factura['nombre_usuario']; ?></p>
					<p>Total Factura: <?php echo 'Q. '. number_format( $factura['totalfactura'],2,".",",") ?> </p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Nit:</label> <p><?php echo $factura['nit']; ?></p></td>
			
						</tr>
						<tr>
							<td><label>Cliente:</label> <p><?php echo $factura['nombre']; ?></p></td>
							<td><label>Dirección:</label> <p><?php echo $factura['direccion']; ?></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
			<th  width="25px"  class="text-center">#</th>
		    <th class="text-center">Codigo</th>
			<th class="text-center">Nombre</th>
            <th width="100px" class="text-center">Descripcion</th>
            <th width="100px" class="text-center">Presentacion</th>
            <th width="100px" class="text-center">Marca</th>
            <th class="text-center">Cantidad</th>
            <th  class="text-center" width="100px">Precio</th>
            <th  class="text-center">SubTotal</th>
            
				</tr>
			</thead>
			<tbody id="detalle_productos">

			<?php

				if($result_detalle > 0){

					while ($row = mysqli_fetch_assoc($query_productos)){
					
						$precio = $row['precio'];
				$cantidad = $row['cantidad'];
			$total = ($precio*$cantidad);

			 ?>
				<tr>
				
					<td  width="25px" class="text-center">1</td >
                    <td  class="text-center"><?php echo $row['sku']; ?></td >
                    <td  class="text-center"><?php echo $row['nombre']; ?></td >
                    <td class="text-center"><?php echo $row['descripcion']; ?></td >
					<td  class="text-center"><?php echo $row['presentacion']; ?></td >
					<td  class="text-center"><?php echo $row['marca']; ?></td >
					<td  class="text-center"><?php echo $row['cantidad']; ?></td >
                    <td  class="text-center"><?php echo 'Q. '. number_format($row['precio'],2,".",",") ?></td >
                  
                    <td  width="75px" class="text-center"><?php echo 'Q. '. number_format($total,2,".",",") ?></td >
				</tr>
			<?php
						
					}
				}
				
			
			?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>.</span></td>
					<td class="textright"><span></span></td>
				</tr>
				<tr>
					<td colspan="5" class="textright"><span>TOTAL  <?php echo 'Q. '. number_format( $factura['totalfactura'],2,".",",") ?> </span></td>
					<td class="textright"><span></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span></span></td>
					<td class="textright"><span></span></td>
				</tr>
		</tfoot>
	</table>

	<div>
	<!-- 
		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
	-->
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>


</div>

</body>
</html>