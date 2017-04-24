<!DOCTYPE html>
<html lang="es">
<?php include "include/head.php"; ?>
<body>
	<?php 
		include "include/header.php";
		session_start();
		$_SESSION['newsession']='no';
		$_SESSION['usuario'] = "Maximiliano Kadyszyn";
		$_SESSION['id'] = "1";
		if ($_SESSION['newsession']=='yes'){
			include "include/perfil.php";
		}else{
			header("Location: register.php");
		}
	?>
</body>
</html>