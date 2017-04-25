<!DOCTYPE html>
<html lang="es">
<?php include "include/head.php"; ?>
<body>
	<?php 
		include "include/header.php";
		include "include/cuerpo.php";
		session_start();
		$_SESSION['newsession']='no';
		//$_SESSION['usuario'] = "Maximiliano Kadyszyn";
		//$_SESSION['id'] = "1";
		if ($_SESSION['newsession']=='yes'){
			include "include/perfil.php";
		}else{
			include "include/form.php";
		}

		include "include/scripts.php";
	?>
</body>
</html>