<?php

require("../model/get_student.php");
//modif tibo
$mobile = false;
if (isset($_GET['email'])){
	$student_mail = $_GET['email'];
	$student = get_student_by_email($student_mail);
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

$json_array = json_encode($array);

//modif tibo
if ($mobile == true){
	echo $json_array;
}
 ?>
