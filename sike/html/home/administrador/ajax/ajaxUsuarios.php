<?php 

if ($_POST) {
    # code...

include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = "";

if ($_POST['action'] == 'SearchContact') {
    # code...
if (!empty($_POST['id'])) {
    # code...
    $arrContact = array();
$intId = intval($_POST['id']);
$query_select = mysqli_query($con,"SELECT * FROM producto WHERE idproducto = $intId");
$num_rows = mysqli_num_rows($query_select);
if ($num_rows > 0) {
    # code...
    $arrContact = mysqli_fetch_assoc($query_select);
   
     echo  json_encode($arrContact, JSON_UNESCAPED_UNICODE);
 
}else{
echo "NOENCONTRADO";

}
exit;

}


}


// Buscar input
if ($_POST['action'] == 'searchContactKey') {
    # code...
    $searchData = $_POST['dataSearch'];
    $searchData3 = $_POST['dataSearch3'];

    $query_select = mysqli_query($con,"SELECT usuarios.id, usuarios.pnom,usuarios.snom,usuarios.pape,usuarios.sape,
    usuarios.nombre_usuario,usuarios.telefono,usuarios.direccion,usuarios.dpi,usuarios.estado,roles.nombre as rol,horarios.tipo,sucursal.numero
     FROM usuarios
     INNER JOIN roles ON roles.id = usuarios.roles_id
     INNER JOIN horarios ON horarios.id = usuarios.horarios_id
     INNER JOIN sucursal ON sucursal.id = usuarios.sucursal_id 
   WHERE 
    usuarios.nombre_usuario LIKE '%$searchData%' OR usuarios.dpi 
    LIKE '%$searchData%' OR usuarios.pnom LIKE '%$searchData%'   ");

    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
        # code...
        $htmlTable = '';
        while ($row = mysqli_fetch_assoc($query_select)) {

            # code...
            $htmlTable .= '<tr" >
            <th class="text text-monospace">'.$row['pnom'].' '.$row['snom'].' '.$row['pape'].' '.$row['sape'].'</th>
            <th class="text text-monospace" >'.$row['nombre_usuario'].'</th>
            <th class="text text-monospace">'.$row['telefono'].'</th>
            <th class="text text-monospace" >'.$row['direccion'].' </th>
            <th class="text text-monospace" >'.$row['dpi'].'</th>
            <th class="text text-monospace">'.$row['estado'].'</th>
            <th class="text text-monospace">'.$row['rol'].'</th>
            <th class="text text-monospace">'.$row['tipo'].'</th>
            <th class="text text-monospace">'.$row['numero'].'</th>

            <td><a href="#" onclick="obtener_datos('.$row['id'].' );" data-toggle="modal" data-target="#Modal_Edit_Usuario"
             class="btn btn-success btn-xs"> <i class="fa fa-edit"></i> </td>

      		<td><a href="#" onclick="estado('.$row['id'].' );" class="btn btn-warning btn-xs"><i class="fa fa-adjust"></i></a></td>
	  	
            </tr> '; 
        }
    
        echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
    }else{
        
        echo "notData";
    }
    exit;
}




// Buscar input for sucursal
if ($_POST['action'] == 'searchSucural') {
    # code...
    $searchData2 = $_POST['dataSearch2'];

    $query_select = mysqli_query($con,"SELECT usuarios.id, usuarios.pnom,usuarios.snom,usuarios.pape,usuarios.sape,
    usuarios.nombre_usuario,usuarios.telefono,usuarios.direccion,usuarios.dpi,usuarios.estado,roles.nombre as rol,horarios.tipo,sucursal.numero
     FROM usuarios
     INNER JOIN roles ON roles.id = usuarios.roles_id
     INNER JOIN horarios ON horarios.id = usuarios.horarios_id
     INNER JOIN sucursal ON sucursal.id = usuarios.sucursal_id 
   WHERE 
    sucursal.numero LIKE '%$searchData2%'   ");

    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
        # code...
        $htmlTable = '';
        while ($row = mysqli_fetch_assoc($query_select)) {

            # code...
            $htmlTable .= '<tr" >
            <th class="text text-monospace">'.$row['pnom'].' '.$row['snom'].' '.$row['pape'].' '.$row['sape'].'</th>
            <th class="text text-monospace" >'.$row['nombre_usuario'].'</th>
            <th class="text text-monospace">'.$row['telefono'].'</th>
            <th class="text text-monospace" >'.$row['direccion'].' </th>
            <th class="text text-monospace" >'.$row['dpi'].'</th>
            <th class="text text-monospace">'.$row['estado'].'</th>
            <th class="text text-monospace">'.$row['rol'].'</th>
            <th class="text text-monospace">'.$row['tipo'].'</th>
            <th class="text text-monospace">'.$row['numero'].'</th>

            <td><a href="#" onclick="obtener_datos('.$row['id'].' );" data-toggle="modal" data-target="#Modal_Edit_Usuario"
             class="btn btn-success btn-xs"> <i class="fa fa-edit"></i> </td>

      		<td><a href="#" onclick="estado('.$row['id'].' );" class="btn btn-warning btn-xs"><i class="fa fa-adjust"></i></a></td>
	  	
            </tr> '; 
        }
    
        echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
    }else{
        
        echo "notData";
    }
    exit;
}









//listar
if ($_POST['action'] == 'listUsuarios') {
    # code...


    $query_select = mysqli_query($con,"SELECT usuarios.id, usuarios.pnom,usuarios.snom,usuarios.pape,usuarios.sape,
    usuarios.nombre_usuario,usuarios.telefono,usuarios.direccion,usuarios.dpi,usuarios.estado,roles.nombre as rol,horarios.tipo,sucursal.numero
     FROM usuarios
     INNER JOIN roles ON roles.id = usuarios.roles_id
     INNER JOIN horarios ON horarios.id = usuarios.horarios_id
     INNER JOIN sucursal ON sucursal.id = usuarios.sucursal_id  ORDER BY usuarios.id desc");

    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
        # code...
        $htmlTable = '';
        while ($row = mysqli_fetch_assoc($query_select)) {

            # code...
            $htmlTable .= '<tr" >
            <th class="text text-monospace">'.$row['pnom'].' '.$row['snom'].' '.$row['pape'].' '.$row['sape'].'</th>
            <th class="text text-monospace" >'.$row['nombre_usuario'].'</th>
            <th class="text text-monospace">'.$row['telefono'].'</th>
            <th class="text text-monospace" >'.$row['direccion'].' </th>
            <th class="text text-monospace" >'.$row['dpi'].'</th>
            <th class="text text-monospace">'.$row['estado'].'</th>
            <th class="text text-monospace">'.$row['rol'].'</th>
            <th class="text text-monospace">'.$row['tipo'].'</th>
            <th class="text text-monospace">'.$row['numero'].'</th>

            <td><a href="#" onclick="obtener_datos('.$row['id'].' );" data-toggle="modal" data-target="#Modal_Edit_Usuario"
             class="btn btn-success btn-xs"> <i class="fa fa-edit"></i> </td>

      		<td><a href="#" onclick="estado('.$row['id'].' );" class="btn btn-warning btn-xs"><i class="fa fa-adjust"></i></a></td>
	  	
            </tr> ';
        }
    
        echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
    }else{
        
        echo "notData";
    }
    exit;
}

//Guardar Usuarios

if (isset($_POST['action']) == 'agregar_usuario' AND !empty($_POST['intencion'])) {
    # code...
  

      $dpi = "";                              
    $n1=$_POST['pnombre'];
    $n2 =$_POST['snombre'];
    $n3=$_POST['papellido'];
    $n4 =$_POST['sapellido'];
    $n5=$_POST['fecha'];
    $n6 =$_POST['usuario'];
    $n7=$_POST['telefono'];
    $n8=$_POST['dir'];
    $n9 =$_POST['cui'];
    $n10=$_POST['pass'];
    $n11=$_POST['email'];
    $n12=$_POST['estad'];
    $n13 =$_POST['rol'];
    $n14=$_POST['hora'];
    $n15=$_POST['sids'];

    $sqldpi= "SELECT dpi FROM usuarios where dpi = $n9";
    $res1=mysqli_query($con,$sqldpi);
        while ($data=mysqli_fetch_row($res1))
                                    {
$dpi = $data[0];
                                    }
    
if ($dpi > 0) {
    echo 'replica';
}
else{

    $sql="INSERT INTO `sike`.`usuarios` (`pnom`, `snom`, `pape`, `sape`, `nacimiento`, `nombre_usuario`,
     `telefono`, `direccion`, `dpi`, `password`, `correo`, `estado`, `roles_id`, `horarios_id`, `sucursal_id`) 
    VALUES ('$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8','$n9','$n10','$n11','$n12','$n13','$n14','$n15')";
    $res=mysqli_query($con,$sql);
    if($res){
       echo 'successful';

    }else{
        die("Error".mysqli_error($con));
    }
}
exit;
}

