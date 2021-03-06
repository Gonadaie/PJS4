<?php

/**
 * Log a user in if the given login and password match in the database
 * If the credentials match, we create a session
 * If the 'keep me logged' checkbox is checked, we also create a token in the database
 * Then echo 'FIRST' if it's the first time the user logged in in order to redirect him to the adjectives page
 * Or echo 'OK' meaning everything went fine
 * Otherwise, echo 'Fail'
 */
	require("better_crypt.php");

	$student_name =	 explode('.', $_POST['mail'])[0];
	$student_mail =	 $_POST['mail'];
	$password_entered = $_POST['password'];
	$password_hash;
	$validate_account;
	$adj1; //If it's the first connection, adj1 will be null

	require("../model/login.php");

	if(crypt($password_entered, $password_hash) == $password_hash and $validate_account) {

		require_once('../model/stay_connected.php');

		if(isset($_POST['keeplog']) and $_POST['keeplog'] == 'on'){
			$cookie = md5($student_mail . date("Y-m-d-h-i-s"));

			// Delete ancient token
			if(isset($_COOKIE['skipti_keeplog'])) 
				delete_stay_connected($student_mail);

			create_stay_connected_token($cookie, $student_mail);
			setcookie('skipti_keeplog', $cookie);
		}
		else
			delete_stay_connected($student_mail);

		session_start();
		$_SESSION['id'] = $student_id;
		$_SESSION['mail'] = $student_mail;

		if($admin)
			echo "ADMIN";
		else if(is_null($adj1))
			echo "FIRST";
		else
			echo "OK";
	}
	else
		echo "FAIL";

?>
