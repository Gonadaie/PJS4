<?php

require_once('../model/messaging.php');
require_once('../model/get_student.php');
session_start();

$pic_menu = get_picture_student($_SESSION['id']);

$previews = array();
$previews = getPreviewConversation($_SESSION['id']);
die(var_dump($previews));
