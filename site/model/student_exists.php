<?php

require_once("db_connect.php");
require_once("data_crypter.php");

$db = db_connect();

if($db) {
	$query = "SELECT student_id FROM STUDENT WHERE email = :mail and validate_account = true";
	$statement = $db->prepare($query);
	$statement->bindValue(':mail', encrypt_data($student_mail));
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	error_log(print_r($statement->rowCount(),true));
}
