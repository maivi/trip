	<?php 

	include "conexion.php";

	$conexion = new mysqli($host,$user,$pw,$db);

	if ($conexion->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}

	$conexion->set_charset('utf8');
	$conexion->query("SET NAMES 'UTF8'");

	// Encapsulación de las Localidades
	$consulta = "SELECT * FROM localidades;";
	$result = $conexion->query($consulta);
	$i=0;
	while($actor = $result->fetch_assoc()){
		$json[$i]["id_localidades"] = $actor['id_localidades'];
		$json[$i]["localidades"] = $actor['localidades'];
		$i++;
	}
	// Fin de la encapsulación

	// Encapsulación de los Sexos
	$consulta = "SELECT * FROM sexos;";
	$result = $conexion->query($consulta);
	$i=0;
	while($actor = $result->fetch_assoc()){
		$json[$i]["id_sexo"] = $actor['id_sexo'];
		$json[$i]["sexo"] = $actor['sexo'];
		$i++;
	}
	// Fin de la encapsulación

	// Encapsulación de los Estados
	$consulta = "SELECT * FROM estado_respuesta;";
	$result = $conexion->query($consulta);
	$i=0;
	while($actor = $result->fetch_assoc()){
		$json[$i]["id_estado"] = $actor['id_estado'];
		$json[$i]["estado_respuesta"] = $actor['estado_respuesta'];
		$i++;
	}
	// Fin de la encapsulación

	// Ultimo ID pregunta
	$consulta = "SELECT ultima_pregunta FROM ultima_pregunta;";
	$result = $conexion->query($consulta);

	if($actor = $result->fetch_assoc()){
		$json[0]["id_ultima_pregunta"] = $actor['ultima_pregunta'];
	}
	// Fin de la encapsulación del ID

	echo json_encode($json); // Acá tenemos encapsuladas todas las localidades, para que solo se busquen una vez.

	$conexion->close();


	?>

