<?php

require_once("db_connect.php");

$db = db_connect();

if($db) {
	$query = "SELECT id_student FROM STUDENT WHERE email = :mail";
	$statement = $db->prepare($query);
	$statement->bindValue(':mail', $student_mail);
	$statement->execute();
	

	while($row = $statement->fetch(PDO::FETCH_ASSOC)){
		$id_student = $row['id_student'];
	}
}
