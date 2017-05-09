<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>
<body class="statistics" style="overflow:visible">

	
	<?php  
	session_start();

	if (isset($_SESSION['login'])) {
		if ($_SESSION['login']=='yes'){
			include "include/logica_history.php";
		}
	}else{
		include "include/login_history.php";
	}

	include "include/scripts.php";
	
	?>
</body>
</html>

