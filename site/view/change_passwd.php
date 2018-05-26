<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Nouveau mot de passe</title>
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
</head>

<body>
	<div class="row fullscreen-height">
		<div class="col-5 right_part ">
			<div class="row fullscreen_height">
				<a class="home-btn" href="/">
						&#139; Home Page</a>
				<div class="col-6 offset-3 ">
					<div class="formulaire">
						<div class="title_logo_password">
							<div><img src="../images/set_up_new_psd.png" class="cloud2"></div>
						</div>
						<p class="psw_size2">Ecris ton nouveau mot de passe pour
						</p>
						<span class="purple psw_size"><?= $_GET['mail'] ?></span>
						<span class="register_conf_psw_mail psw_size">@etu.parisdescartes.fr</span>
						<div>
							<form id="form_changepasswd" method="POST" onsubmit="return verifFormForgot(this)">
								<input name="token" type="hidden" value="<?php echo htmlspecialchars($_GET['token']) ?>" />
								<div class="space_top"><label>Nouveau mot de passe</label></div>
								<input type="password" name="passwd" id="new_password" onblur="checkPassword(this)"></input>
								<p class="error_message" id="password_not_valid">Mot de passe trop court</p>
								<input type="submit" value="Confirm"></input>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-7 left_part upside">

		</div>
	</div>
	<script src="../scripts/checkForm.js"></script>
	<script src="../scripts/login.js"></script>
</body>

</html>
