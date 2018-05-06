<?php

require("../model/get_student.php");

if (isset($_GET['email'])){
	$student_mail = $_GET['email'];
} else {
	    header('Location: ../view/notfound.html');
}

$student = get_student_by_email($student_mail);

require("../model/profil_other_user.php");

$array = array("name"=>$student->getPic(), "year"=>$student->getYear(),
"email"=>$student->getEmail(), "match"=>$match, "name"=>$student->getSurname(),
"adj"=>$student->getStringAdjectives(), "description"=>$student->getDescription(),
"pic"=>$student->getPic());

$json_array = json_encode($array);

//echo $json_array;

 ?>
