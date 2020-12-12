<?php 
$conexion=mysqli_connect('tomodachi.digital','admin_protec','Protec2k20!','protec_db');
$continente=$_POST['continente'];

	$sql="SELECT * FROM subcategoria WHERE categoria_id = '$continente'";

	$result=mysqli_query($conexion,$sql);

    $cadena="    <label class='h6 small d-block text-uppercase'>
    Sub-Categoria
    <span class='text-danger'>*</span>
    




    
			<select  class='form-control input-sm' id='subcategoria' name='subcategoria'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select>";
	

?>