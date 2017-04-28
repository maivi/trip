<?php  

	include "conexion.php";

	$consulta = "SELECT * FROM ultima_pregunta WHERE id_ultima_pregunta = 1;";
	$result = $conexion->query($consulta);

	if($pregunta = $result->fetch_assoc()){
		$json["id_pregunta"]=$pregunta["ultima_pregunta"];
	}

	echo json_encode($json);
	$conexion->close();

?>