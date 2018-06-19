<?php 
require("../model/messaging.php");

session_start();

$student_id = $_SESSION['id'];
$other_student_id = $_POST['other_student_id'];

echo 'mon id est '.$student_id.'mon camarade id est '.$other_student_id;