// Obtener datos
if (isset($_POST['action']) == 'obtener_datos' ) {
    # code...
    if (!empty($_POST['id_empleado'])) {
        # code...

    
        $arrUsuario = array();
    $intId = intval($_POST['id_empleado']);

    $query_select = mysqli_query($con," SELECT usuarios.id, usuarios.pnom,usuarios.snom,usuarios.pape,usuarios.sape,
    usuarios.nacimiento,usuarios.nombre_usuario,usuarios.telefono,usuarios.direccion,
    usuarios.dpi,usuarios.password,usuarios.correo,usuarios.estado,usuarios.roles_id,usuarios.horarios_id,usuarios.sucursal_id,
    roles.nombre,horarios.tipo,concat(sucursal.numero, ' ', sucursal.direccion) as sucursaln
    FROM usuarios
     INNER JOIN roles ON roles.id = usuarios.roles_id
    INNER JOIN horarios ON horarios.id = usuarios.horarios_id
     INNER JOIN sucursal ON sucursal.id = usuarios.sucursal_id
      WHERE usuarios.id = $intId");
    $num_rows = mysqli_num_rows($query_select);
    if ($num_rows > 0) {
        # code...
        $arrUsuario = mysqli_fetch_assoc($query_select);
       
         echo  json_encode($arrUsuario, JSON_UNESCAPED_UNICODE);
    
    }else{
    echo "error";
    
    }
    exit;
    
    }


}




  



    // Cambiar estado al usuario
if (isset($_POST['action']) == 'situacion') {
    # code...
    if (!empty($_POST['id'])) {
    $n0=$_POST['id'];

	$sqlestado= "SELECT estado FROM usuarios where id = $n0";
		$res1=mysqli_query($con,$sqlestado);
			while ($data=mysqli_fetch_row($res1))
										{
$estado = $data[0];

                                        }

if ($estado == 'ACTIVO') {
    # code...
    $sql = " UPDATE usuarios SET `estado`= 'INACTIVO'
    WHERE (`id` = '$n0')";

$res=mysqli_query($con,$sql);
    if($res){
        echo 'Realizado';

    }else{
        die("Error".mysqli_error($con));
    }
}elseif ($estado == 'INACTIVO') {
    # code...
    $sql = " UPDATE usuarios SET `estado`= 'ACTIVO'
    WHERE (`id` = '$n0')";

$res=mysqli_query($con,$sql);
    if($res){
      echo 'Realizado';
    }else{
        die("Error".mysqli_error($con));
    }
}







}


}
// Editar Editar Usuarios
if(isset($_POST['action']) == 'editar_usuario'  AND !empty($_POST['id_usu'])){


    $n0 = $_POST['id_usu'];
    $n1=$_POST['pnombre2'];
    $n2 =$_POST['snombre2'];
    $n3=$_POST['papellido2'];
    $n4 =$_POST['sapellido2'];
    $n5 =$_POST['fecha2'];
    $n6=$_POST['usuario2'];
    $n7=$_POST['telefono2'];
    $n8 =$_POST['dir2'];
    $n9=$_POST['cui2'];
    $n10=$_POST['pass2'];
    $n11=$_POST['email2'];
    $n12=$_POST['estad2'];
    $n13=$_POST['rol2'];
    $n14=$_POST['hora2'];
    $n15=$_POST['sids2'];
 
    # code...
  $sql = " UPDATE `sike`.`usuarios` SET `pnom` = '$n1', `snom` = '$n2', `pape` = '$n3', 
    `sape` = '$n4' ,`nacimiento`='$n5',`nombre_usuario`='$n6',`telefono`='$n7',`direccion`='$n8',`dpi`='$n9',`password`='$n10',
    `correo`='$n11',`estado`='$n12',`roles_id`='$n13',`horarios_id`='$n14',`sucursal_id`='$n15'
    WHERE (`id` = '$n0')";



$res=mysqli_query($con,$sql);
    if($res){
      echo 'Success';

    }else{
        die("Error".mysqli_error($con));
    }
    
    }


}

?>
