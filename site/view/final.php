<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: ../view/logout.php');
}
?>
	<!DOCTYPE html>
	<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<title>You Find The Right One</title>
		<!--		<CSS>				-->
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/signup_login.css">
		<link rel="stylesheet" href="../styles/style.css">
		<!--		<font>				-->
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
		<!--		<bootstrap>				-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!--		<fav icon>				-->
		<link rel="apple-touch-icon" sizes="180x180" href="../favicon_package_v0.16/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="../favicon_package_v0.16/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="../favicon_package_v0.16/favicon-16x16.png">
		<link rel="manifest" href="../favicon_package_v0.16/site.webmanifest">
		<link rel="mask-icon" href="../favicon_package_v0.16/safari-pinned-tab.svg" color="#4152bc">
		<meta name="msapplication-TileColor" content="#2b5797">
		<meta name="theme-color" content="#e6f0f5">
	</head>

	<body>
		<div class="menu">
			<a href="#" class="menu_inactive">swipe</a>
			<a href="../view/updateprofile.php" class="menu_inactive">my account</a>
			<a href="#" class="menu_active">messages</a>
			<a href="../view/logout.php" class="menu_inactive">log out</a>
		</div>
		<div class="row ">
			<div class="col-3 final_section">
				<!--lien vers le profile-->
				<div class="final_title"><a href="#">parrain</a></div>
				<!-- ou maraine selon le profile-->
				<div><img src="../images/alice.png" alt=""></div>
			</div>

			<div class="col-3 offset-6 final_section">
				<!--lien vers le profile-->
				<div class="final_title"><a href="#">filleul</a></div>
				<!--ou fieule selon le profile-->
				<div><img src="../images/magne.png" alt=""></div>
			</div>
			<div class="slogan2">You find the right one.</div>
		</div>
	</body>

	</html>
