<?php
$conexion = mysqli_connect("localhost","root","","clima");

$sql="SELECT 
        fecha.fecha,
        fecha.hora,
        temperatura.temperatura
      FROM lugares
      INNER JOIN fecha 
        ON lugares.idFecha=fecha.idFecha
      INNER JOIN temperatura 
        ON lugares.idTemperatura=temperatura.idTemperatura";

$resultado=mysqli_query($conexion,$sql);

$datos=[];

while($fila=mysqli_fetch_assoc($resultado)){
    $datos[]=$fila;
}

echo json_encode($datos);
?>