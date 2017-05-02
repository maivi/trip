<?php  
	$usuario = $_POST["user"];
	$pass = $_POST["pass"];
	if ( ($usuario=="cinthia") && ($pass=="123QWEasd.") ){
		session_start();
		$_SESSION['login']="yes";
		$json["entro"]=1;
	}else{
		$json["entro"]=0;
	}
	echo json_encode($json);
?>