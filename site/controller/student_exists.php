<?php

	require("better_crypt.php");

	$student_mail =	$_POST['mail'];

	require("../model/student_exists.php");

	if($statement->rowCount()>0)
		echo "NOK";
	else if($statement->rowCount()<0)
		echo "OK";
	else {
		echo "FAIL"
	}

?>
