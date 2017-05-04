<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body style="overflow:visible">

	
	<?php  
		session_start();

		if (isset($_SESSION['php_up'])) {
			if ($_SESSION['php_up']=='yes'){
				include "include/logica_up.php";
			}
		}else{
			include "include/login_up.php";
		}

		include "include/scripts.php";
	?>
</body>
</html>
