<?php 
require("../model/messaging.php");
require_once("../model/chat.php");

session_start();

$student_id = $_SESSION['id'];
$other_student_id = $_POST['other_student_id'];
$id_conv = get_id_conversation($student_id,$other_student_id);

updateFlagLecture($id_conv);

$messages = array();
$messages = get_old_messages($id_conv);

echo json_encode($messages);
