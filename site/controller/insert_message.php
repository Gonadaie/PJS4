<?php
require_once("../model/messaging.php");

$message = $_POST['content'];
$sender_id = $_POST['sender'];
$receiver_id = $_POST['receiver'];

insert_message($message, $sender_id, $receiver_id);

?>
