<?php  
	include "conexion.php";

	$conexion = new mysqli($host,$user,$pw,$db);

	if ($conexion->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}

	$conexion->set_charset('utf8');
	$conexion->query("SET NAMES 'UTF8'");

	//$id_usuario = $_POST['id'];

	$consulta = "SELECT ultima_pregunta FROM ultima_pregunta WHERE id_ultima_pregunta = 1;";
	$result = $conexion->query($consulta);
	$usuario = $result->fetch_assoc();
	$ultima_pregunta = $usuario['ultima_pregunta'];
	echo $ultima_pregunta;

	if($ultima_pregunta!=0){
		$consulta = "SELECT * FROM respuestas_usuarios WHERE id_usuario = '$id_usuario';";
		$result = $conexion->query($consulta);
		$i = 0;
		while($respuestas = $result->fetch_assoc()){
			//$json[$i][""] = $actor['id_respuesta'];
			$i++;
		}
	}



?>