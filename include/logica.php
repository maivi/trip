<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lógica</title>
</head>
<body>
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
		echo $actor['id_localidades'] . " - ";
		echo $actor['localidades'] . "<br>";

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
		echo $actor['id_sexo'] . " - ";
		echo $actor['sexo'] . "<br>";

		$json[$i]["id_sexo"] = $actor['id_sexo'];
		$json[$i]["sexo"] = $actor['sexo'];
		$i++;
	}
	// Fin de la encapsulación

	echo json_encode($json); // Acá tenemos encapsuladas todas las localidades, para que solo se busquen una vez.

	$conexion->close();


	?>
</body>
</html>

