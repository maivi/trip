<?php  

include "conexion.php";

$conexion = new mysqli($host,$user,$pw,$db);

if ($conexion->connect_errno) {
	echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
}

$conexion->set_charset('utf8');
$conexion->query("SET NAMES 'UTF8'");

	$comprobar = $_POST["flag"]; // Esto me va a decir si es Login o Registro
	$existe = 0; //La variable que me dice si el usuario existe en la DB
	$json["flag"] = $comprobar;

	switch ($comprobar){
		case 0:{
			$user = $_POST["user"];
			$pw = $_POST["pw"];
			$consulta = "SELECT * FROM usuarios WHERE user = '$user' AND pw = '$pw';";
			$result = $conexion->query($consulta);
			$cantidad = $result->num_rows;
			if($cantidad==1){ // Si existe el usuario en la DB	
				session_start(); // Iniciamos la sesión
				$_SESSION['newsession']='yes'; // Inicializamos las variables SESSION
				while($usuario = $result->fetch_assoc()){
					$_SESSION['usuario'] = $usuario['nombre'] . " " . $usuario['apellido'];
					// Creamos la variable SESSION usuario, que utilizaremos en el perfil
					$_SESSION['id'] = $usuario['id_usuario'];
					// Creo la variable SESSION ID para poder realizar consultas desde el perfil con esta variable.
				}
				$existe=1; // El usuario existe
			}else{
				$existe=0; // El usuario no existe
			}
			$json["existe"] = $existe; // Creamos el JSON que le va a indicar a JS el estado del usuario loggeado
			echo json_encode($json);
			$conexion->close();
			break;
		}
		case 1:{
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$email = $_POST["email"];
			$dni = $_POST["dni"];
			$telefono = $_POST["telefono"];
			$localidad = $_POST["localidad"];
			$pw = $_POST["pw"];
			$user = $_POST["user"];
			$sexo = $_POST["sexo"];

			$consulta = "SELECT * FROM usuarios;";
			$result = $conexion->query($consulta);
			$cantidad = $result->num_rows;

			$encontro = 0;

			while ( ($usuario = $result->fetch_assoc()) && ($encontro==0) ) {
				if($usuario["user"]==$user){
					$encontro=1;
				}
			}

			$json["encontro"]=$encontro;

			if($encontro==0){

				$consulta2 = "INSERT INTO usuarios(nombre, apellido, email, dni, telefono, localidad, pw, user, sexo) VALUES ('$nombre','$apellido','$email','$dni','$telefono',$localidad,'$pw','$user',$sexo);";
				$json["consulta"]=$consulta2;


				$conexion->query($consulta2);





session_start();
$_SESSION['newsession']='yes';
$_SESSION['usuario'] = $nombre . " " . $apellido;
$_SESSION['id'] = ($cantidad+1);
$json["usuario"] = $_SESSION['usuario'];
$json["id"]=$_SESSION['id'];		
}

echo json_encode($json);
break;
}
}
?>