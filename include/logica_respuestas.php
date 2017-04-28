<?php  

	include "conexion.php";

	$id = $_POST["id"];
	$json["id_new"]=$id;

	$consulta = "SELECT * FROM preguntas WHERE id_preguntas = $id;";
	$json["consulta"]=$consulta;
	$result = $conexion->query($consulta);

	if($pregunta = $result->fetch_assoc()){
		$json[0]["resp_1"] = $pregunta["resp_1"];
		$json[0]["resp_2"] = $pregunta["resp_2"];
		$json[0]["resp_3"] = $pregunta["resp_3"];
	}

	echo json_encode($json);
	$conexion->close();
?>