<?php 
require("../model/messaging.php");

session_start();

$student_id = $_SESSION['id'];
$other_student_id = $_POST['other_student_id'];
$id_conv = new Conversation($student_id,$other_student_id)->get_id_conversation();
	
echo get_old_messages($id_conv);
