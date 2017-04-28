<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Prueba Captcha</title>
	</head>
	<body>
		<?php
			include "captcha.php";

			$captcha = new Captcha(3, 60, 200, "#111111", "#CCCCCC");

			$datos = $captcha->GenerarCaptcha();
		?>
		<p>Texto Captcha: <?=$datos->texto?></p>
		<p>Nombre imagen captcha: <?=$datos->captcha?></p>
		<br><br><br>
		<img src="http://localhost/caribe2/<?=$datos->captcha?>" alt="">
	</body>
</html>