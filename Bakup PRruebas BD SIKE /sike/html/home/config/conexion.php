<?php

    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        echo"console.log('fallo la conexion')";
        die("imposible conectarse: ".mysqli_error($con));
        echo"console.log('fallo la conexion')";
    }
    if (@mysqli_connect_errno()) {
        echo"console.log('fallo la conexion')";
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
        echo"console.log('fallo la conexion')";
    }
?>
