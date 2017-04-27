<?php  
	include "conexion.php";

	$conexion = new mysqli($host,$user,$pw,$db);

	if ($conexion->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}

	$conexion->set_charset('utf8');
	$conexion->query("SET NAMES 'UTF8'");

	$id_pregunta = $_POST["id_pregunta"];
	$respuesta = (int)$_POST["respuesta"];
	session_start();

	$id_usuario = $_SESSION['id'];

	$consulta = "SELECT * FROM preguntas WHERE id_preguntas = '$id_pregunta';";
	$result = $conexion->query($consulta);
	if($respuesta = $result->fetch_assoc()){
		$correcta = (int)$respuesta["correcta"];
	}
	if ($correcta==$respuesta){
		$estado=3;
	}else{
		$estado=2;
	}
	$consulta = "INSERT INTO respuestas_usuarios(id_usuario,id_respuesta,estado_pregunta) VALUES ($id_usuario,$id_pregunta,$estado);";
	$conexion->query($consulta);
	
	$conexion->close();
?>