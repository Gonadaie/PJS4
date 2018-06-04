<?php
/**
 *Send a mail to the student once he sign up
**/
require("better_crypt.php");
require("../model/register-student.php");

$student_name =	explode('.', $_POST['mail'])[0];
$student_name = strtoupper($student_name[0]) . substr($student_name, 1, strlen($student_name) -1 );
$student_mail =	 $_POST['mail'];
$password_hash = better_crypt(strval($_POST['password']), 10);
$student_year =  $_POST['year'];

register_student($student_name, $student_mail, $password_hash, $student_year);


$token_hash = md5($student_mail.date('Y-m-d H:i:s').rand());

require_once("../model/create-token.php");
require_once("../vendor/autoload.php");

$transport = (new Swift_SmtpTransport("smtp.gmail.com", 465, "ssl"))
	->setUsername("find.the.r8.one@gmail.com")
	->setPassword("tindertinder")
;

$mailer = new Swift_Mailer($transport);

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

$registration_link = 'http://skipti.fr/view/loginPerso.php?token='.$token_hash.'&name='.$student_name;

$message = (new Swift_Message("Registration confirmation"))
	->setFrom(["find.the.r8.one@gmail.com" => "Find the right one"])
	->setTo([$student_mail."@etu.parisdescartes.fr" => $student_name])

	->setBody('<!DOCTYPE html>'.
		'<html xmlns:v="urn:schemas-microsoft-com:vml">'.
		'<head>'.
		    '<meta http-equiv="content-type" content="text/html; charset=utf-8">'.
		    '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">'.
		    '<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css">'.
		    '<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">'.
				'<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">'.
		'</head>'.
		'<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">'.

		'<table bgcolor="#F5F7FA" width="100%" border="0" cellpadding="0" cellspacing="0">'.
		    '<tbody>'.
		    	'<tr style="color : #707070; font-size:20px; font-family: Fjalla One">'.
			'	<td align="center">'.
					'Bienvenue <span style="color : #61B8D0">'.$student_name.'</span>,'.
				'</td>'.
		    	'</tr>'.
		'	<tr style="color : #707070; font-size:20px; font-family: Fjalla One">'.
		'		<td align="center">'.
		'			pour valider ton compte clique sur le lien suivant :'.
		'		</td>'.
		'	</tr>'.
				'<td>'.
				'	<tr>'.
				'	&nbsp;'.
				'</td>'.
		'	<tr>'.
		'	</tr>'.
		'		<td align="center">'.
		'			<a href="'.$registration_link.'" style="color : #61B8D0; font-size:20px; font-family: Fjalla One">'.$registration_link.'</a>'.
		'		</td>'.
		'	</tr>'.
		'	<tr>'.
		'		<td align="center">'.
			'	</td>'.
				'			&nbsp;'.
		'	</tr>'.
		'	<tr>'.
		'		<td align="center">'.
		'			<img src="https://zupimages.net/up/18/17/m23z.png" alt="Logo" width="500px" height="344px"/>'.
		'		</td>'.
		'	</tr>'.
		'	<tr>'.
		'		<td>'.
		'			&nbsp;'.
		'		</td>'.
			'<tr style="color : #57BB8A; font-family: Open Sans">'.
			'	<td align="center">'.
			'		Pense à la planète, après avoir validé ton compte, supprime ce mail.'.
			'	</td>'.
			'</tr>'.
			'<tr style="color : #57BB8A; font-family: Open Sans">'.
			'	<td align="center">'.
			'		Le stockage de mail fait tourner quotidiennement l équivalent de'.
			'	</td>'.
		'	</tr>'.
				'<tr style="color : #57BB8A; font-family: Open Sans">'.
		'		<td align="center">'.
		'			quatre centrales nucléaire dans le monde.'.
		'		</td>'.
		  '  </tbody>'.
				'	</tr>'.
'		</table>'.
'		</html>'
	, "text/html");




$result = $mailer->send($message);

if($result) {
	create_token($token_hash, $student_mail);
	echo "OK";
}
else
	echo "FAIL";


?>
