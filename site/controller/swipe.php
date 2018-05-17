<?php
require("../model/swipe.php");

require("../model/get_student.php");
if (isset($_POST['mail'])) {
  $array_student = getArrayStudents(get_student_by_email($_POST['mail']));
  echo $json_array;
}
else{
  $array_student = getArrayStudents(get_student_by_id($_SESSION['id']));
  error_log(print_r($array_student, TRUE));
}

 ?>
