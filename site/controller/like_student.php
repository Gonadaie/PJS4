<?php

require("../model/get_student.php");
require("../model/like_student.php");

session_start();
	$id_student_connected = $_SESSION['id'];
	if (isset($_POST["mail"])){
		$mail_student_liked = $_POST["mail"];
	}

	error_log(print_r($id_student_connected, TRUE));
	error_log(print_r($mail_student_liked , TRUE));

	$student_connected = get_student_by_id($id_student_connected);
	$student_liked = get_student_by_email($mail_student_liked);


	if($student_connected->getYear()==1){
		$get_match_first = get_match($student_liked->getId(), $student_connected->getId());

		if($get_match_first>0){
			update_match($student_liked->getId(), $student_connected->getId());
			echo("MATCH");
		}
		else{
			insert_match_first($student_connected->getId(), $student_liked->getId());
			echo("LIKE");
		}
	}

	else{

		$get_match_second = get_match($student_connected->getId(), $student_liked->getId());


		if($get_match_second>0){
			update_match($student_connected->getId(), $student_liked->getId());
			require("../model/score.php");
			echo("MATCH");
		}
		else{

			insert_match_second($student_liked->getId(), $student_connected->getId());
			echo("LIKE");
		}
	}
