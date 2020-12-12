<?php 



if ($_POST) {
        # code...
        include("../../config/db.php");
        include("../../config/conexion.php");



            /////////////////////////////////////////////////////////////////////////////////////////////////

        //Guardar Asesor de Porveedor

        # code...
    

    //$sqlConsultaProductosSinAsignar ="select id,sku,nombre,marca from producto WHERE id NOT IN (SELECT producto_idproducto FROM precios WHERE sucursal_idsucursal = $idSucursal)";
    
    
    
    //$resultadoConsultaProductosSinAsignarWhile=mysqli_query($con,$sqlConsultaProductosSinAsignar);// segunda instancia de consulta para el while que almacenara los datos
    //$resultadoFilasProductoSinAsignar=mysqly_num_rows($resultadoConsultaProductosSinAsignar);//cuenta las filas del resultado
    //Condicional para ver que la conuslta se ejecuto correctamente
        if (!empty($_POST['idProductoSinAsignar'])) {
                # code...
                // echo $_POST['id_empleado'];
                $data2 = array();
                $idProductoSinAsignar= intval($_POST['idProductoSinAsignar']);
                $sqlConsultaProductosSinAsignar ="SELECT * FROM producto where id = $idProductoSinAsignar";
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
    

   

} //fin del if
?>
