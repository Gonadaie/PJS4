<?php
require("../model/swipe.php");
session_start();
require("../model/get_student.php");
if (isset($_POST['mail'])) {
  $array_student = getArrayStudents(get_student_by_email($_POST['mail']));
  echo $array_student;
}
else{
  $array_student = getArrayStudents(get_student_by_id($_SESSION['id']));
}

 ?>
