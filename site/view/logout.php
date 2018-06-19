<?php 
session_start();
unset( $_SESSION['id'] );
unset( $_COOKIE['fr81_stay_connected'] );
require_once('../model/stay_connected.php');
delete_stay_connected($_SESSION['mail']);
session_destroy(); 
header('Location: ../index.php');
?>
