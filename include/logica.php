<?php 
 
include "conexion.php";

$conexion = new mysqli($host,$user,$pw,$db);
if ($mysqli->connect_errno) {
	echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>