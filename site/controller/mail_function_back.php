<?php
require_once('back_office_tools.php');
require_once('../model/get_student.php');
require_once ('../model/random_match.php');
//ajout du code en method post sur session_admin ou back_office
function send_unmatch_mail(){
	$array_unmatch = array();
	$array_unmatch = get_unmatch_student_first_year();
	$array_unmatch = get_unmatched_student_second_year();
	foreach ($array_unmatch as $student){
		$result_mail = send_mail_unmatch($student);
		if ($result_mail ==0){
			$fail= $fail+1;
		}
		echo $fail;
	}
}
	
?>