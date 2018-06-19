<?php

$SERVER_ADR = "http://localhost";

error_log(print_r("Am I even called ??", TRUE));

if((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || (!empty($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == 'application/x-www-form-urlencoded')) {
	error_log(print_r("ici", TRUE));
}
else {

	session_start();

	error_log(print_r("Current location : " . $_SERVER['PHP_SELF'], TRUE));

	if(!isset($_SESSION['id'])) {

		$old_include = get_include_path();
		set_include_path("/var/www/html/PJS4/site/");
		require('model/stay_connected.php');

		if(isset($_COOKIE['skipti_keeplog'])) {
			if(!is_stay_connected($_COOKIE['skipti_keeplog']))
				header('Location: ' . $SERVER_ADR . '/view/logout.php');
			else
				include('controller/login.php');
		}

		set_include_path($old_include);
	}
	else {
		error_log(print_r("right there bro'", TRUE));
		$location = $_SERVER['PHP_SELF'];
		$sploded_location = explode('/', $location);
		error_log(print_r($sploded_location, TRUE));
		$page = $sploded_location[count($sploded_location) -1];

		error_log(print_r($page, TRUE));

		if(($page == 'index.php' or $page == 'login.php' or $page == 'signup.php') and in_array("view", $sploded_location))
			header('Location: ' . $SERVER_ADR . '/view/updateprofile.php');
	
		//header("Location: " . $SERVER_ADR . "/view/logout.php");
	}
}
?>
