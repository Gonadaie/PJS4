<?php
/**
 * Run everytime a student dislike someone else.
 * First we test in what year the student is.
 * Then we check if the other student had already like him or not.
 * We run the appropriate query : update if match exist, insert otherwise.
 * ALl the echo are user in js, to know wich page to run next (match or keep
 * up swipe)
 */

require("../model/get_student.php");
require("../model/like_student.php");
require("../model/dislike_student.php");


session_start();

if(isset($_SESSION['id'])){
	$id_student_connected = $_SESSION['id'];
	if (isset($_POST["mail"])){
		$mail_student_disliked = $_POST["mail"];
	}
	$student_connected = get_student_by_id($id_student_connected);
	$student_disliked = get_student_by_email($mail_student_disliked);
}
else {
	$mail_student_disliked = $_POST["mail"];
	$mail_student_connected = $_POST["mail_co"];
	$student_connected = get_student_by_email($mail_student_connected);
	$student_disliked = get_student_by_email($mail_student_disliked);
	$id_student_connected = $student_connected->getId();
	$id_student_disliked = $student_disliked->getId();

}



	$id_student_disliked = $student_disliked->getId();

	if($student_connected->getYear()==1){
		$get_match_first = get_student_match($id_student_disliked, $id_student_connected);

		if($get_match_first>0){
			update_match_first($id_student_disliked, $id_student_connected);
			echo "DISLIKE";
		}
		else{
			insert_match_dislike_first($id_student_connected, $id_student_disliked);
			echo "DISLIKE";
		}
	}

	else{
		$get_match_second = get_student_match($id_student_connected, $id_student_disliked);

		if($get_match_second>0){
			update_match_second($id_student_connected, $id_student_disliked);
			echo "DISLIKE";
		}
		else{
			insert_match_dislike_second($id_student_disliked, $id_student_connected);
			echo "DISLIKE";
		}
	}
