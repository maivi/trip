<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" href="assets/images/favicon-01.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="user-scalable=0, initial-scale=1.0">
	<title>DECI NIHUIL</title>
	<?php 
	include "include/styles.php";
	?>
</head>
<body>
	<?php 
		session_start();
		if ($_SESSION['newsession']=='yes'){
			include "include/perfil.php";
		}else{
			echo "NO ENTRO";
			header("Location: register.php");
		}
	?>
</body>
</html>