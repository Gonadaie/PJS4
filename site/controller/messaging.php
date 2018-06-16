<?php

require_once('../model/messaging.php');
session_start();

$previews = array();
$previews = getPreviewConversation($_SESSION['id']);
die(var_dump($previews));
