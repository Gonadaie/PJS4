<?php
/**
 * Run everytime a student like someone else.
 * First we test in what year the student is.
 * Then we check if the other student had already like him or not.
 * We run the appropriate query : update if match exist, insert otherwise.
 * ALl the echo are user in js, to know witch page to run next (match or keep
 * up swipe)
 */

require("../model/get_student.php");
require("../model/like_student.php");

session_start();
	$id_student_connected = $_SESSION['id'];
	if (isset($_POST["mail"])){
		$mail_student_liked = $_POST["mail"];
	}


	$student_connected = get_student_by_id($id_student_connected);
	$student_liked = get_student_by_email($mail_student_liked);

	$id_student_liked = $student_liked->getId();

	if($student_connected->getYear()==1){
		$get_match_first = get_match($id_student_liked, $id_student_connected);

		if($get_match_first>0){
			update_match($id_student_liked, $id_student_connected);
			require("score.php");
			echo "MATCH";
		}
		else{
			insert_match_first($id_student_connected, $id_student_liked);
			require("score.php");
			echo "LIKE";
		}
	}

	else{
		$get_match_second = get_match($id_student_connected, $id_student_liked);

		if($get_match_second>0){
			update_match($id_student_connected, $id_student_liked);
			require("score.php");
			echo "MATCH";
		}
		else{
			insert_match_second($id_student_liked, $id_student_connected);
			require("score.php");
			echo "LIKE";
		}
	}
