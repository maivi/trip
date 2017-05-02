<?php  
	include "conexion.php";

	$consulta = "SELECT * FROM usuarios WHERE user='$usuario' ;";

	$result = $conexion->query($consulta);

	while($cantidad = $result->fetch_assoc()){
		echo $cantidad["Nombre"]." ".$cantidad["apellido"]."<br>";
	}

	$conexion->close();
?>