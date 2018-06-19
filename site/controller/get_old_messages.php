<?php 
require("../model/messaging.php");

session_start();

$student_id = $_SESSION['id'];
$other_student_id = $_POST['other_student_id'];
$conv = new Conversation($student_id,$other_student_id);
$id_conv = $conv->get_id();

$messages = array();
$messages = get_old_messages($id_conv);
die(var_dump($massages));
