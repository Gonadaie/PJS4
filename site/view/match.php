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
		<title>That's a match !</title>
		<!--		<CSS>				-->
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/signup_login.css">
		<!--		<font>				-->
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
			<a href="swipe.php" class="menu_active">swipe</a>
			<a href="../view/updateprofile.php" class="menu_inactive">my account</a>
			<a href="messaging.php" class="menu_inactive">messages</a>
			<a href="../view/logout.php" class="menu_inactive">log out</a>
		</div>
		<div class="vertical_center">
			<div class="container">
				<div class="row">
					<div class="col-4 vertical_center">
						<div class="match_talk">
							<a href="messaging.php"><img src="../images/Talk.png" alt="talk"></a>
						</div>

					</div>
					<div class="col-4">
						<div class="circle_back">
							<div class="circle_front">
								<div class="circle_img"><img class="black_and_wite" src="../images/images_student/alice.png" alt=""></div>
							</div>
						</div>
						<a href="profile_other_user.php?email=<?= $_POST['mail']?>"><img class="black_and_wite" src="<?= $_POST['pic']?>" alt=""></a>
					</div>
					<div class="col-4 vertical_center">
						<div class="match_continue  pull-right">
							<a href="swipe.php"><img src="../images/continue.png" alt="continue"></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="match_slogan col-12">Votre histoire commence ici.</div>
				</div>
			</div>
		</div>

	</body>

	</html>
