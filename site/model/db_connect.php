<?php
function db_connect(){
	$host_db='localhost';
	$name_db='tinder';
	$user_db='tinder';
	$pass_db='tinder123';

	$db;
	try{
		$db = new PDO("pgsql:host=".$host_db.";dbname=".$name_db."", "".$user_db."", "".$pass_db."") or die(print_r($db->errorInfo()));
		$db->exec("SET NAMES utf8");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch(Exeption $e){
		die("Erreur! ".$e->getMessage());
	}
	return $db;
}
