<?php

require_once("../model/add_adjs.php");

session_start();

if (isset($_POST['mail'])) {
  add_adjs_by_email($_POST['mail'], $_POST['adj1'], $_POST['adj2'], $_POST['adj3']);
}
else{
  add_adjs($_SESSION['id'], $_POST['adj1'], $_POST['adj2'], $_POST['adj3']);
}


header('Location: http://skipti.fr/view/swipe.php');

?>
