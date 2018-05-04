<?php

require_once("db_connect.php");
require_once("get_student.php");

function create_forgot_passwd_token($token_hash, $student_mail) {

	$db = db_connect();

	if($db){
		$student_id = get_student_by_email($student_mail)->getId();
		
		if(isset($student_id)) {

			//if a previous token exists, then delete it
			$delete_query = "DELETE FROM token_forgot_passwd WHERE id_student=:id";
			$delete_statement = $db->prepare($delete_query);
			$delete_statement->bindValue(":id", $student_id);
			$delete_statement->execute();

			$insert_query = "INSERT INTO token_forgot_passwd VALUES (:date, :token, :id)";
			$insert_statement = $db->prepare($insert_query);
			$insert_statement->bindValue(":date", date("Y-m-d"));
			$insert_statement->bindValue(":token", $token_hash);
			$insert_statement->bindValue(":id", $student_id);
			$insert_statement->execute();
		}	
	}
}

?>
