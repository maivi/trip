<?php  
/*****************************************************************************************************/

$name = "esteban";
$razon = "hola";
$email_address = "escorpion_erc@hotmail.com";


$to = $email_address;
$email_subject = "Concurso Deci Nihuil";
$email_body = '<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Deci Nihuil</title>
</head>  
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;background-color: #E9E8E6;width: 100% !important;line-height: 100% !important;">
<center> 

<p>
Gracias por participar.<br>
<span><strong><em>Nombre:</em></strong></span><br>
<span><strong><em>Apellido:</em></strong></span><br>
<span><strong><em>Email:</em></strong></span><br>
</p>

</body>
</html>';

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: Radio Nihuil <noreply@radionihuil.com.ar>\r\n";

$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
/***************************************************************************************************/


?>