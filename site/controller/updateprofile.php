<?php

require("../model/get_student.php");
$mobile = false;

session_start();

if (isset($_POST['mail'])) {
  $student = get_student_by_email($_POST['mail']);
  $mobile = true;
}
else{
  $student = get_student_by_id($_SESSION['id']);
}

require("../model/updateprofile.php");
require("../model/uploadProfilePicture.php");

$nb_matchs = getNbMatchs($student);

if(isset($_POST["description"])){
	if(!empty($_POST["description"])){
		$newDescription = $_POST['description'];
		updateDescription($student, $newDescription);
		$student->setDescription($newDescription);
		if(!$mobile)
			header('Location:http://skipti.fr/view/updateprofile.php');
	}
}

if(isset($_POST["image"])) {
	//$newPic = $_POST["image"];
    uploadProfilePicture($student->getEmail(),$_POST["image"]);

    //'..\images\images_student\alice.png'
    $imagePath1 = "..\images\images_student\sss";
    $imagePath2=str_replace("sss", "", $imagePath1);
    $imageName = $imagePath2 .str_replace(".", "", $student->getEmail()) . ".png";
	//$student->setPic($imageName);
    $student->setPic('..\images\images_student\marinabotnari.png');
}

/*if(isset($_FILES["fileToUpload"])){
	$target_dir = "../images/images_student/";
	$file_type = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($file_type,PATHINFO_EXTENSION));
	$target_file = $target_dir .str_replace(".", "", $student->getEmail()).".".$imageFileType;
	$uploadOk = 1;
	$errorMessages = [];

	// Check if image file is a actual image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			array_push($errorMessages,"Le fichier choisi n'est pas une image");
			$uploadOk = 0;
		}
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 2000000) {
		array_push($errorMessages,"La taille maximale autorisée est de 2Mb");
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		array_push($errorMessages,"Seuls les fichiers JPG, JPEG et PNG sont autorisés");
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 1)  {
		if(file_exists($target_file)){
			unlink($target_file);

		}
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		//Delete EXIF DATA (tibo maj)
		$path = $target_file;
		switch ($imageFileType){
			case "jpg":
			case "jpeg":
				$img = imagecreatefromjpeg($path);
				$imagejpeg($img, $path, 100);
				$imagedestroy ($img);
				break;
			case  "png":
				$img = imagecreatefrompng($path);
				$imagepng($img, $path, 100);
				$imagedestroy ($img);
				break;
		}
		//EnD
		header('Location:http://tinder.student.elwinar.com/view/updateprofile.php');
		$query = "UPDATE student SET pic = :image WHERE id_student = :id";
		$statement = $db->prepare($query);
		$statement->bindvalue(':image', $target_file);
		$statement->bindvalue(':id', $student->getId());
		$statement -> execute();
	}

} */



$array = array('student' => $student->to_array(), 'match' => $nb_matchs);

$json_array = json_encode($array);
if ($mobile == true) {
	echo $json_array;
}
?>
