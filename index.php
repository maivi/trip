<!DOCTYPE html>
<html lang="es">
<?php include "include/head.php"; ?>
<body>
	<?php 
		session_start();
		include "include/header.php";
		include "include/cuerpo.php";
		if (isset($_SESSION['newsession'])) {
			if ($_SESSION['newsession']=='yes'){
				include "include/perfil.php";
			}else{
				include "include/form.php";
			}
		}else{
			include "include/form.php";
		}

		include "include/footer.php";

		include "include/scripts.php";
	?>
</body>
</html>