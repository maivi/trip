<?php  
	include "conexion.php";

	$conexion = new mysqli($host,$user,$pw,$db);

	if ($conexion->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}

	$conexion->set_charset('utf8');
	$conexion->query("SET NAMES 'UTF8'");

	$consulta = "SELECT ultima_pregunta FROM ultima_pregunta;";
	$result = $conexion->query($consulta);

	if($actor = $result->fetch_assoc()){
		$json[0]["id_ultima_pregunta"] = $actor['ultima_pregunta'];
	}

	echo json_encode($json); // Acá tenemos encapsuladas todas las localidades, para que solo se busquen una vez.

	$conexion->close();
?>