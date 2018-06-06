<?php 

require_once("../model/chat.php");

$student1_id = $_POST['student1_id'];
$student2_id = $_POST['student2_id'];

$conversation = new Conversation($student1_id, $student2_id);

//Ouvertude sockets

?>
