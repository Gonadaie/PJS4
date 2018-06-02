<?php

require_once("../model/add_adjs.php");

session_start();

add_adjs($_SESSION['id'], $_POST['adj1'], $_POST['adj2'], $_POST['adj3']);


header('Location: http://tinder.student.elwinar.com/view/swipe.php');

?>
