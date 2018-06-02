<?php

function getNbMatchs($student) {
	$db = db_connect();

	if($db) {

		if ($student->getYear() == 2){
			$sql = "SELECT count(*) FROM match WHERE id_student_god_father =:id and result = true";
			$result = $db->prepare($sql);
			$result -> bindvalue(':id',$student->getId());
			$result->execute();
			$match = $result->fetchColumn();
		}
		else if($student->getYear()==1){
			$sql = "SELECT COUNT (*) from match WHERE id_student_god_son =:id and result = true";
			$result = $db->prepare($sql);
			$result -> bindvalue(':id',$student->getId());
			$result->execute();
			$match = $result->fetchColumn();
		}
	}
}

function updateDescription($student) {
	$db = db_connect();

	if($db){
		$newDescription = $_POST['description'];
		$query = "UPDATE student SET description = :newDescription WHERE id_student = :id";
		$statement = $db->prepare($query);
		$statement->bindvalue(':newDescription',$newDescription);
		$statement->bindvalue(':id', $student->getId());
		$statement -> execute();
	}
}






/*if(isset($_FILES["fileToUpload"])){
  $target_dir = "../images/images_student/";
  $file_type = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($file_type,PATHINFO_EXTENSION));
  $target_file = $target_dir .str_replace(".", "", $student->getEmail()).".".$imageFileType;
  $uploadOk = 1;
  $errorMessages = [];

  //Check if image is an image
  if(isset($_POST["submit"])){
	  $check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	  if($check!==false){
		  $uploadOk=1;
	  }else{
		  array_push($array:$errorMessssages, var: "Le fichier choisi n'est pas une immage");
		  $uploadOk=0;
	  }
  }

  //Check file size
  if($_FILE["fileToUpload"]["size"]>2000000){
	  array_push($array:$errorMessssages, var: "La taille maximale autorisée est de 2Mb");	  
	  $uploadOk=0;
  }

  //Allow certain file formats
  if($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="jpeg") {
	  array_push($array:$errorMessssages, var: "Seuls les fichiers JPG, JPEG et PNG sont autorisés");	  
	  $uploadOk=0;
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

}

 */






//
//	//UPDATE de la description
//	if(isset($_POST['updatedescribe'])){
//
//			$resume = $_POST['resumestudent'];
//			$query = "UPDATE student SET description = :inputresume WHERE id_student = :id";
//			$statement = $db->prepare($query);
//			$statement->bindvalue(':inputresume',$resume);
//			$statement->bindvalue(':id', $_SESSION['id']);
//			$statement -> execute();
//			$filename = randfilename();
//			$filepath = "../images/images_student/";
//			$destination = $filepath.$filename;
//			$succesupload = upload('upload_pic', $destination);
//		if ($succesupload){
//			$query_getpic = "SELECT pic from student where id_student = :id";
//			$statement_getpic = $db -> prepare($query_getpic);
//			$statement_getpic -> bindvalue(':id', $_SESSION['id']);
//			$statement_getpic -> execute();
//			while($row = $statement_getpic->fetch(PDO::FETCH_ASSOC)){
//				$oldpicpath = $row['pic'];
//			}
//			if (strcmp($oldpicpath, "../images/images_student/basephoto.jpg")!=0){
//				unlink($oldpicpath);
//			}
//			$query_updatepic = "UPDATE student SET pic = :picpath WHERE id_student = :id";
//			$statement_updatepic = $db-> prepare($query_updatepic);
//			$statement_updatepic -> bindvalue('id:', $_SESSION['id']);
//			$statement_updatepic -> execute();
//
//		}
//			header("location: https://tinder.student.elwinar.com/view/updateprofile.php");
//	}
