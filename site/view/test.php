<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Test de personnalité</title>
	<link rel="stylesheet" href="../styles/main.css">
	<link rel="stylesheet" href="../styles/signup_login.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!--		<fav icon>				-->
	<link rel="apple-touch-icon" sizes="180x180" href="../favicon_package_v0.16/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon_package_v0.16/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon_package_v0.16/favicon-16x16.png">
	<link rel="manifest" href="../favicon_package_v0.16/site.webmanifest">
	<link rel="mask-icon" href="../favicon_package_v0.16/safari-pinned-tab.svg" color="#4152bc">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="theme-color" content="#e6f0f5">

	<style>
		.adj-input {
			display: block;
			text-align: center;
		}

		.title_logo {
			margin-top: 25%;
		}

	</style>
</head>

<body>
	<div class="row fullscreen-height">
		<div id="left-adj-container" class="col-4">
		</div>

		<div class="col-4">
			<div class="title_logo">
				<h1>Qui es-tu ?</h1>
				<h3>Clique sur ce qui te décris le mieux!</h3>
			</div>
			<form method="POST" action="../model/add_adjs.php">
				<input class="adj-input" type="text" name="adj1" onkeypress="return false"></input>
				</br>
				<input class="adj-input" type="text" name="adj2" onkeypress="return false"></input>
				</br>
				<input class="adj-input" type="text" name="adj3" onkeypress="return false"></input>
				</br>
				<input type="submit" value="Valider"></input>
			</form>
		</div>

		<div id="right-adj-container" class="col-4">
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../scripts/test.js"></script>
</body>

</html>
