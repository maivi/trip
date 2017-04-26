<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['razon']) 		||
   empty($_POST['email']) 		||
   empty($_POST['message'])		||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$razon = $_POST['razon'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// Create the email and send the message
$to = 'guillermo@koiron.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Consulta de: $name";
$email_body = '<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>F&eacute;nix</title>
</head>  
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;background-color: #E9E8E6;width: 100% !important;line-height: 100% !important;">
<center> 
  <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" style="margin: 0;padding: 0;background-color: #E9E8E6;width:600px !important;line-height: 100% !important;height: 100% !important;max-width:600px;">
<tr>
    <td valign="top" style="border-collapse: collapse;">
    <!-- tabla cuerpo -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="  width: 600px !important;  max-width: 600px;border-top: 0px solid transparent;-webkit-box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.08);-moz-box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.08);box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.08);border-radius: 0px;background-color: #FFFFFF;">
        <tr>
            <td align="center" valign="top" style="border-collapse: collapse;">
                 <table border="0" cellpadding="30" cellspacing="0" width="100%" id="templateBody">
                <tr>
                    <td class="bodyContent" style="border-collapse: collapse;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td width="50%"></td>
                          <td width="50%" align="right">
                            <table border="0" cellpadding="0" cellspacing="0" width="200px">
                                <tr>
                                    <td style="border-collapse: collapse;"><img src="http://fenixarg.com/images/logo-emailing.png" alt="F&eacute;nix" width="100%" style=" max-width: 200px;" title="Fenix" />
                                    </td>
                                </tr>
                            </table> 
                          </td>
                        </tr>
                    </table>
                  </td>
                </tr> 
                <tr>
                    <td style="border-collapse: collapse;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td valign="top" style="border-collapse: collapse;font-family: Arial;font-size: 15px;line-height: 20px;padding: 0px;margin: 0px;">
                          <p>
                          Consulta enviada desde formulario web.<br>
                          <span><strong><em>Nombre:</em></strong></span> '.$_POST['name'].'<br>
                          <span><strong><em>Raz&oacute;n social:</em></strong></span> '.$_POST['razon'].'<br>
                          <span><strong><em>Email:</em></strong></span> '.$_POST['email'].'<br>
                          <span><strong><em>Consulta:</em></strong></span> '.$_POST['message'].'<br>
                          </p>
                          </td>
                        </tr>
                    </table>
                    </td>
                </tr>
                </table>
            </td>
        </tr>
    </table> 
    </td>
</tr>
</table>
</center>
</body>
</html>';

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "From: Fenix <info@fenixarg.com.ar>\r\n";

//$headers .= "From: noreply@fenixarg.com.ar\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>