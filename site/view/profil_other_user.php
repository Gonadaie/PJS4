<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: ../view/logout.php');
}
require("../controller/profil_other_user.php");
$info_student = json_decode($json_array);?>

	<!DOCTYPE html>
	<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<title>
			<?php echo('Profil de ' . $info_student->name) ?>
		</title>
		<!--		<CSS>				-->
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/signup_login.css">
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
			<a href="../view/swipe.php" class="menu_inactive">swipe</a>
			<a href="../view/updateprofile.php" class="menu_inactive">mon compte</a>
			<a href="#" class="menu_inactive">messages</a>
			<a href="../view/logout.php" class="menu_inactive">log out</a>
		</div>
		<div class="back"></div>
		<div class="picture_profile img_profile"><img src="<?php echo htmlspecialchars($info_student->pic); ?> " alt=""></div>
		<div class="cloud_profile"><img src="../images/cloud.svg" alt=""></div>
		<div class="year_email_profile">
			<span class="DUT">DUT
			<?php echo($info_student->year); ?> -</span>

			<?php echo($info_student->email);  ?>@etu.parisdescartes.fr</div>
		<div class="stats_profile">
			<div>
				<?php echo($info_student->match);  ?> matchs</div>
			<div>0 parrainage</div>
		</div>
		<div class="name_profile">
			<?php echo($info_student->name);  ?>
		</div>
		<div class="adj_profile">
			<?php echo($info_student->adj);  ?>
		</div>
		<div class="description_profile">
			<?php echo htmlspecialchars($info_student->description); ?>
		</div>
	</body>

	</html>
