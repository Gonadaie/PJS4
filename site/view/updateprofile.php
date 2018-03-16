<!DOCTYPE HTML>
<html lang="fr">
<header>
	<meta charset="utf-8" />
	<title>Update profile </title>
	<link rel="stylesheet" href="../styles/main.css">
	<link rel="stylesheet" href="../styles/updateprofile.css">
	<link rel="stylesheet" href="../styles/signup_login.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
</header>
<body>
	<?php include('../model/updateprofile.php') ?>
	<div class="menu">
		<a href="#" class="menu_inactive">swipe</a>
		<a href="#" class="menu_active">my account</a>
		<a href="#" class="menu_inactive">messages</a>
		<a href="#" class="menu_inactive">log out</a>
	</div>
	<div id="mailclasse">
		<p><b>DUT2</b></p><span>alicecapelle@etu.parisdecartes.fr</span>
	</div>
	<div id="stats">
		<h2>12 matchs</h2>
		<h2> 1 filleule</h2>
	</div>
	<div id="present">

		<div class="image" onclick="addpicture()">
				<input type=file class=input_btn name=upload_pic></input>
		</div>
		<div id="background">
		</div>
		<div class="name">
			<center> Alice </center>
		</div>
		<div class="adj">
			<center>Belle-Intelligente-Sensible</center>
		</div>
		<?php echo $description ?>
		<div class="resume" >
			<?php echo $description ?>
		</div>
		<textarea id="inputresume"name="resume" placeholder="Décris toi :)"></textarea>
	</div>
	<div class="buttonupdate" onclick="update()">
	</div>
	<div class="buttonconfirm" onclick="confirm()">
	</div>
	<script src="../scripts/updateprofile.js"></script>
</body>
</html>
