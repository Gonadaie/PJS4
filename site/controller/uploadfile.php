<?php 

function upload($index,$destination,$maxsize = FALSE, $extensions=FALSE)
{
	if(!isset($_FILES[$index]) OR $_FILES[$index]['error'] >0)return FALSE;
	
	if($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
	$path_part = pathinfo ($_FILES[$index]["name"]);
	if($extensions !=FALSE AND !in_array($path_parts['extension'], $extensions)) return FALSE;
	
	return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

function randfilename($length = 10){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}