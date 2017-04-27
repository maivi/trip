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
				$name = $usuario['nombre'];
				$email_address = $usuario['email'];
				$to = $email_address;
				$email_subject = "Concurso #DeciNihuil";
				$email_body = '<!DOCTYPE html>
				<html lang="es">
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>Deci Nihuil</title>
				</head>  
				<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;background-color: #E9E8E6;width: 100% !important;line-height: 100% !important;">
					<center> 

						<p>
							Gracias por participar '.$name.'. Escuchanos todos los días para tener mas posibilidades de ganar<br>DECI NIHUIL
						</p>

					</body>
					</html>';

					$headers = "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=utf-8\n";
					$headers .= "From: Radio Nihuil <noresponder@radionihuil.com.ar>\r\n";

					$headers .= "Reply-To: $email_address";	
					mail($to,$email_subject,$email_body,$headers);
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