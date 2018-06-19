<?php

require_once('db_connect.php');
require_once('data_crypter.php');

function create_stay_connected_token($token, $student_mail) {
	$stay_connected = is_stay_connected($_COOKIE['skipti_keeplog']);
	if($stay_connected == 1) {
		return 0;
	}
	
	$db = db_connect();
	if($db) {
		$id_query = "SELECT student_id FROM student WHERE email = :mail"; //Duplicate in create_token --> Code only once
		$id_statement = $db->prepare($id_query);
		$id_statement->bindValue(":mail", encrypt_data($student_mail));
		$result_id_statement = $id_statement->execute();

		$student_id;
		while($row = $id_statement->fetch(PDO::FETCH_ASSOC))
			$student_id = $row["student_id"];

		$query = "INSERT INTO token_keep_me_logged (birth, hash_kml, is_alive, student_id) values (:date, :token, true, :id)";
		$statement = $db->prepare($query);
		$statement->bindValue(":date", date("Y-m-d"));
		$statement->bindValue(":token", $token);
		$statement->bindValue(":id", $student_id);
		$statement->execute();
	}
}

function is_stay_connected($cookie) {
	$db = db_connect();
	if($db) {
		$query = "SELECT student_id FROM token_keep_me_logged WHERE hash_kml = :cookie";
		$statement = $db->prepare($query);
		$statement->bindValue(":cookie", $cookie);
		$statement->execute();
		if($statement->rowCount() <> 0)
			return 1;
		else
			return 0;
	}
	return 0;
}

function delete_stay_connected($student_mail) {
	$db = db_connect();
	if($db) {
		$id_query = "SELECT student_id FROM student WHERE email = :mail"; //Duplicate in create_token --> Code only once
		$id_statement = $db->prepare($id_query);
		$id_statement->bindValue(":mail", encrypt_data($student_mail));
		$result_id_statement = $id_statement->execute();

		$student_id;
		while($row = $id_statement->fetch(PDO::FETCH_ASSOC))
			$student_id = $row["student_id"];
		
		$delete_query = "DELETE FROM token_keep_me_logged WHERE student_id = :id";
		$delete_statement = $db->prepare($delete_query);
		$delete_statement->bindValue(":id", $student_id);
		$delete_statement->execute();
	}	
}

?>
