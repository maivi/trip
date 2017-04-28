<?php  
	include "conexion.php";

	$id_pregunta = $_POST["id_pregunta"];
	$respuesta = ord($_POST["respuesta"]);

	session_start();

	$id_usuario = $_SESSION['id'];
	$json["id_pregunta"]=$id_pregunta;
	$json["respuesta"]=$respuesta;
	$json["id_usuario"]=$id_usuario;

	$consulta = "SELECT * FROM preguntas WHERE id_preguntas = $id_pregunta;";
	$results = $conexion->query($consulta);
	$json["consulta"]=$consulta;

	if($respuestas = $results->fetch_assoc()){
		$correcta = ord($respuestas["correcta"]);
	}



	if ( ($correcta) == ($respuesta) ){
		$estado=3;
	}else{
		$estado=2;
	}
	$json["correcta"]=$correcta;
	$json["estado"]=$estado;
	$consulta = "INSERT INTO respuestas_usuarios(id_usuario,id_respuesta,estado_pregunta) VALUES ($id_usuario,$id_pregunta,$estado);";
	$conexion->query($consulta);
		
	echo json_encode($json);

	$conexion->close();
?>