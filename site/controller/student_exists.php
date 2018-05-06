<?php

	require("better_crypt.php");

	$student_mail =	$_POST['mail'];

	require("../model/student_exists.php");

	if($statement->rowCount()>0) {
		echo(json_encode("NOK"));
	}
	else
		echo(json_encode("FAIL"));

?>
