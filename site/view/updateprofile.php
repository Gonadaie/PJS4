<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location: ../view/logout.php');
}

include("../controller/updateprofile.php");
$info_student = json_decode($json_array);

?>
	<!DOCTYPE html>
	<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<title>Profil Other User</title>
		<!--		<CSS>				-->
		<link rel="stylesheet" href="../styles/main.css">
		<link rel="stylesheet" href="../styles/signup_login.css">
		<!--		<font>				-->
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
		<!--		<bootstrap>				-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>

	<body>
		<div class="menu">
			<a href="../view/swipe.php" class="menu_inactive">swipe</a>
			<a href="../view/updateprofile.php" class="menu_inactive">my account</a>
			<a href="#" class="menu_inactive">messages</a>
			<a href="../view/logout.php" class="menu_inactive">log out</a>
		</div>
		<div class="back"></div>
		<form action="#" id="imageForm" method="post" enctype="multipart/form-data">
			<label for="fileToUpload">
					<div class="picture_profile img_profile modify-image"><div class="hover_modify">Modifier la photo</div><img src="<?php echo htmlspecialchars($student->getPic()); ?>" alt=""></div>
 			</label>
			<input type="file" name="fileToUpload" id="fileToUpload">
		</form>

		<div class="cloud_profile"><img src="../images/cloud.svg" alt=""></div>
		<div class="year_email_profile">
			<span class="DUT">DUT
			<?php echo($info_student->year); ?> -</span>

			<?php echo($info_student->email); ?>@etu.parisdescartes.fr</div>
		<div class="stats_profile">
			<div>
				<?php echo($info_student->match); ?> matchs</div>
			<div>0 parainage</div>
		</div>
		<div class="name_profile">
			<?php echo($info_student->name); ?>
		</div>
		<div class="adj_profile">
			<?php echo($info_student->adj); ?>
		</div>
		<div class="description_profile old_description">
			<?php echo htmlspecialchars($info_student->description); ?>
		</div>
		<form method="post" id="changeDescription" action="#">
			<textarea class="description_profile new_description" name="description" rows="4" cols="7" maxlength="280"><?php echo htmlspecialchars($student->getDescription()); ?></textarea>
		</form>
		<div class="edit_profile">
			<img class="edit" src="../images/edit.png" alt="edit">
			<img class="confirm" src="../images/checked.png" alt="edit">
			<img class="cancel" src="../images/cancel-button-3.png" alt="edit">
		</div>
		<?php foreach ($errorMessages as $errorMessage): ?>
		<p>
			<?= $errorMessage ?>
		</p>
		<?php endforeach ?>

		<script src="../scripts/updateprofile.js"></script>
	</body>

	</html>
