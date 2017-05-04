<?php  
	$usuario = $_POST["user"];
	$pass = $_POST["pass"];
	$flag = $_POST["flag"];

	if($flag==0){
		if ( ($usuario=="cinthia") && ($pass=="123QWEasd.") ){
			session_start();
			$_SESSION['login']="yes";
			$json["entro"]=1;
		}else{
			$json["entro"]=0;
		}
	}else{
		if ( ($usuario=="maivix") && ($pass=="c4m3770") ){
			session_start();
			$_SESSION['php_up']="yes";
			$json["entro"]=1;
		}else{
			$json["entro"]=0;
		}
	}

	$json["flag"]=$flag;
	echo json_encode($json);
?>