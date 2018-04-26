<?php

require("db_connect.php");

function create_forgot_passwd_token($token_hash, $student_mail) {

	$db = db_connect();

	if($db){
		$id_query = "SELECT id_student FROM student WHERE email = :mail";
		$id_statement = $db->prepare($id_query);
		$id_statement->bindValue(":mail", $student_mail);
		$result_id_statement = $id_statement->execute();

		$student_id;
		while($row = $id_statement->fetch(PDO::FETCH_ASSOC))
			$student_id = $row["id_student"];

		if(isset($student_id)) {

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