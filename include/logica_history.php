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
					<li><a href="#" id="testeando" class="salir-sesion-history">Salir</a></li>
				</ul>
			</div>

	</div><!-- /.container-fluid -->
</nav>

<div class='container titulo_estadisticas' style='height: auto;clear:both;'><br><h1>Estadísticas</h1><br></div>

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

$cantidad_usuarios = $result->num_rows;

$consulta2 = "SELECT * FROM respuestas_usuarios ;";

$result2 = $conexion->query($consulta2);

$cantidad_respuestas = $result2->num_rows;

$consulta3 = "SELECT * FROM ultima_pregunta;";
$result3 = $conexion->query($consulta3);

if($cantidad2 = $result3->fetch_assoc()){
	$cantidad_preguntas = $cantidad2["ultima_pregunta"];
}

$promedio = $cantidad_respuestas / $cantidad_usuarios;
$promedio = number_format($promedio, 2, '.', '');
$calculo = $cantidad_preguntas * ($promedio/10);
$calculo = number_format($calculo, 2, '.', '');

echo "<div class='container coeficientes'>";

echo "<div class='contenedor-estadisticas'>";


echo "<div class='padre-bloque-estadisticas'><div class='bloque-estadisticas'>";
echo "<div class='texto-estadistica'>Cantidad de Usuarios</div> <div class='resultado-estadistica'>" . $cantidad_usuarios . "</div>";
echo "</div></div>";


echo "<div class='padre-bloque-estadisticas'><div class='bloque-estadisticas'>";
echo "<div class='texto-estadistica'>Cantidad de Respuestas</div> <div class='resultado-estadistica'>" . $cantidad_respuestas . "</div>";
echo "</div></div>";


echo "<div class='padre-bloque-estadisticas'><div class='bloque-estadisticas'>";
echo "<div class='texto-estadistica'>Cantidad de Preguntas</div> <div class='resultado-estadistica'>" . $cantidad_preguntas . "</div>";
echo "</div></div>";


echo "<div class='padre-bloque-estadisticas'><div class='bloque-estadisticas'>";
echo "<div class='texto-estadistica'><p>Cantidad de Respuestas</p> <div class='separacion'></div> <p>Cantidad de Usuarios</p> </div><div class='resultado-estadistica'>" . $promedio . "</div>";
echo "</div></div>";


echo "<div class='padre-bloque-estadisticas'><div class='bloque-estadisticas'>";
echo "<div class='texto-estadistica'>Respuestas por Usuarios aproximada</div> <div class='resultado-estadistica'>" . $calculo . "</div>";
echo "</div></div>";


echo "</div>";
echo "</div>";

echo "<br><br>";


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

echo '<table class="table table-bordered table-hover table-responsive table-sexos"><tbody>';
echo "<tr><th><center>Cantidad de Registrados</center></th><th><center>Cantidad de Hombres</center></th><th><center>Cantidad de Mujeres</center></th></tr>";
echo "<tr><td><center>".$result->num_rows."</center></td>";
echo "<td><center>".$cant_hombres."</center></td>";
echo "<td><center>". ( (int)($result->num_rows) - (int)($cant_hombres) )."</center></td>";
echo "</tbody></table>";



echo '<div class="tabla_estadisticas"><div class="grafico"></div><div class="tabla_hijo"><table class="table table-bordered table-hover table-responsive"><tbody>';
echo "<tr><th>Identificador</th><th>Localidad</th><th><center>Cantidad</center></th></tr>";
echo "<tr id='localidad0'><td></td><td>Ciudad</td><td><center>".$cant_loc[0]."</center></td></tr>";
echo "<tr id='localidad1'><td></td><td>General Alvear</td><td><center>".$cant_loc[1]."</center></td></tr>";
echo "<tr id='localidad2'><td></td><td>Godoy Cruz</td><td><center>".$cant_loc[2]."</center></td></tr>";
echo "<tr id='localidad3'><td></td><td>Guaymallén</td><td><center>".$cant_loc[3]."</center></td></tr>";
echo "<tr id='localidad4'><td></td><td>Junín</td><td><center>".$cant_loc[4]."</center></td></tr>";
echo "<tr id='localidad5'><td></td><td>La Paz</td><td><center>".$cant_loc[5]."</center></td></tr>";
echo "<tr id='localidad6'><td></td><td>Las Heras</td><td><center>".$cant_loc[6]."</center></td></tr>";
echo "<tr id='localidad7'><td></td><td>Lavalle</td><td><center>".$cant_loc[7]."</center></td></tr>";
echo "<tr id='localidad8'><td></td><td>Luján de Cuyo</td><td><center>".$cant_loc[8]."</center></td></tr>";
echo "<tr id='localidad9'><td></td><td>Maipú</td><td><center>".$cant_loc[9]."</center></td></tr>";
echo "<tr id='localidad10'><td></td><td>Malargüe</td><td><center>".$cant_loc[10]."</center></td></tr>";
echo "<tr id='localidad11'><td></td><td>Rivadavia</td><td><center>".$cant_loc[11]."</center></td></tr>";
echo "<tr id='localidad12'><td></td><td>San Carlos</td><td><center>".$cant_loc[12]."</center></td></tr>";
echo "<tr id='localidad13'><td></td><td>San martín</td><td><center>".$cant_loc[13]."</center></td></tr>";
echo "<tr id='localidad14'><td></td><td>San Rafael</td><td><center>".$cant_loc[14]."</center></td></tr>";
echo "<tr id='localidad15'><td></td><td>Santa Rosa</td><td><center>".$cant_loc[15]."</center></td></tr>";
echo "<tr id='localidad16'><td></td><td>Tunuyán</td><td><center>".$cant_loc[16]."</center></td></tr>";
echo "<tr id='localidad17'><td></td><td>Tupungato</td><td><center>".$cant_loc[17]."</center></td></tr>";

echo "</tbody></table></div></div>";

$conexion->close();
?>


<canvas id="canvas" height="450" width="450"></canvas>


<footer>
	<div style="width: 100%; text-align: center; padding-bottom: 30px" class="contenedor-footer-back">
		<p style="font-size: 13px;font-family: 'Open Sans Regular'; color: #ccc">Desarrollado por <a style="color: #ccc" target="_blank" href="http://koiron.com">koiron</a></p>
	</div>
</footer>