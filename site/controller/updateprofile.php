<?php

require("../model/get_student.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $student = get_student_by_email($_POST['mail']);
  error_log(print_r("POST", TRUE));
}
else{
  $student = get_student_by_id($_SESSION['id']);
}

require("../model/updateprofile.php");

$array = array("name"=>$student->getPic(), "year"=>$student->getYear(),
"email"=>$student->getEmail(), "match"=>$match, "name"=>$student->getSurname(),
"adj"=>$student->getStringAdjectives(), "description"=>$student->getDescription(),
"pic"=>$student->getPic());

$json_array = json_encode($array);

 ?>
