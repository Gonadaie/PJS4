<?php

require('better_crypt.php');

$new_passwd = strval($_POST['passwd']);
$passwd_hash = better_crypt($new_passwd, 10);
$token = $_POST['token'];

require('../model/change_passwd.php');

change_passwd_for($token, $passwd_hash);



?>
