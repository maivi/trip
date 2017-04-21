<?php  
	$comprobar = $_POST["flag"]; // Esto me va a decir si es Login o Registro
	$existe = 0; //La variable que me dice si el usuario existe en la DB

	switch ($comprobar){
		case 0:{
			$user = $_POST["user"];
			$pw = $_POST["pw"];
			$consulta = "SELECT * FROM usuarios WHERE user = '$user' AND pw = '$pw';";
			$conexion->query($consulta);
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
			$conexion->query($consulta);
			$cantidad = $result->num_rows;


			// Realizar una comprobacion de si existe el usuario

			$consulta = "INSERT INTO usuarios(nombre, apellido, email, dni, telefono, localidad, pw, user, sexo) VALUES ('$nombre','$apellido','$email','$dni','$telefono',$localidad,'$pw','$user',$sexo);";
			$conexion->query($consulta);

			session_start();
			$_SESSION['newsession']='yes';
			$_SESSION['usuario'] = $nombre . " " . $apellido;
			$_SESSION['id'] = ($cantidad+1);
		}
	}
?>