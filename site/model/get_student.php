<?php
require("../model/db_connect.php");
require("../model/student.php");


function get_student_by_id($id){
  $db = db_connect();
  if($db) {
    $query = "SELECT S.id_student, S.score, S.year, S.surname, S.email, S.pic, S.description, A.wording as adj1, A2.wording as adj2, A3.wording as adj3
  	FROM ADJECTIVE A, ADJECTIVE A2, ADJECTIVE A3, STUDENT S WHERE S.id_student = :id_student AND S.adjective_1 = A.id_adjective AND S.adjective_2 = A2.id_adjective AND S.adjective_3 = A3.id_adjective";

  	$statement = $db->prepare($query);
  	$statement->bindValue(':id_student', $id);
  	$statement->execute();

  	$row = $statement->fetch(PDO::FETCH_ASSOC);
  	$student = new Student($row['surname'], $row['description'],
		$row['year'], $row['email'], $row['pic']);

    $student->setAdjectives($row['adj1'], $row['adj2'], $row['adj3']);
    $student->setScore($row['score']);
    $student->setId($id);

    return $student;

  }
}

function get_student_by_email($email){
  $db = db_connect();
  if($db) {
    $query = "SELECT S.id_student, S.score, S.year, S.surname, S.email, S.pic, S.description, A.wording as adj1, A2.wording as adj2, A3.wording as adj3
    FROM ADJECTIVE A, ADJECTIVE A2, ADJECTIVE A3, STUDENT S WHERE S.email = :email_student AND S.adjective_1 = A.id_adjective AND S.adjective_2 = A2.id_adjective AND S.adjective_3 = A3.id_adjective";


  	$statement = $db->prepare($query);
  	$statement->bindValue(':email_student', $email);
  	$statement->execute();

  	$row = $statement->fetch(PDO::FETCH_ASSOC);
  	$student = new Student($row['surname'], $row['description'],
		$row['year'], $row['email'], $row['pic']);

    $student->setAdjectives($row['adj1'], $row['adj2'], $row['adj3']);
    $student->setId($row['id_student']);
    $student->setScore($row['score']);

    return $student;

  }

}
