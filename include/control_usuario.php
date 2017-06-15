<?php 
	include "conexion.php";

	$usuario = $_POST["email"];

	$consulta = "SELECT * FROM usuarios WHERE email='$usuario' ;";
	$result = $conexion->query($consulta);
	$json["consulta"]=$consulta;
	if($cantidad = $result->fetch_assoc()){
		$json["usuario"] = 1;
	}else{
		$json["usuario"] = 0;
	}

	echo json_encode($json);
	$conexion->close();
?>