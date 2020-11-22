<?php 
if ($_POST) {
    include("../../config/db.php");
    include("../../config/conexion.php");

//-------Consultar los Productos que no tienen un precio asociado a una sucursal
//-------- para ser mostrados en un DataTable
    if ($_POST['action']==='cargarProductoSinAsignar'){
        $idSucursal=intval($_POST['idSucursal']);
        $sqlConsultaProductosSinAsignar ="SELECT id,sku,nombre,marca from producto WHERE id NOT IN (SELECT producto_idproducto FROM precios WHERE sucursal_idsucursal = $idSucursal)";
        //$sqlConsultaProductosSinAsignar ="SELECT id,sku,nombre,marca FROM producto";
        $resultadoConsultaProductosSinAsignar=mysqli_query($con,$sqlConsultaProductosSinAsignar); //esta ejecucion se utilizara par contar el numero de fila, no me deja reutilizar ya para usarla en el while ya que la instancia se bloquea una vez utilizada en el while
        $resultadoFilasProductoSinAsignar=mysqli_num_rows($resultadoConsultaProductosSinAsignar);//cuenta las filas del resultado
        if(!$resultadoConsultaProductosSinAsignar){
            die("Error");
        }
        else { //condicional que ve si la consulta se ejecuto correctamen
                if($resultadoFilasProductoSinAsignar < 1){ //valida que tenga datos la consulta 
                    $arregloProductosSinAsignar = 'replica';//es la respuesta que espera el JS en caso de no tener resultados
                    echo json_encode($arregloProductosSinAsignar); //devueve el valor para el javascript
                } //fin del id para ver hay datos de vuelta de parte de la consulta
                else{
                    while($dataProductosinAsignar=mysqli_fetch_assoc($resultadoConsultaProductosSinAsignar)){
                        $arregloProductosSinAsignar["data"][]=$dataProductosinAsignar;
                        //$arregloProductosSinAsignar=mysqli_fetch_array($resultadoConsultaProductosSinAsignarWhile);
                    }// fin del bucle while que carga datos al arregloProductosSinAsignar
                    echo json_encode($arregloProductosSinAsignar);
                    //echo json_encode("entro a While"); //devueve el valor para el javascript
                }// fin del else que carga datos al array multidimensional
            }
       
           
    
    }// fin de la condicional para acceder a obtenerProductosSinAsignar


///---------OBTIENE los datos del producto del DataTable para mostrarlo en el modal INFO ver
    if ($_POST['action']==='obtenerProductoSinAsignar'){
        if (!empty($_POST['idProductoSinAsignar'])) {
            # code...
            // echo $_POST['id_empleado'];
            $data2 = array();
            $idProductoSinAsignar= intval($_POST['idProductoSinAsignar']);
            $sqlConsultaProductosSinAsignar ="SELECT producto.id, producto.sku,producto.nombre,producto.descripcion, producto.presentacion,producto.marca,
            estado_prod.estado,subcategoria.nombre as subcategoria from producto inner join estado_prod on producto.estado_prod_id = estado_prod.id inner join subcategoria on producto.subcategoria_id = subcategoria.id where producto.id = $idProductoSinAsignar";
            $resultadoConsultaProductosSinAsignar = mysqli_query($con,$sqlConsultaProductosSinAsignar); //esta ejecucion se utilizara par contar el numero de fila, no me deja reutilizar ya para usarla en el while ya que la instancia se bloquea una vez utilizada en el while
            $num_rows = mysqli_num_rows($resultadoConsultaProductosSinAsignar);
            
            if ($num_rows > 0) {
                    # code...
                    $data2=mysqli_fetch_assoc($resultadoConsultaProductosSinAsignar);
                    echo  json_encode($data2, JSON_UNESCAPED_UNICODE);
            }
            else{
                    echo "error";
            }
            exit;
        }
    }


///////Guardar el precio a un producto segun Sucrsal
    if ($_POST['action'] == 'guardarEgreso') {
        //console.log("Entro A Guardar");
        # code...
        $data2 = array();
        $action = $_POST['action'];
            //  $dpi = "";       

        
            $idSucursal =$_POST["idSucursal"];
            $descripcionEgreso=$_POST['descripcionEgreso'];
            $montoEgreso =$_POST['montoEgreso'];
            $fechaEgreso=$_POST['fechaEgreso'];
            $usuarioEgreso=$_POST['usuarioEgreso'];

            
            

            
                $sql="INSERT INTO `egresos` (`monto`, `fecha`, `descripcion`, `usuarios_id`, `sucursal_id`) 
                VALUES ('$montoEgreso', '$fechaEgreso', '$descripcionEgreso', '$usuarioEgreso',' $idSucursal') ";
                $res=mysqli_query($con,$sql);
                
                if($res){
                            $data2='successful';
                        }
                    else    {
                            die("Error".mysqli_error($con));
                            }
                
                    
                    echo json_encode($data2); //devuelve el resultado
                    exit;
            
                
    } //fin 

    if ($_POST['action'] == "validaAdministrador" ) {
        # code...
             //$n1=$_POST[1];
             $idSucursal =$_POST['idSucursal'];
             $usuarioAdministrador=$_POST['usuarioAdministrador'];
             $passAdministrador =$_POST['passAdministrador'];
            
             
    
             

             $sqlValidarAdminUsuario= "SELECT count(*) FROM usuarios where nombre_usuario = '$usuarioAdministrador' AND password = '$passAdministrador'";
             $resValidarUsuario=mysqli_query($con,$sqlValidarAdminUsuario);
        ///valida si el nombre de usuario existe
             while ($data=mysqli_fetch_row($resValidarUsuario)){
                                                 $numero = $data[0];
                                                 
                                                 }
     
             if ($numero > 0)   { //filtro de si pertenece a la sucursal
                                $sqlValidarAdminSucursal= "SELECT count(*) FROM usuarios where nombre_usuario = '$usuarioAdministrador' AND password = '$passAdministrador' AND sucursal_id = '$idSucursal'";
                                $resValidarSucursal=mysqli_query($con,$sqlValidarAdminSucursal);
                                ///valida si el usuario tiene privilegios en la sucursal
                                while ($data=mysqli_fetch_row($resValidarSucursal)){
                                                                    $numero = $data[0];
                                                    }
                                if ($numero > 0)   { //valida si es administrador 
                                    $sqlValidarAdmin= "SELECT count(*) FROM usuarios where nombre_usuario = '$usuarioAdministrador' AND password = '$passAdministrador' AND roles_id = 1";
                                    $res1=mysqli_query($con,$sqlValidarAdmin);
                                    while ($data=mysqli_fetch_row($res1)){
                                        $numero = $data[0];
                                        }
                                    if ($numero > 0){
                                            echo json_encode ('valido');
                                            
                                        }
                                    else {
                                            echo json_encode ('noadministrador');
                                        }
                                }
                                else    { //de lo contrario el usuario no pertenece a la sucursal
                                        echo json_encode('nosucursal');
                                        }
                                
                             }
             else    { //de lo contrario el usuario o contrasenia son invalidos
                    echo json_encode('sinacceso');
                     }
                     exit;
             } 

} //=========================FIN del if del AJAX=============================
?>