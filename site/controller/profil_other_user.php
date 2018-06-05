<?php

require("../model/get_student.php");
//modif tibo
$mobile = false;
if (isset($_GET['email'])){
	$student_mail = $_GET['email'];
	$student = get_student_by_email($student_mail);
	$currentUser = get_student_by_id($_SESSION['id']);
	if ($student -> getEmail() == $currentUser-> getEmail()){
		header('Location:../view/updateprofile.php');
	}
} else if (isset($_POST['mail'])) {
		$student = get_student_by_email($_POST['mail']);
		$mobile = true;
}else{
	header('Location: ../view/notfound.html');
}
//fin
/*original code
if (isset($_GET['email'])){
	$student_mail = $_GET['email'];
}else{
	header('Location: ../view/notfound.html');
}
*/
require("../model/profil_other_user.php");

$array = array("name"=>$student->getPic(), "year"=>$student->getYear(),
"email"=>$student->getEmail(), "match"=>$match, "name"=>$student->getSurname(),
"adj"=>$student->getStringAdjectives(), "description"=>$student->getDescription(),
"pic"=>$student->getPic());

//modif tibo
if ($mobile == true){
	$array = array('student' => $student->to_array(), 'match' => $nb_matchs);
	$json_array = json_encode($array);
	echo $json_array;
}
 ?>
