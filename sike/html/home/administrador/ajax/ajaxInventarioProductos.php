<?php 
if ($_POST) {
    include("../../config/db.php");
    include("../../config/conexion.php");

//-------Consultar los Productos que no tienen un precio asociado a una sucursal
//-------- para ser mostrados en un DataTable
    if ($_POST['action']==='cargarProductoSinAsignar'){
        $idSucursal=intval($_POST['idSucursal']);
        $sqlConsultaProductosSinAsignar ="SELECT prod.id as idProducto,prod.sku,prod.nombre,prod.descripcion,prod.presentacion,prod.marca,
        pre.idprecios, pre.existencia, pre.precio_costo, pre.precio_venta, pre.precio_minimo, pre.precio_promocion,pre.estado,pre.sucursal_idsucursal,
        cat.nombre as nombreCategoria, sub.nombre as nombreSubCategoria
        FROM producto prod INNER JOIN precios pre ON prod.id = pre.producto_idproducto inner join subcategoria sub ON sub.id = prod.subcategoria_id
        INNER JOIN categoria cat ON cat.id = sub.categoria_id WHERE pre.sucursal_idsucursal = $idSucursal";
        
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


//-------- para ser mostrados en un DataTable de recargas
if ($_POST['action']==='cargarRecargaInventario'){
    $idSucursal=intval($_POST['idSucursal']);
    $sqlConsultaProductosSinAsignar ="SELECT s.saldo, emp.nombre FROM saldo s INNER JOIN recarga r ON s.recarga_id = r.idrecarga
    INNER JOIN empresa emp ON emp.id = r.empresa_id WHERE s.sucursal_id  = $idSucursal";
    
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
            $idSucursal=intval($_POST['idSucursal']);
            
            //$sqlConsultaProductosSinAsignar ="SELECT producto.id, producto.sku,producto.nombre,producto.descripcion, producto.presentacion,producto.marca,
            //estado_prod.estado,subcategoria.nombre as subcategoria from producto inner join estado_prod on producto.estado_prod_id = estado_prod.id inner join subcategoria on producto.subcategoria_id = subcategoria.id where producto.id = $idProductoSinAsignar";

            $sqlConsultaProductosSinAsignar ="SELECT prod.id as idProducto,prod.sku,prod.nombre,prod.descripcion,prod.presentacion,prod.marca,
            pre.idprecios, pre.existencia, pre.precio_costo, pre.precio_venta, pre.precio_minimo, pre.precio_promocion,pre.estado,pre.sucursal_idsucursal,
            cat.nombre as nombreCategoria, sub.nombre as nombreSubCategoria
            FROM producto prod
            INNER JOIN precios pre ON prod.id = pre.producto_idproducto inner join subcategoria sub ON sub.id = prod.subcategoria_id
            INNER JOIN categoria cat ON cat.id = sub.categoria_id WHERE pre.sucursal_idsucursal = $idSucursal and prod.id = $idProductoSinAsignar";
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
    if ($_POST['action'] == 'guardarPrecioProductoSinAsignar') {
        //console.log("Entro A Guardar");
        # code...
        $data2 = array();
        $action = $_POST['action'];
            //  $dpi = "";       

        
            $existencias =$_POST["existencias"];
            $precioCosto=$_POST['precioCosto'];
            $precioVenta =$_POST['precioVenta'];
            $precioMinimo=$_POST['precioMinimo'];
            $precioPromocion=$_POST['precioPromocion'];
            $estadoProducto=$_POST['estadoProducto'];
            $idPrecioProductoInventario=$_POST['idPrecioProductoInventario'];
            $idSucursal=$_POST['idSucursal'];
            
            
                $sql="SELECT idprecios FROM precios where idprecios =$idPrecioProductoInventario";
                $res=mysqli_query($con,$sql);
               
                while ($data=mysqli_fetch_row($res)){//validacion donde donde busca si hay un resultado encontrado en el id recibido
                    $numero = $data[0];
                    }

                    if ($numero > 0)   {
                        $sqlActualizaPrecio="UPDATE `precios` SET `existencia`='$existencias', `precio_costo`='$precioCosto', `precio_venta`='$precioVenta', `precio_minimo`='$precioMinimo', `precio_promocion`='$precioPromocion', `estado`='$estadoProducto' WHERE `idprecios`='$idPrecioProductoInventario';
                        ";
                            $resActualizacion=mysqli_query($con,$sqlActualizaPrecio);
                            if($resActualizacion){
                                    $data2='successful';
                                    }
                            else    {
                                    die("Error".mysqli_error($con));
                                    }
                                    }
               
                    else    {
                        $data2='replica';
                            die("Error".mysqli_error($con));
                            }
                
                    
                    echo json_encode($data2); //devuelve el resultado
                    exit;
            
                
    } //fin 


} //=========================FIN del if del AJAX=============================
?>