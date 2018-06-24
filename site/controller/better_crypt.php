<?php
/**
 * @brief 	Encrypt a string using the blowfish method
 * @param input		The string to encrypt
 * @param rounds	Number of time the strings will be encrypted
 * @return The hash of the rounds times encrypted string
 */
function better_crypt($input, $rounds = 7) {
	$salt = "";
	$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
	for($i=0; $i < 22; $i++) {
		$salt .= $salt_chars[array_rand($salt_chars)];
	}
	return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
}
