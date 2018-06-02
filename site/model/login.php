<?php

require_once("db_connect.php");
require_once("get_student.php");

$db = db_connect();

if($db) {
	$student = get_student_by_email_one_adj($student_mail);

	$password_hash = $student->getPassword();
	$student_id = $student->getId();
	$validate_account = $student->getValidateAccount();
	$adj1 = $student->getAdj1();


}
