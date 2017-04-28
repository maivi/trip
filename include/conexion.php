<?php  
	$host = "66.128.53.196"; 
	$user = "mendozav_maivi";
	$pw = "123qweasd.";
	$db = "mendozav_nihuilcaribe"; 

	$conexion = new mysqli($host,$user,$pw,$db);

	if ($conexion->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
	}

	$conexion->set_charset('utf8');
	$conexion->query("SET NAMES 'UTF8'");
?>