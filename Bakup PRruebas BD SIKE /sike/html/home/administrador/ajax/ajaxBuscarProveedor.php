<?php 



if ($_POST) {
# code...
include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = "";


// Buscar searchcontackey
if ($_POST['action'] == 'searchContactKey') {
        # code...
        $searchData = $_POST['dataSearch'];
        $searchData3 = $_POST['dataSearch3'];
    
        $query_select = mysqli_query($con,"SELECT * FROM empresa where empresa.nombre LIKE '%$searchData%' OR empresa.nit  LIKE '%$searchData%'");
    
        $num_rows = mysqli_num_rows($query_select);
        if ($num_rows > 0) {
            # code...
            $htmlTable = '';
            while ($row = mysqli_fetch_assoc($query_select)) {
    
                # code...
                $htmlTable .= '<tr" >
                <th class="text text-monospace" >'.$row['id'].' </th>
                <th class="text text-monospace" >'.$row['nombre'].'</th>
                <th class="text text-monospace" >'.$row['telefono'].'</th>
                <th class="text text-monospace" >'.$row['descripcion'].' </th>
              
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

} //fin del if
?>
