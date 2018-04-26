<?php
require("../model/db_connect.php");
require("../model/student.php");

$db = db_connect();
session_start();

if($db) {
		
	//Id of the two student. One come from the session, we get the other one from a post method of the swipe page
	$id_student_connected = $_SESSION['id'];

	$mail_student_liked = $_POST['mail_student_liked'];
	var_dump($_POST['mail_student_liked']);
	var_dump($mail_student_liked);

	//We build a student object. That's the student curently connected
	$query_get_student_connected = "SELECT S.year
	FROM student S WHERE S.id_student = :id_student_connected";
	
	$statement_get_student_connected = $db->prepare($query_get_student_connected);
	$statement_get_student_connected->bindValue(':id_student_connected', $id_student_connected);
	$statement_get_student_connected->execute();	

	$row_connected = $statement_get_student_connected->fetch(PDO::FETCH_ASSOC);
	$student_connected = new Student(NULL, NULL, NULL, NULL, NULL, $row_connected['year'], NULL, NULL);


	//We build a student object. That's the student who's liked
	$query_get_student_liked = "SELECT S.year, S.id_student
	FROM student S WHERE S.email = :mail_student_liked";
	
	$statement_get_student_liked = $db->prepare($query_get_student_liked);
	$statement_get_student_liked->bindValue(':mail_student_liked', $mail_student_liked);
	$statement_get_student_liked->execute();	

	$row_liked = $statement_get_student_liked->fetch(PDO::FETCH_ASSOC);
	$student_likde = new Student(NULL, NULL, NULL, NULL, NULL, $row_liked['year'], NULL, NULL);
	$id_student_liked = $row_liked['id_student'];

	if($student_connected->getYear()==1){
		//Now we search if a match exist 
		$query_get_match_first = "UPDATE id_student_god_father, id_student_god_son FROM match WHERE id_student_god_father = :id_student_liked AND id_student_god_son = :id_student_connected";

		$statement_get_match_first = $db->prepare($query_get_match_first);
		$statement_get_match_first->bindValue(':id_student_liked', $id_student_liked);
		$statement_get_match_first->bindValue(':id_student_connected', $id_student_connected);
		$statement_get_match_first->execute();

		if($statement_get_match_first->rowCount()>0){
			//cela signifie que les deux personnes se sont likée. Result passe à true, on redirige vers la page de match
			$query_update_match_first = "UPDATE match set liked_by_god_son = true and result = true WHERE id_student_god_father = :id_student_liked AND id_student_god_son = :id_student_connected";
			$statement_update_match_first = $db->prepare($query_update_match_first);
			$statement_update_match_first->bindValue(':id_student_liked', $id_student_liked);
			$statement_update_match_first->bindValue(':id_student_connected', $id_student_connected);
			$statement_update_match_first->execute();
			echo("MATCH");
		}
		else{
			$query_set_match_first = "INSERT INTO match(id_student_god_son, id_student_god_father, liked_by_god_son) VALUES(:id_student_connected,:id_student_liked, true)";
			$statement_set_match_first = $db->prepare($query_set_match_first);
			$statement_set_match_first->bindValue(':id_student_liked', $id_student_liked);
			$statement_set_match_first->bindValue(':id_student_connected', $id_student_connected);
			$statement_set_match_first->execute();
			//on créer le match. Retour au swipe
			echo("LIKE");
		}
	}

	else{
		$query_get_match_second = "UPDATE id_student_god_father, id_student_god_son FROM match WHERE id_student_god_father = :id_student_connected AND id_student_god_son = :id_student_liked";

		$statement_get_match_second = $db->prepare($query_get_match_first);
		$statement_get_match_second->bindValue(':id_student_liked', $id_student_liked);
		$statement_get_match_second->bindValue(':id_student_connected', $id_student_connected);
		$statement_get_match_second->execute();

		if($statement_get_match_second->rowCount()>0){
			//cela signifie que les deux personnes se sont likée. Result passe à true, on redirige vers la page de match
			$query_update_match_second= "UPDATE match set liked_by_god_father = true and result = true WHERE id_student_god_father = :id_student_connected AND id_student_god_son = :id_student_liked";
			$statement_update_match_second = $db->prepare($query_update_match_first);
			$statement_update_match_second->bindValue(':id_student_liked', $id_student_liked);
			$statement_update_match_second->bindValue(':id_student_connected', $id_student_connected);
			$statement_update_match_second->execute();
			echo("MATCH");
		}
		else{
			$query_set_match_first = "INSERT INTO match(id_student_god_son, id_student_god_father, liked_by_god_father) VALUES(:id_student_connected,:id_student_liked, true)";
			$statement_set_match_first = $db->prepare($query_set_match_first);
			$statement_set_match_first->bindValue(':id_student_liked', $id_student_liked);
			$statement_set_match_first->bindValue(':id_student_connected', $id_student_connected);
			$statement_set_match_first->execute();
			//on créer le match. Retour au swipe
			echo("LIKE");
		}
	}
}	








