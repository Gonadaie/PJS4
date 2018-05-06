<?php
require("../model/swipe.php");

require("../model/get_student.php");

$array_student = getArrayStudents(get_student_by_id($_SESSION['id']));

 ?>
