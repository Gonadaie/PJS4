<?php
require_once('back_office_tools.php');
require_once('../model/get_student.php');
require_once ('../model/random_match.php');
require_once ('send_mail_unmatch.php');
//ajout du code en method post sur session_admin ou back_office
function send_unmatch_mail(){
	$array_unmatch = $array_unmatch_1 = $array_unmatch_2 = array();
	$array_unmatch_1 = get_unmatched_student_first_year();
	$array_unmatch_2 = get_unmatched_student_second_year();
	$array_unmatch = array_merge($array_unmatch_1, $array_unmatch_2);
	foreach ($array_unmatch as $student){
		$result_mail = send_mail_unmatch($student);
		if ($result_mail ==0){
			$fail= $fail+1;
		}
		echo "SUCCESS";
	}
}
send_unmatch_mail();
	
?>