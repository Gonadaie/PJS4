<?php

require("../model/get_student.php");
$mobile = false;

if (isset($_POST['mail'])) {
  $student = get_student_by_email($_POST['mail']);
  $mobile = true;
}
else{
  $student = get_student_by_id($_SESSION['id']);
}

require("../model/updateprofile.php");

$array = array('student' => $student->to_array(), 'match' => $match);

$json_array = json_encode($array);
if ($mobile == true) {
  echo $json_array;
}
 ?>
