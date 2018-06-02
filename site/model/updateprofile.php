<?php

function getNbMatchs($student) {
	$db = db_connect();

	if($db) {

		if ($student->getYear() == 2){
			$sql = "SELECT count(*) FROM student_match WHERE student_id_god_father =:id and result = true";
			$result = $db->prepare($sql);
			$result -> bindvalue(':id',$student->getId());
			$result->execute();
			$match = $result->fetchColumn();
		}
		else if($student->getYear()==1){
			$sql = "SELECT COUNT (*) from student_match WHERE student_id_god_son =:id and result = true";
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
		$query = "UPDATE student SET description = :newDescription WHERE student_id = :id";
		$statement = $db->prepare($query);
		$statement->bindvalue(':newDescription',$newDescription);
		$statement->bindvalue(':id', $student->getId());
		$statement -> execute();
	}
}


/*if(isset($_POST["image"])){
  $target_dir = "../images/images_student/";
  $file_type = $target_dir . basename($_POST["image"]["name"]);
  $imageFileType = strtolower(pathinfo($file_type,PATHINFO_EXTENSION));
  $target_file = $target_dir .str_replace(".", "", $student->getEmail()).".".$imageFileType;
  $uploadOk = 1;
  $errorMessages = [];


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1)  {
if(file_exists($target_file)){
unlink($target_file);

}
move_uploaded_file($_POST["image"]["tmp_name"], $target_file);
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
$query = "UPDATE student SET pic = :image WHERE student_id = :id";
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
//			$query = "UPDATE student SET description = :inputresume WHERE student_id = :id";
//			$statement = $db->prepare($query);
//			$statement->bindvalue(':inputresume',$resume);
//			$statement->bindvalue(':id', $_SESSION['id']);
//			$statement -> execute();
//			$filename = randfilename();
//			$filepath = "../images/images_student/";
//			$destination = $filepath.$filename;
//			$succesupload = upload('upload_pic', $destination);
//		if ($succesupload){
//			$query_getpic = "SELECT pic from student where student_id = :id";
//			$statement_getpic = $db -> prepare($query_getpic);
//			$statement_getpic -> bindvalue(':id', $_SESSION['id']);
//			$statement_getpic -> execute();
//			while($row = $statement_getpic->fetch(PDO::FETCH_ASSOC)){
//				$oldpicpath = $row['pic'];
//			}
//			if (strcmp($oldpicpath, "../images/images_student/basephoto.jpg")!=0){
//				unlink($oldpicpath);
//			}
//			$query_updatepic = "UPDATE student SET pic = :picpath WHERE student_id = :id";
//			$statement_updatepic = $db-> prepare($query_updatepic);
//			$statement_updatepic -> bindvalue('id:', $_SESSION['id']);
//			$statement_updatepic -> execute();
//
//		}
//			header("location: https://tinder.student.elwinar.com/view/updateprofile.php");
//	}
