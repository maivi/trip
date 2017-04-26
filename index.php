<!DOCTYPE html>
<html lang="es">
<?php include "include/head.php"; ?>
<body>
	<?php 
		session_start();
		$_SESSION['newsession']='no';
		include "include/header.php";
		include "include/cuerpo.php";
		if (isset($_SESSION['newsession'])) {
			if ($_SESSION['newsession']=='no'){
				include "include/form.php";
			}
		}else{
			include "include/form.php";
		}

		include "include/scripts.php";
	?>
</body>
</html>