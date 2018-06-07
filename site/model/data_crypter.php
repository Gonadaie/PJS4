<?php
function encrypt_data($data){
	$hash = file_get_contents('.key/key');
	$iv = file_get_contents('.key/vector');
	$complied_data = openssl_encrypt($data, 'aes-256-cbc', $hash, 0,$iv);
	return $complied_data;
}

function decrypt_data($data){
		$hash = file_get_contents('.key/key');
		$iv = file_get_contents('.key/vector');
		$complied_data = openssl_decrypt($data, 'aes-256-cbc', $hash,0,$iv);
		return $decrypted_data;
}

?>

