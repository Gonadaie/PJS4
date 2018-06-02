<?php

require("../model/db_connect.php");

$db = db_connect();

if($db){
	$query = "UPDATE STUDENT SET validate_account = TRUE WHERE id_student IN (
				SELECT id_student FROM token_on_create WHERE hash_oncr = :token AND is_alive = TRUE)";
	$statement = $db->prepare($query);
	$statement->bindValue(':token', $_GET['token']);
	$statement->execute();

	$query = "DELETE FROM token_on_create WHERE hash_oncr = :token";
	$statement = $db->prepare($query);
	$statement->bindValue(':token', $_GET['token']);
	$statement->execute();
}
