<?php

require_once("db_connect.php");
require_once("data_crypter.php");

$db = db_connect();

if($db) {
	$query = "SELECT student_id FROM STUDENT WHERE email = :mail and validate_account = true";
	$statement = $db->prepare($query);
	$statement->bindValue(':mail', encrypt_data($student_mail));
	$statement->execute();


	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
		$student_id = $row['student_id'];
	}
}
