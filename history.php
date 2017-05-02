<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body style="overflow:visible">

	<?php  
	include "include/conexion.php";

	$consulta = "SELECT * FROM usuarios ;";

	$result = $conexion->query($consulta);

	echo '<table class="table table-bordered table-hover table-responsive"><tbody>';
	echo '<tr><th>Nombre</th><th>Apellido</th><th>E-Mail</th><th>DNI</th><th>Teléfono</th><th>Localidad</th><th>Usuario</th><th>Sexo</th><th>Fecha de Ingreso</th>';

	

	$i=0;
	while($cantidad = $result->fetch_assoc()){
		if($i%2==0){
			echo "<tr class='success'>";
		}else{
			echo "<tr>";
		}
		echo "<td>".$cantidad["nombre"]."</td>";
		echo "<td>".$cantidad["apellido"]."<br>";
		echo "<td>".$cantidad["email"]."<br>";
		echo "<td>".$cantidad["dni"]."<br>";
		echo "<td>".$cantidad["telefono"]."<br>";
		echo "<td>".$cantidad["localidad"]."<br>";
		echo "<td>".$cantidad["user"]."<br>";
		echo "<td>".$cantidad["sexo"]."<br>";
		$date = date_create($cantidad["fecha_registro"]);
		echo "<td>".date_format($date, 'Y-m-d')."<br>";
		echo "</tr>";
		$i++;
	}

	echo "</tbody></table>";
	
	echo "<br>Cantidad de Registrados: ".$result->num_rows;

	$conexion->close();
	?>
</body>
</html>

