<?php
require_once('back_office_tools.php');
require_once('../model/get_student.php');
require_once ('../model/random_match.php');
require_once ('send_mail_unmatch.php');
//ajout du code en method post sur session_admin ou back_office
function send_unmatch_mail(){
	$array_unmatch = array();
	$array_unmatch_1 = array();
	$array_unmatch_2 = array();
	$array_unmatch_1 = get_unmatched_student_first_year();
	$array_unmatch_2 = get_unmatched_student_second_year();
	error_log(print_r($array_unmatch_1[0][1], TRUE));
	$student1 = $array_unmatch_1[0];
	$student2 = $array_unmatch_2[0];
	foreach ($array_unmatch_1 as $student){
		$result_mail = send_mail_unmatch($student, 1);
		if ($result_mail ==0){
			$fail= $fail+1;
		}
	}
	foreach ($array_unmatch_2 as $student){
		$result_mail =  send_mail_unmatch($student,2);
		if ($result_mail ==0){
			$fail = $fail + 1;
		}
	}
	echo strval($fail);
}
send_unmatch_mail();
	
?>