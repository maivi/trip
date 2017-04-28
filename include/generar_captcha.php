<?php 
	include "../captcha.php";

    $captcha = new Captcha();
    session_start();
    $datos = $captcha->GenerarCaptcha();
    $_SESSION["pepita"]=$datos->texto;
?>