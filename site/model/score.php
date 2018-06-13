<?php

/**
 * Update score of student in database
 * @param integer $id id of the student
 * @param integer $score score of the student
 * @return void
 */
function update_score($id, $score){
	$db = db_connect();
	if($db) {
		$query_update_score= "UPDATE student SET score = :score
		WHERE student_id = :id";
		$statement_update_score = $db->prepare($query_update_score);
		$statement_update_score->bindValue(':id', $id);
		$statement_update_score->bindValue(':score', $score);
		$statement_update_score->execute();
	}
}
