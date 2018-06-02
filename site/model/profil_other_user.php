<?php
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
