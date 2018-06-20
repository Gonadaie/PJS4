<?php

require_once("../model/db_connect.php");

$db = db_connect();

if($db){
	$query = "UPDATE STUDENT SET validate_account = TRUE WHERE student_id IN (
				SELECT student_id FROM token_on_create WHERE hash_oncr = :token AND is_alive = TRUE)";
	$statement = $db->prepare($query);
	$statement->bindValue(':token', $_GET['token']);
	$statement->execute();

	$query = "DELETE FROM token_on_create WHERE hash_oncr = :token";
	$statement = $db->prepare($query);
	$statement->bindValue(':token', $_GET['token']);
	$statement->execute();
}
