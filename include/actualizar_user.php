<?php  
	include "conexion.php";

	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$email = $_POST["email"];
	$dni = $_POST["dni"];
	$telefono = $_POST["telefono"];
	$localidad = $_POST["localidad"];
	$pw = $_POST["pw"];
	$sexo = $_POST["sexo"];
	$id = $_POST["id"];

	$_SESSION['usuario'] = $nombre . " " . $apellido;

	$consulta = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', email='$email', dni='$dni', telefono='$telefono', localidad='$localidad', pw='$pw', sexo='$sexo' WHERE id_usuario='$id';";
	$result = $conexion->query($consulta);

	$json["nombre"]=$_SESSION['usuario'];
	echo json_encode($json);
	
	$conexion->close();
?>