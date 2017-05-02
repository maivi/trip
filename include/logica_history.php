<?php  

include "conexion.php";

$users = array();
$localidades = array();
$sexos = array();

$consulta = "SELECT * FROM sexos;";
$result = $conexion->query($consulta);
$i=0;
while($cantidad = $result->fetch_assoc()){
	$sexos[$i]=$cantidad;
	$i++;
}

$consulta = "SELECT * FROM localidades;";
$result = $conexion->query($consulta);
$i=0;
while($cantidad = $result->fetch_assoc()){
	$localidades[$i]=$cantidad;
	$i++;
}

$consulta = "SELECT * FROM usuarios ;";

$result = $conexion->query($consulta);

echo '<table class="table table-bordered table-hover table-responsive"><tbody>';
echo '<tr><th>Nombre</th><th>Apellido</th><th>E-Mail</th><th>DNI</th><th>Teléfono</th><th>Localidad</th><th>Usuario</th><th>Sexo</th><th>Fecha de Ingreso</th>';



$i=0;
$cant_hombres=0;
while($cantidad = $result->fetch_assoc()){
	$users[$i]=$cantidad;
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
	$aux = (int)$cantidad["localidad"];
	echo "<td>".$localidades[$aux-1]["localidades"]."<br>";
	echo "<td>".$cantidad["user"]."<br>";
	$aux = (int)$cantidad["sexo"];
	if($aux==1) $cant_hombres++;
	echo "<td>".$sexos[$aux-1]["sexo"]."<br>";
	$date = date_create($cantidad["fecha_registro"]);
	echo "<td>".date_format($date, 'd-m-Y')."<br>";
	echo "</tr>";
	$i++;
}

echo "</tbody></table>";

echo '<br><br><table class="table table-bordered table-hover table-responsive"><tbody>';
echo "<tr><th><center>Cantidad de Registrados</center></th><th><center>Cantidad de Hombres</center></th><th><center>Cantidad de Mujeres</center></th></tr>";
echo "<tr><td><center>".$result->num_rows."</center></td>";
echo "<td><center>".$cant_hombres."</center></td>";
echo "<td><center>". ( (int)($result->num_rows) - (int)($cant_hombres) )."</center></td></tbody></table><br><br><br>";

$conexion->close();
?>