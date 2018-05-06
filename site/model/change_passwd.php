<?php

require('db_connect.php');

/**
 * @brief Change the password of the account linked to the a given token
 * @param token			The token linked to the user account (also sent via email)
 * @param passwd_hash	The new password hash to insert in the database
 */
function change_passwd_for($token, $passwd_hash) {

	$db = db_connect();

	if($db) {
		
		$id_query = "SELECT id_student FROM token_forgot_passwd WHERE token=:token";
		$id_statement = $db->prepare($id_query);
		$id_statement->bindValue(':token', $token);
		$id_statement->execute();

		$id_result;
		while($row = $id_statement->fetch(PDO::FETCH_ASSOC))
			$id_result = $row['id_student'];

		$query = "UPDATE STUDENT SET password_student=:passwd WHERE id_student=:id";
		$statement = $db->prepare($query);
		$statement->bindValue(':passwd', $passwd_hash);
		$statement->bindValue(':id', $id_result);
		$statement->execute();

		$delete_query = "DELETE FROM token_forgot_passwd WHERE id_student=:id";
		$delete_statement = $db->prepare($delete_query);
		$delete_statement->bindValue(":id", $id_result);
		$delete_statement->execute();
	}
}

?>
