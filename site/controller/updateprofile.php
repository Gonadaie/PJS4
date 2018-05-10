<?php

require("../model/get_student.php");

if(isset($_SESSION['id'])){
  $student = get_student_by_id($_SESSION['id']);
}
else{
  $student = get_student_by_email($_POST['mail']);
}

require("../model/updateprofile.php");

$array = array("name"=>$student->getPic(), "year"=>$student->getYear(),
"email"=>$student->getEmail(), "match"=>$match, "name"=>$student->getSurname(),
"adj"=>$student->getStringAdjectives(), "description"=>$student->getDescription(),
"pic"=>$student->getPic());

$json_array = json_encode($array);

 ?>
