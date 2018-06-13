<?php

function build_csv($file, $list){
  $fp = fopen($file, 'w');
  foreach ($list as $fields) {
    fputcsv($fp, $fields);
  }
  fclose($fp);
  error_log(print_r("Fichier fini", TRUE));
}

function download_file($file){
  if (file_exists($file)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		readfile($file);
		exit;
	}
}

function student_is_null($student){
  if($student->getSurname() == null)
    return true;
  else
    return false;

}
function array_unsubs($file){
	$fileHandle = fopen($file, "r");
	$array_unsubs = array();
	while(($row = fgetcsv($fileHandle, 0, ",")) !==FALSE){
		$array_unsubs[] = row[0].row[1];
	}
	return $array_unsubs;
}

function get_unmatch(){
	$db = db_connect();
	$tab_unmatch = array();
	if($db){
		$query_unmatch_1=
		"SELECT email,year,surname FROM student
		WHERE student_id IN
			(SELECT student_id_god_son FROM student_match
			WHERE final<>true)";
		$statement_student->execute();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$student =  new Student(decrypt_data($row['surname']), $row['description'], NULL, decrypt_data($row['email']),NULL);
			$tab_unmatch = $student->to_array();
		}
		$query_unmatch_2="SELECT email,year,surname FROM student
		WHERE student_id IN
			(SELECT student_id_god_father FROM student_match
			WHERE final<>true)";
		$statement_student->execute();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$student =  new Student(decrypt_data($row['surname']), $row['description'], NULL, decrypt_data($row['email']),NULL);
			$tab_unmatch = $student->to_array();
		}
	}
	return $tab_unmatch;
}
function send_mail_unsubs($student_mail){
	$student_name =	explode('.', $student_mail)[0];
	$student_name = strtoupper($student_name[0]) . substr($student_name, 1, strlen($student_name) -1 );
	$transport_unsubs = (new Swift_SmtpTransport("smtp.gmail.com", 465, "ssl"))
	->setUsername("find.the.r8.one@gmail.com")
	->setPassword("tindertinder")
	;
	$mailer_unsubs = new Swift_Mailer($transport_unsubs);
	$root_unsubs = (!empty($_SERVER['HTTPS']) ? 'https' : 'http'). '://' . $_SERVER['HTTP_HOST'] . '/';

	$message_unsubs = (new Swift_Message("They missed you"))
		->setFrom(["find.the.r8.one@gmail.com" => "Skipti"])
		->setTo([$student_mail."@etu.parisdescartes.fr" => $student_name])
		-setBody('<!DOCTYPE html>'.
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
					'Bonjour <span style="color : #61B8D0">'.$student_name.'</span>,'.
				'</td>'.
		    	'</tr>'.
		'	<tr style="color : #707070; font-size:20px; font-family: Fjalla One">'.
		'		<td align="center">'.
		'			La fin des phases de matching approche, dépêche-toi de créer ton compte sur :'.
		'		</td>'.
		'	</tr>'.
				'<td>'.
				'	<tr>'.
				'	&nbsp;'.
				'</td>'.
		'	<tr>'.
		'	</tr>'.
		'		<td align="center">'.
		'			<a href="www.skipti.fr" style="color : #61B8D0; font-size:20px; font-family: Fjalla One">Skipti.fr</a>'.
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

	$result = $mailer_unsubs->send($message_unsubs);
	return $result;
}
function send_mail_unmatch($student){
	if($student -> getYear()==1){
		$sentence = "parrain ou ta marraine";
	}
	else{
		$sentence = "ton filleul ou ta filleule";
	}
	$student_name =	$student->getSurname();
	$transport_unmatch = (new Swift_SmtpTransport("smtp.gmail.com", 465, "ssl"))
	->setUsername("find.the.r8.one@gmail.com")
	->setPassword("tindertinder")
	;
	$mailer_unmacth = new Swift_Mailer($transport_unmatch);
	$root_unmatch = (!empty($_SERVER['HTTPS']) ? 'https' : 'http'). '://' . $_SERVER['HTTP_HOST'] . '/';

	$message_unmatch = (new Swift_Message("They missed you"))
		->setFrom(["find.the.r8.one@gmail.com" => "Skipti"])
		->setTo([$student->getEmail()."@etu.parisdescartes.fr" => $student_name])
		-setBody('<!DOCTYPE html>'.
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
					'Bonjour <span style="color : #61B8D0">'.$student_name.'</span>,'.
				'</td>'.
		    	'</tr>'.
		'	<tr style="color : #707070; font-size:20px; font-family: Fjalla One">'.
		'		<td align="center">'.
		'			La fin des phases de matching approche, dépêche-toi de choisir ton '.$sentence.
		'		</td>'.
		'	</tr>'.
				'<td>'.
				'	<tr>'.
				'	&nbsp;'.
				'</td>'.
		'	<tr>'.
		'	</tr>'.
		'		<td align="center">'.
		'			<a href="www.skipti.fr" style="color : #61B8D0; font-size:20px; font-family: Fjalla One">Skipti.fr</a>'.
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

	$result = $mailer_unmacth->send($message_unmatch);
	return $result;
}
?>
