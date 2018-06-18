<?php

	require("better_crypt.php");
	require_once("../model/data_crypter.php");

	$student_mail =	encrypt_data($_POST['mail']);

	require("../model/student_exists.php");

	if($statement->rowCount()>0)
		echo "NOK";
	else
		echo "OK";




?>
