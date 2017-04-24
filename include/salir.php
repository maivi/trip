<?php 
session_start();
$_SESSION['newsession']='no';
$_SESSION['usuario'] = "";
$_SESSION['id'] = "";
session_destroy();
?>