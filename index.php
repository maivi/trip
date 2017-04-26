<!DOCTYPE html>
<html lang="es">
<?php include "include/head.php"; ?>
<body>
	<?php 
		session_start();
		include "include/header.php";
		include "include/cuerpo.php";
		//$_SESSION['newsession']='no';
		//$_SESSION['usuario'] = "Maximiliano Kadyszyn";
		//$_SESSION['id'] = "1";
		if (isset($_SESSION['newsession'])) {
			if ($_SESSION['newsession']=='yes'){
				include "include/perfil.php";
			}
		}else{
			include "include/form.php";
		}

		include "include/scripts.php";
	?>
</body>
</html>