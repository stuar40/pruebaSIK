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
	<title>Despacho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

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
				
					<p>Teléfono: 79471494 </p>
			 
				</div>
				<?php
					
				 ?>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Despacho</span>
					<p>No.  <strong><?php echo $bodega['iddespacho'];?></strong></p>
					<p>Fecha: <?php echo $bodega['fecha']; ?></p>
				
					<p>Empleado: <?php echo $bodega['usuario'];?></p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Datos del Panadero</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Panadero:</label> <?php echo $panadero['panadero'];?></td>
							<td><label>Sucursal:</label><p><?php echo $panadero['sucursal']; ?></p></td>
						</tr>
					
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					<th class="textcenter" width="50px">#</th>
					<th class="textleft">Descripción</th>
					<th class="textcenter" width="150px">Cantidad</th>
					<th class="textright" width="150px"> </th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

<?php

	if($result_detalle > 0){
$i =0;
		while ($row = mysqli_fetch_assoc($query_productos)){
	$i++;	
	
 ?>
	<tr>
		<td class="textcenter"><?php echo $i?></td>
		<td><?php echo $row['insumo']; ?></td>
		<td class="textcenter" ><?php echo $row['cantidad']; ?></td>
		<td class="textright"><?php  ?></td>
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
					<td colspan="3" class="textright"><span><?php ?> </span></td>
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
	</div>


</div>

</body>
</html>