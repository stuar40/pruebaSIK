<?php 
if ($_POST) {
    include("../../config/db.php");
    include("../../config/conexion.php");

    if ($_POST['action'] == 'guardarDia') {
        //console.log("Entro A Guardar");
        # code...
        $data2 = array();
        $action = $_POST['action'];
        $fechaInicioDia=date('Y-m-d H:i:s');
        
            $idSucursal =$_POST["idSucursal"];
            $montoDia =$_POST['montoDia'];
           
                $sql="INSERT INTO `nuevo_dia` (`monto_inicio`, `fecha_hora`, `sucursal_id`) 
                VALUES ('$montoDia', '$fechaInicioDia', ' $idSucursal') ";
                $res=mysqli_query($con,$sql);
                
                if($res){
                            $data2='successful';
                        }
                    else    {
                            die("Error".mysqli_error($con));
                            $data2="error";
                            }
                
                    
                    echo json_encode($data2); //devuelve el resultado
                    exit;
            
                
    } //fin 

} //=========================FIN del if del AJAX=============================
?>