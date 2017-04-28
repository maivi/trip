<?php  
	include "conexion.php";

	$consulta = "SELECT ultima_pregunta FROM ultima_pregunta;";
	$result = $conexion->query($consulta);

	if($actor = $result->fetch_assoc()){
		$json[0]["id_ultima_pregunta"] = $actor['ultima_pregunta'];
	}

	echo json_encode($json); // Acá tenemos encapsuladas todas las localidades, para que solo se busquen una vez.

	$conexion->close();
?>