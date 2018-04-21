<?php

require_once("db_connect.php");

function register_student($student_name, $student_mail, $password_hash, $student_year){

	$db = db_connect();
	if($db){
		$query = "INSERT INTO STUDENT (surname, email, password_student, year, pic, score) VALUES (:firstname, :mail, :pass, :year,  '../images/images_student/alice.png', 500)";
		$statement = $db->prepare($query);
		$statement->bindValue(':firstname', $student_name);
		$statement->bindValue(':mail', $student_mail);
		$statement->bindValue(':pass', $password_hash);
		$statement->bindValue(':year', $student_year);
		$statement->execute();
	}
}
