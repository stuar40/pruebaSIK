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
    
        $query_select = mysqli_query($con,"SELECT * FROM sike.empresa where empresa.nombre LIKE '%$searchData%' OR empresa.nit  LIKE '%$searchData%'");
    
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

///////Guardar Proveedor
if (isset($_POST['action']) == 'agregar_Proveedor' AND !empty($_POST['intencion'])) {
        //console.log("Entro A Guardar");
        # code...
        $data2 = array();
        $action = $_POST['action'];
            //  $dpi = "";       

          /*  $n1=$_POST['nombreComercial'];
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
            else    {
                $sql="INSERT INTO `sike`.`empresa` (`nombre`, `nit`, `direccion`, `telefono`, `descripcion`)  
                VALUES ('$n1','$n2','$n3','$n4','$n5')";
                $res=mysqli_query($con,$sql);
                $consulta="SELECT id, nombre, telefono, descripcion From sike.empresa order by id desc limit 1";
                $resultadoConsulta=mysqli_query($con,$consulta);
                if($res){
                            $data2=mysqli_fetch_array($resultadoConsulta);
                        }
                    else    {
                            die("Error".mysqli_error($con));
                            }
                
                    }
                    echo json_encode($data2); //devuelve el resultado
                    exit;*/


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
            else    {
                $sql="INSERT INTO `sike`.`empresa` (`nombre`, `nit`, `direccion`, `telefono`, `descripcion`)  
                VALUES ('$n1','$n2','$n3','$n4','$n5')";
                $res=mysqli_query($con,$sql);
                $consulta="SELECT id, nombre, telefono, descripcion From sike.empresa order by id desc limit 1";
                $resultadoConsulta=mysqli_query($con,$consulta);
                if($res){
                            $data2=mysqli_fetch_array($resultadoConsulta);
                        }
                    else    {
                            die("Error".mysqli_error($con));
                            }
                
                    }
                    echo json_encode($data2); //devuelve el resultado
                    exit;
                }
                else if($action=='editar_Proveedor')
                { $n0 = $_POST['nombreComercial'];
                        $n1=$_POST['proveedorNIT'];
                        $n2 =$_POST['proveedorDireccion'];
                        $n3=$_POST['telefonoProveedor'];
                        $n4 =$_POST['descripcionProveedor'];
                        $idProveedor= $_POST['idProv'];
                     
                        # code...
                        $sql = "UPDATE `sike`.`empresa` SET `nombre`='$n0', `nit`='$n1', `direccion`='$n2', `telefono`='$n3', `descripcion`='$n4' WHERE `id`='$idProveedor'";
                    
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

if (isset($_POST['action']) == 'agregar_Asesor' AND !empty($_POST['intencion'])) {
    # code...
           //$numero = "";                              
            
            //$n1=$_POST[1];
            $n1 =$_POST['nombreAsesor'];
            $n2=$_POST['telefonoAsesor'];
            $n3 =$_POST['correoAsesor'];
            $n4=$_POST['estadoAsesor'];
            $n5=$_POST['idProveedor'];
            //$n5=$_POST[0];
            

            $sqldpi= "SELECT correo  FROM asesor where correo =  $n2";
            $res1=mysqli_query($con,$sqldpi);
       
            while ($data=mysqli_fetch_row($res1)){
                                                $numero = $data[0];
                                                }
    
            if ($numero > 0)   {
                            echo 'replica';
                            }
            else    {

                    $sql="INSERT INTO `sike`.`asesor` (`nombre`, `telefono`, `correo`, `estado`, `empresa_id`)   
                    VALUES ('$n1','$n2','$n3','$n4','$n5')";
                    $res=mysqli_query($con,$sql);
                    if($res){
                                
                            echo 'successful';
                            }
                    else    {
                            die("Error".mysqli_error($con));
                            }
                    }
                    exit;
            } //fin del if que almacena datos del proveedor
            //////////////////////////////////////////

            //Actualizar datos Asesor de Porveedor

if (isset($_POST['action']) == 'editar_Asesor' AND !empty($_POST['intencion'])) {
        # code...
               //$numero = "";                              
                
                //$n1=$_POST[1];
                $n1 =$_POST['nombreAsesor'];
                $n2=$_POST['telefonoAsesor'];
                $n3 =$_POST['correoAsesor'];
                $n4=$_POST['estadoAsesor'];
                $n5=$_POST['idProveedor'];
                $n6=$_POST['idAsesor'];
                
    
                $sqldpi= "SELECT id  FROM asesor where id = $n6";
                $res1=mysqli_query($con,$sqldpi);
           
                while ($data=mysqli_fetch_row($res1)){
                                                    $numero = $data[0];
                                                    }
        
                if ($numero > 0)   {
                                echo 'successful';
                                }
                else    {
    
                        $sql="UPDATE `sike`.`asesor` SET `nombre`='$n1', `telefono`='$n2', `correo`='$n3', `estado`='$n4', `empresa_id`='$n5' WHERE `id`='$n6'";
                        $res=mysqli_query($con,$sql);
                        if($res){
                                echo 'replica';
                                }
                        else    {
                                die("Error".mysqli_error($con));
                                }
                        }
                        exit;
                } //fin del if que almacena datos del proveedor
                //////////////////////////////////////////

//================Obtener datos-----------------------------
//listar
// Obtener datos
if (isset($_POST['action']) == 'obtener_datos' ) {
        # code...
       
        
        if (!empty($_POST['id_empleado'])) {
            # code...
       // echo $_POST['id_empleado'];
        $data = array();
        $intId = $_POST['id_empleado'];
    
        $query_select = mysqli_query($con,"SELECT * FROM sike.empresa where id = $intId");
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


//--------------- Actualizar Proveedor

if(isset($_POST['action']) == 'editar_Proveedor'){
        console.log("Entro A editar");
        $data2 = array();
        $n0 = $_POST['nombreComercial'];
        $n1=$_POST['proveedorNIT'];
        $n2 =$_POST['proveedorDireccion'];
        $n3=$_POST['telefonoProveedor'];
        $n4 =$_POST['descripcionProveedor'];
        $idProveedor= $_POST['idProv'];
     
        # code...
        $sql = "UPDATE `sike`.`empresa` SET `nombre`='$n0', `nit`='$n1', `direccion`='$n2', `telefono`='$n3', `descripcion`='$n4' WHERE `id`='$idProveedor'";
    
        $res=mysqli_query($con,$sql);
        if($res){
                $data2=mysqli_fetch_array($res);
    
        }else{
                $data2 = 'replica';
                die("Error".mysqli_error($con));
            
        }
        echo json_encode($data2); //devuelve el resultado
        exit;
        }
//-------------------Fin actualizar Proeveedor

} //=========================fin del if=============================
?>
