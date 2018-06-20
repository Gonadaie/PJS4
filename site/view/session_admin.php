<?php

if(!isset($_SESSION['id']))
{
    header('Location: ../view/logout.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<title>Admin</title>
		<link rel="stylesheet" href="../styles/session_admin.css">
		<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>

	<body>
		<div class="menu">
			<a href="../view/logout.php" >log out</a>
		</div>
    <form id="formgetallstudent" action="../controller/get_all_student.php" method="get"></form>
    <form id="formgetallcouples" action="../controller/get_couples.php" method="get"></form>
    <form id="formgetallunsub" action="../view/list_unsubs.html" method="get"></form>
    <form id="formgmailunsub" action="../view/relance_mail_unsubs.html" method="get"></form>
    <form id="formrandomunsub" action="../view/match_unsubs.html" method="get"></form>
		<form action="" method="POST">
			<div id="export_part">
				<div id="export">Export CSV</div>
				<div id="button_export">
				    <input type="submit" id="list_student" value="Liste de tous les étudiants inscrit" form="formgetallstudent"></input>
				    <input type="submit" id="list_match" value="Liste des parrainages" form="formgetallcouples"></input>
					<input type="submit" id="list_unsubscribe" value="Liste des étudiants non inscrit" form="formgetallunsub"></input>
				</div>
			</div>
			<div id="action_match_part">
				<div id="action_match">Action de match</div>
				<div id="button_actionb">
					<input type="submit" id="forced_matchunsub" value="Matcher les étudiants non-inscrits" form="formrandomunsub"></input>
					<input type="button" id="match_unmatchstudent" onclick="ajax_random_match()" value=" Matcher les étudiants non appareillés"></input>
				</div>
			</div>
			<div id="envoi_mail_part">
			<div id="envoi_mail">Envoi d'emails</div>
				<div id="button_mail">
					<input type="submit" id="relance_unsubscribe" value="Relancer par mail les étudiants non inscrit" form="formgmailunsub"></input>
					<input type="button" id="recap_student"onclick="ajax_mail_summary_couples()" value="Envoyer un mail récapitulatif aux étudiants"></input>
					<input type="button" id="relance_unmatch" onclick="ajax_mail_unmatch()" value="Relancer par mail les étudiants non appareillés"></input>
				</div>
			</div>
		</form>
		<script src="../scripts/session_admin.js"></script>
	</body>
</html>
