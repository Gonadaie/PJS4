<?php


require_once("get_student.php");
require_once("data_crypter.php");

function create_token($token_hash, $student_mail) {

	$db = db_connect();

	if($db){

		$student = get_student_by_email_no_adj($student_mail);
		$id = $student->getId();

		$insert_query = "INSERT INTO token_on_create (birth, hash_oncr, is_alive, student_id) values (:date, :hash, true, :id)";
		$insert_statement = $db->prepare($insert_query);
		$insert_statement->bindValue(":date", date("Y-m-d"));
		$insert_statement->bindValue(":hash", $token_hash);
		$insert_statement->bindValue(":id", $id);
		$insert_statement->execute();
	}
}
