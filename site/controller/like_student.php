<?php
/**
 * Run everytime a student like someone else.
 * First we test in what year the student is.
 * Then we check if the other student had already like him or not.
 * We run the appropriate query : update if match exist, insert otherwise.
 * ALl the echo are user in js, to know wich page to run next (match or keep
 * up swipe)
 */

require("../model/get_student.php");
require("../model/like_student.php");


session_start();

if(isset($_SESSION['id'])){
	$id_student_connected = $_SESSION['id'];
	if (isset($_POST["mail"])){
		$mail_student_liked = $_POST["mail"];
	}
	$student_connected = get_student_by_id($id_student_connected);
	$student_liked = get_student_by_email($mail_student_liked);
}
else {
	$mail_student_liked = $_POST["mail"];
	$mail_student_connected = $_POST["mail_co"];
	$student_connected = get_student_by_email($mail_student_connected);
	$student_liked = get_student_by_email($mail_student_liked);
	$id_student_connected = $student_connected->getId();
}



	$id_student_liked = $student_liked->getId();

	if($student_connected->getYear()==1){
		$get_match_first = array();
		$get_match_first = get_student_match($id_student_liked, $id_student_connected);

		if($get_match_first[0]>0){
			update_student_match_first($id_student_liked, $id_student_connected);
			require("score.php");
			$match_result = get_match_result($id_student_liked, $id_student_connected);
			error_log(print_r($match_result, TRUE));
			if($match_result){
				insert_conversation($id_student_liked, $id_student_connected);
				echo "MATCH";
			}
			else
				echo "LIKE";
		}
		else{
			insert_match_first($id_student_connected, $id_student_liked);
			require("score.php");
			echo "LIKE";
		}
	}

	else{
		$get_match_second = array();
		$get_match_second = get_student_match($id_student_connected, $id_student_liked);

		if($get_match_second[0]>0){
			update_student_match_second($id_student_connected, $id_student_liked);
			require("score.php");
			$match_result =get_match_result($id_student_liked, $id_student_connected);
			error_log(print_r($match_result, TRUE)); 
			if($match_result){
				insert_conversation($id_student_liked, $id_student_connected);
				echo "MATCH";
			}
			else
				echo "LIKE";

		}
		else{
			insert_match_second($id_student_liked, $id_student_connected);
			require("score.php");
			echo "LIKE";
		}
	}
