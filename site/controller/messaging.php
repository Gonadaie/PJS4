<?php

require_once(../model/messaging.php);
session.start();

$previews = array();
$previews = getPreviewConversation($_SESSION['id']);
die(var_dump($previews)
