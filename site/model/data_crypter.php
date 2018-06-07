<?php
function encrypt($data){
	$hash = file_get_contents('..model/.key/key');
	$iv = file_get_contents('..model/.key/vector');
	$data = openssl_encrypt($data, 'aes-256-cbc', $hash, 0,$iv);
}

function decrypt($data){
	$hash = file_get_contents('..model/.key/key');
	$iv = file_get_contents('..model/.key/vector');
	$data = openssl_decrypt($DATA, 'aes-256-cbc', $hash,0,$iv);
}

?>

