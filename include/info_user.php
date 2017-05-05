<?php  
	include "conexion.php";

	$id = $_POST["id"];

	$consulta = "SELECT * FROM usuarios WHERE id_usuario = $id;";
	$result = $conexion->query($consulta);

	if($pregunta = $result->fetch_assoc()){
		$json["nombre"]=$pregunta["nombre"];
		$json["apellido"]=$pregunta["apellido"];
		$json["email"]=$pregunta["email"];
		$json["dni"]=$pregunta["dni"];
		$json["telefono"]=$pregunta["telefono"];
		$json["localidad"]=$pregunta["localidad"];
		$json["user"]=$pregunta["user"];
		$json["sexo"]=$pregunta["sexo"];
	}

	echo json_encode($json);
	$conexion->close();

?>