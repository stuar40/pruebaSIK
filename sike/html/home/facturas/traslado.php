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
	<title>Boleta de Envio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php echo $anulada; ?>
<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="img/imagenglobo.png">
				</div>
			</td>
			<td class="info_empresa">
				
				<div>
					<span class="h2"></span>
					<p></p>
					<p></p>
					<p></p>
					<p></p>
			        <p></p> 
				</div>
				<?php
					
				 ?>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Boleta de envio</span>
					<p>No.Boleta: <strong><?php echo $no_boleta?> </strong></p>
					<p>Fecha: <?php echo $fecha?></p>
				
					<p>Repartidor: <?php echo $repartidor?> </p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">DATOS DEL TRASLADO:</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Sucursal Destino:</label> <p><?php echo $destino ?> </p></td>
							<td><label>Teléfono Repartidor:</label> <p><?php echo $telefono ?></p></td>
						</tr>
						<tr>
							<td><label></label> <p></p></td>
							<td><label></label> <p></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					<th class="textcenter"width="100px">CODIGO.</th>
					<th class="textcenter" width="500px">DESCRIPCIÓN</th>
					<th class="textcenter" width="100px">CANTIDAD</th>

				</tr>
			</thead>
			<tbody id="detalle_productos">

			<?php

				if($result_detalle > 0){

					while ($row = mysqli_fetch_assoc($query_productos)){
					
					$cantidad= $row['cantidad'];
					$total = $cantidad + $total;
			 ?>
				<tr>
					<td class="textcenter" width="100px">  <?php echo $row['codigo']; ?></td>
					<td width="500px"> <?php echo $row['descripcion']; ?></td>
					<td class="textcenter" width="100px"> <?php echo $row['cantidad']; ?></td>
				
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
					<td colspan="3" class="textcenter"><span>TOTAL: <?php echo $total?></span></td>
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
		<h4 class="label_gracias"></h4>
		<footer>
<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
				<br>
					<table >
						<tr>
						<td width="100px"class="textcenter"><label></label> <p> </p></td>
							<td width="100px"class="textcenter"><label>f._________________________________________</label> <p> </p></td>
							<td width="100px"class="textcenter"><label></label> <p> </p></td>
							<td width="100px" class="textcenter"><label>f._________________________________________</label> <p></p></td>
						</tr>
						<tr>
						    <td colspan="1"  class="textcenter"><label></label> <p></p></td>
							<td colspan="1"  class="textcenter"><label>Firma del panadero</label> <p></p></td>
							<td colspan="1"  class="textcenter"><label></label> <p></p></td>
							<td colspan="1"  class="textcenter"><label>Firma de receptor</label> <p></p></td>
						</tr>
						
					</table>
					<br>
					<div class="round"  >
<p>_________________________________________________________________________________________________________________________</p>

<p>__________________________________________________________________________________________________________________________</p>
<p>__________________________________________________________________________________________________________________________</p>

</div>
				</div>
			</td>

		</tr>
	</table>
</footer>
	</div>


</div>


</body>

</html>