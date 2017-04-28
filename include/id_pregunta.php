<?php  

	include "conexion.php";

	$conexion = new mysqli($host,$user,$pw,$db);

	if ($conexion->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}

	$conexion->set_charset('utf8');
	$conexion->query("SET NAMES 'UTF8'");

	$consulta = "SELECT * FROM ultima_pregunta WHERE id_ultima_pregunta = 1;";
	$result = $conexion->query($consulta);

	if($pregunta = $result->fetch_assoc()){
		$json["id_pregunta"]=$pregunta["ultima_pregunta"];
	}

	echo json_encode($json);
	$conexion->close();

?>