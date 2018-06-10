<?php?
require_once("db_connect.php");

function delete_student_byID($id){
	$db = db_connect();
	if ($db) {
		$query = "DELETE FROM STUDENT S WHERE S.student_id = :student_id";

		$statement = $db->prepare($query);
        $statement->bindValue(':student_id', $id);
        $statement->execute();
	}
}

?>