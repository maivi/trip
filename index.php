<!DOCTYPE html>
<html lang="es">
<?php include "include/head.php"; ?>
<body>
	<?php 
		session_start();
		$_SESSION['newsession']='yes';
		if ($_SESSION['newsession']=='yes'){
			include "include/perfil.php";
		}else{
			header("Location: register.php");
		}
	?>
</body>
</html>