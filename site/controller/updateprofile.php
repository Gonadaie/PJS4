<?php

require("../model/get_student.php");



/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $student = get_student_by_email($_POST['mail']);

}
else{*/
  $student = get_student_by_id($_SESSION['id']);

require("../model/updateprofile.php");

$array = array('student' => $student->to_array(), 'match' => $match);

$json_array = json_encode($array);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo $json_array;
}
 ?>
