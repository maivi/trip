<?php 

include "conexion.php";

$conexion = new mysqli($host,$user,$pw,$db);
if ($conexion->connect_errno) {
	echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
}
$conexion->close();

?>