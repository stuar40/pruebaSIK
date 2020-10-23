<?php 

if ($_POST) {
    # code...

include("../../config/db.php");
include("../../config/conexion.php");
$sucursal = "";


//===================incio del archivo ajaxAsesore
// Obtener datos
if (isset($_POST['action']) == 'obtener_datos_asesor' ) {
    # code...
   
    
    if (!empty($_POST['id_empleado'])) {
        # code...
   // echo $_POST['id_empleado'];
    $data = array();
    $intId = $_POST['id_empleado'];

    $query_select = mysqli_query($con,"SELECT asesor.id,asesor.nombre,asesor.telefono,asesor.correo,asesor.estado,empresa.nombre as nombreProveedor, empresa.id FROM asesor INNER JOIN empresa ON empresa.id=asesor.empresa_id where asesor.id = $intId");
    $num_rows = mysqli_num_rows($query_select);
   
    if ($num_rows > 0) {
        # code...
        $data=mysqli_fetch_assoc($query_select);
        //echo  json_encode($data);
        echo  json_encode($data, JSON_UNESCAPED_UNICODE);
    
    }else{
    echo "error";
    
    }
   
    exit;
    
    }


}

//----------------fin obbtener datos

//guardar edicion
////// Boton Guardar del modal del DataTable funcion 
if (isset($_POST['action']) == 'editar_Asesor' AND !empty($_POST['intencion'])) {
    //console.log("Entro A Guardar");
    # code...
    $data2 = array();
    $action = $_POST['action'];
       


        // pruebas
        if($action=='agregar_Proveedor'){
                    $n1=$_POST['nombreComercial'];
                    $n2 =$_POST['proveedorNIT'];
                    $n3=$_POST['proveedorDireccion'];
                    $n4 =$_POST['telefonoProveedor'];
                    $n5=$_POST['descripcionProveedor'];
                    $sqldpi= "SELECT nit FROM sike.empresa where nit =  $n2";
                    $res1=mysqli_query($con,$sqldpi);
                    while ($data=mysqli_fetch_row($res1)){
                                                        $dpi = $data[0];
                                                        }
                            if ($dpi > 0)   {
                                            $data2 = 'replica';
                                            }
                            else {
                            $sql="INSERT INTO `sike`.`empresa` (`nombre`, `nit`, `direccion`, `telefono`, `descripcion`)  
                            VALUES ('$n1','$n2','$n3','$n4','$n5')";
                            $res=mysqli_query($con,$sql);
                            $consulta="SELECT id, nombre, telefono, descripcion From sike.empresa order by id desc limit 1";
                            $resultadoConsulta=mysqli_query($con,$consulta);
                                if($res){
                                        $data2=mysqli_fetch_array($resultadoConsulta);
                                        }
                                else{
                                    die("Error".mysqli_error($con));
                                    }
                        
                                }
                            echo json_encode($data2); //devuelve el resultado
                            exit;
            }
            else if($action=='editar_Asesor')
            {
                    $n0 = $_POST['ProveedorAsesor'];
                    $n1=$_POST['nombreAsesor'];
                    $n2 =$_POST['telefonoAsesor'];
                    $n3=$_POST['correoAsesor'];
                    $n4 =$_POST['estadoAsesor'];
                    $idAsesor= $_POST['idAse'];
                 
                    # code...
                    $sql = "UPDATE `sike`.`asesor` SET `nombre`='$n1', `telefono`='$n2', `correo`='$n3', `estado`='$n4' WHERE `id`='$idAsesor'";
                
                    $res=mysqli_query($con,$sql);
                    if($res){
                            $data2="actualizado";
                
                    }else{
                            $data2 = 'replica';
                            die("Error".mysqli_error($con));
                        
                    }
                    echo json_encode($data2); //devuelve el resultado
                    exit;} 
                //pruebas 2
        } //fin del if que almacena da99888tos del proveedor
        /////////////////////////////////////////////////////////////////////////////////////////////////

//Guardar Asesor de Porveedor
//fin guardar edicion

//////consulta datos del asesor para el dataTable
if (isset($_POST['action']) == 'cargar_Asesores' AND !empty($_POST['intencion'])) {
    
    # code...
    $data2 = array();//variable array donde se almacenaran la respuesta de la consulta 
    $action = $_POST['action']; //obtiene la variable que se recibe desde jquery
    
    if($action=='cargar_Asesores'){ // compara la accion que se esta recibiendo desde proveedores js en este caso desde el select de asesores
        $idProveedoAsesor=$_POST['idProveedoAsesor'];//captura la variable que recibe desde jquery proveedores.js
        $sqlConsulta= "SELECT id,nombre,telefono,estado,empresa_id   FROM asesor where empresa_id = $idProveedoAsesor"; //realiza una consulta para ver los asesores que estas asociados al id del proveedor
        $res1=mysqli_query($con,$sqlConsulta);
   
        while ($data=mysqli_fetch_row($res1)){ //hace un ciclo donde cuenta las filas de la consulta en el array
                                            $filas = $data[0];//fulas una variable para las condicionales para saber si ejecutar la instruccion o no 
                                            }
        if ($filas < 1){ //si la consulta tiena menos de 1 o mas filas NO se ejeuctara la intruccion
                        $data2 = 'replica';//es la respuesta que espera el JS en caso de no tener resultados
                        }
        else if($filas > 0)  { //si la consulta tiena mas de 1 o mas filas SI se ejeuctara la intruccion
                        $resultadoConsulta=mysqli_query($con,$sqlConsulta); //realiza la consulta nuevamente
                        $data2=mysqli_fetch_array($resultadoConsulta); //almacena el resultado de la consulta en el array data2
                        }
        else  {
               die("Error".mysqli_error($con)); // de lo contrario si no cumple ninguna condicional marca error en esta  seccion
              }
                echo json_encode($data2); //devuelve el resultado data en formato Json
                exit;
            }

    else if($action=='editar_Proveedor') { //opcional en caso de utilizar la misma funcion ajax pero con un action diferente
        console.log("ingreso a Editar Proveedor de Asesor");
       // echo json_encode($data2); //devuelve el resultado
        exit;
            }
    else  {
        die("Error".mysqli_error($con));
           } 
               
} //fin del if que consulta datos del asesor

} //=========================fin del if del AJAXX==============

//===================fin del archivo ajaxAsesores
?>