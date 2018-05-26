<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Inscription fini</title>
	<link rel="stylesheet" href="../styles/signup_login.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="../styles/main.css">
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

	<div class="row fullscreen_height">
		<div class="col-7 left_part ">
		</div>
		<div class="col-5 right_part">
			<div class="row fullscreen_height">
				<div class="col-10 offset-1 formulaire text_center">
					<div class="title_logo">
						<div><img src="../images/singUp.png" class="cloud2"></div>

					</div>
					<div>
						<div>Un email de confirmation a été envoyé à</div>
						<span class="purple"><?php echo $_GET['mail']?></span>
						<span class="register_conf_mail">@etu.parisdescartes.fr</span>
						</br>
						</br>
						</br>
						<a href="/">Home page</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
