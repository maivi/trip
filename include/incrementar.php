<?php  

include "conexion.php";

$consulta = "SELECT * FROM ultima_pregunta;";
$result = $conexion->query($consulta);

if($cantidad = $result->fetch_assoc()){
	$json["id_antes"] = $cantidad["ultima_pregunta"];
	$aux = ( (int)$cantidad["ultima_pregunta"] ) + 1;
	$consulta = "UPDATE ultima_pregunta SET ultima_pregunta = $aux;";
	$result = $conexion->query($consulta);

	$consulta = "SELECT * FROM ultima_pregunta;";
	$result = $conexion->query($consulta);
	if($cantidad2 = $result->fetch_assoc()){
		$json["id_despues"] = $cantidad2["ultima_pregunta"];
	}
}

echo json_encode($json);

$conexion->close();
?>