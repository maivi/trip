<?php 

	include "conexion.php";
	
	$json[0]["existe"]="no";
	
	$usuario = (string)$_POST["email"];

	$consulta = "SELECT * FROM usuarios WHERE email = '$usuario';";

	$result = $conexion->query($consulta);

	if($pregunta = $result->fetch_assoc()){
		$email = $pregunta["email"];
		$pw = $pregunta["pw"];
		$nombre = $pregunta["nombre"];
		$sexo = $pregunta["sexo"];
		if($sexo==1){
			$estimado = "Estimado";
		}else{
			$estimado = "Estimada";
		}

		$name = $nombre;
		$email_address = $email;
		$to = $email_address;
		$email_subject = "Recuperación de password #DeciNihuil";
		$email_body = '<!DOCTYPE html>
			<html lang="es">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Recuperación de password #DeciNihuil</title>
			</head>  
			<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;width: 100% !important;line-height: 100% !important;">
				<center> 

				<p>
					'.$estimado.' '.$name.', te recordamos que tu password es: <br><br>'.$pw.'.<br><br>  <br><br>DECI NIHUIL
				</p>

			</body>
			</html>';
		$json[0]["body"]=$email_body;

		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8\n";
		$headers .= "From: Radio Nihuil <noresponder@radionihuil.com.ar>\r\n";

		$headers .= "Reply-To: $email_address";	
		mail($to,$email_subject,$email_body,$headers);

		$json[0]["existe"]="si";
	}else{
		$json[0]["existe"]="no";
	}

	echo json_encode($json);
	$conexion->close();
?>