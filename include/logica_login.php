<?php  
	$comprobar = $_POST["flag"];
	$existe = 0;

	switch ($comprobar){
		case 0:{
			$user = $_POST["user"];
			$pw = $_POST["pw"];
			$consulta = "SELECT * FROM usuarios WHERE user = '$user' AND pw = '$pw';";
			$conexion->query($consulta);
			$cantidad = $result->num_rows;
			if($cantidad==1){
				session_start();
				$_SESSION['newsession']='yes';
				while($usuario = $result->fetch_assoc()){
					$_SESSION['usuario'] = $usuario['nombre'] . " " . $usuario['apellido'];
				}
				$existe=1;
			}else{
				$existe=0;
			}
			$json["existe"] = $existe;
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
		}
	}
?>