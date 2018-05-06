<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>Welcome Log In</title>
	<link rel="stylesheet" href="../styles/main.css">
	<link rel="stylesheet" href="../styles/signup_login.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<?php require("../controller/confirm-account.php"); ?>

<body>
	<div class="row fullscreen_height">
		<div class="col-5 right_part ">
			<div class="row fullscreen_height">
				<div class="col-6 offset-3 ">
					<div class="formulaire">
						<div class="title_logo">
							<div><img src="../images/login.png" class="cloud2"></div>

						</div>
						<div>
							<form method="post" onsubmit="return login()">
								<div>
									<div class="space_top">
										<label>Email</label>
									</div>
									<div class="inline">
										<input type="text" name="mail"></input>
									</div>
									<div class="inline etu">
										@etu.parisdescartes.fr
									</div>
								</div>
								<div>
									<div class="space_top"><label>Password</label></div>
									<input type="password" name="password"></input><br>
								</div>
								<div>
									<div class="inline etu2"><input type="checkbox" name="keeplog" id="keeplog">
										<label for="keeplog"><span>Keep me loged in</span></label>
									</div>
									<div class="inline etu2 maxW">
										<a href="forgot_passwd.html">Forgot your password ?</a>
									</div>
								</div>
								<div>
									<input type="submit" value="Login"></input>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-7 left_part2">
			<div class="welcome">
				<div class="big_grey">Welcome</div>
				<div class="big_orange">
					<?php echo htmlspecialchars($_GET['name'],ENT_QUOTES, 'UTF-8') ?>
				</div>
			</div>
		</div>
	</div>
	<script src="../scripts/checkForm.js"></script>
	<script src="../scripts/login.js"></script>
</body>

</html>
