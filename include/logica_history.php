<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://radionihuil.com.ar/">
				<img src="assets/images/logo.png">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" class="salir-sesion-history">Salir</a></li>
				</ul>
			</div>

	</div><!-- /.container-fluid -->
</nav>

<?php  

include "conexion.php";

$users = array();
$localidades = array();
$sexos = array();
$cant_loc=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

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
	$cant_loc[$aux-1]+=1;
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
echo "<td><center>". ( (int)($result->num_rows) - (int)($cant_hombres) )."</center></td>";
echo "</tbody></table><br><br><br>";



echo '<br><br><table class="table table-bordered table-hover table-responsive"><tbody>';
echo "<tr><th>Localidad</th><th><center>Cantidad</center></th></tr>";
echo "<tr><th>Ciudad</th><th><center>".$cant_loc[0]."</center></th></tr>";
echo "<tr><th>General Alvear</th><th><center>".$cant_loc[1]."</center></th></tr>";
echo "<tr><th>Godoy Cruz</th><th><center>".$cant_loc[2]."</center></th></tr>";
echo "<tr><th>Guaymallén</th><th><center>".$cant_loc[3]."</center></th></tr>";
echo "<tr><th>Junín</th><th><center>".$cant_loc[4]."</center></th></tr>";
echo "<tr><th>La Paz</th><th><center>".$cant_loc[5]."</center></th></tr>";
echo "<tr><th>Las Heras</th><th><center>".$cant_loc[6]."</center></th></tr>";
echo "<tr><th>Lavalle</th><th><center>".$cant_loc[7]."</center></th></tr>";
echo "<tr><th>Luján de Cuyo</th><th><center>".$cant_loc[8]."</center></th></tr>";
echo "<tr><th>Maipú</th><th><center>".$cant_loc[9]."</center></th></tr>";
echo "<tr><th>Malargüe</th><th><center>".$cant_loc[10]."</center></th></tr>";
echo "<tr><th>Rivadavia</th><th><center>".$cant_loc[11]."</center></th></tr>";
echo "<tr><th>San Carlos</th><th><center>".$cant_loc[12]."</center></th></tr>";
echo "<tr><th>San martín</th><th><center>".$cant_loc[13]."</center></th></tr>";
echo "<tr><th>San Rafael</th><th><center>".$cant_loc[14]."</center></th></tr>";
echo "<tr><th>Santa Rosa</th><th><center>".$cant_loc[15]."</center></th></tr>";
echo "<tr><th>Tunuyán</th><th><center>".$cant_loc[16]."</center></th></tr>";
echo "<tr><th>Tupungato</th><th><center>".$cant_loc[17]."</center></th></tr>";

echo "</tbody></table><br><br><br>";

$conexion->close();
?>

<footer>
	<div style="width: 100%; text-align: center; padding-bottom: 30px" class="contenedor-footer-back">
		<p style="font-size: 13px;font-family: 'Open Sans Regular'; color: #ccc">Desarrollado por <a style="color: #ccc" target="_blank" href="http://koiron.com">koiron</a></p>
	</div>
</footer>