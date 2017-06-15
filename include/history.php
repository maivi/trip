<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
</html>

<?php  
	include "conexion.php";

	$consulta = "SELECT * FROM usuarios ;";

	$result = $conexion->query($consulta);

	echo '<table class="table table-hover"><tbody>';
	echo '<tr><td>Nombre</td><td>Apellido</td><td>E-Mail</td><td>DNI</td><td>Teléfono</td><td>Localidad</td><td>Usuario</td><td>Sexo</td><td>Fecha de Ingreso</td>';


	while($cantidad = $result->fetch_assoc()){
		echo $cantidad["nombre"]." ".$cantidad["apellido"]."<br>";
	}

	echo "</tbody></table>";

	$conexion->close();
?>