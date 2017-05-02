<?php 
session_start();
$_SESSION['newsession']='no';
$_SESSION['usuario'] = "";
$_SESSION['id'] = "";
$_SESSION['login'] = "no";
session_destroy();
?>