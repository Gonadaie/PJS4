<?php
require_once('back_office_tools.php');
require once('../model/get_student.php');
//ajout du code en method post sur session_admin ou back_office
function send_unmatch_mail(){
	$array_unmatch = getunmatch();
	foreach ($array_unmatch as $student){
		$result_mail = send_mail_unmatch($student);
		if ($result_mail ==0){
			$fail= $fail+1;
		}
		echo $fail;
	}
	
?>