<?php

require_once("db_connect.php");
require_once("get_student.php");

/**
 * @brief Create a token linked to a user account in the database. The token will be send via email to the user to verify its identity
 * @param token_hash	The hash of the token meant to be insert in the databse
 * @param student_mail	Email adress of the user
 */
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
