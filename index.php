<!DOCTYPE html>
<html lang="es">
<?php include "include/head.php"; ?>
<body>
	<?php 
		session_start();
		include "include/header.php";
		include "include/cuerpo.php";
<<<<<<< HEAD


		session_start();
		$_SESSION['newsession']='no';
=======
		//$_SESSION['newsession']='no';
>>>>>>> 69f947571de28665607caf97287c01623813463a
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
		include "include/footer.php";
	?>
</body>
</html>