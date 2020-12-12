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
					<p>Teléfono: 79471494 </p>
			        <p>Email: </p> 
				</div>
				<?php
					
				 ?>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Factura</span>
					<p>No. Factura: <strong><?php echo $factura['factura']; ?></strong></p>
					<p>Fecha: <?php echo $factura['fecha']; ?></p>
				
					<p>Empleado: <?php echo $factura['usuario']; ?></p>
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
							<td><label>Nit:</label> <p><?php echo $factura['factura']; ?></p></td>
							<td><label>Teléfono:</label> <p> <?php echo $factura['telempresa']; ?></p></td>
						</tr>
						<tr>
							<td><label>Empresa:</label> <p><?php echo $factura['proovedor']; ?></p></td>
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
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textleft">Presentacion</th>
					<th class="textleft">Marca</th>
					<th class="textcenter" width="150px">Precio Unitario.</th>
					<th class="textcenter" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

			<?php

				if($result_detalle > 0){

					while ($row = mysqli_fetch_assoc($query_productos)){
					
					$totalfinal= $row['totalcompra'];
			 ?>
				<tr>
					<td class="textcenter"><?php echo $row['cantidad']; ?></td>
					<td  ><?php echo $row['insumo']; ?></td>
					<td><?php echo $row['presentacion']; ?></td>
					<td><?php echo $row['marca']; ?></td>
					<td class="textcenter" width="150px"><?php echo $row['precio']; ?></td>
					<td class="textcenter" width="150px"><?php echo $row['total']; ?></td>
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
					<td colspan="3" class="textright"><span>TOTAL Q. <?php echo $totalfinal;?> </span></td>
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