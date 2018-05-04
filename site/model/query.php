<?php
require("../model/db_connect.php");
require("../model/student.php");


function get_student_by_id($id){
  $db = db_connect();
  if($db) {
    $query= "SELECT surname, description, year, email, pic, score
  	FROM student WHERE id_student = :id_student";

  	$statement = $db->prepare($query);
  	$statement->bindValue(':id_student', $id);
  	$statement->execute();

  	$row = $statement->fetch(PDO::FETCH_ASSOC);
  	$student = new Student($row['surname'], $row['description'],
    NULL, NULL, NULL, $row['year'],
    $row['email'], $row['pic']);

    $student->setScore($row['score']);
    $student->setId($id);

    return $student;

  }
}

function get_student_by_email($email){
  $db = db_connect();
  if($db) {
    $query= "SELECT id_student, surname, description, year, email, pic, score
  	FROM student WHERE email = :email_student";

  	$statement = $db->prepare($query);
  	$statement->bindValue(':email_student', $email);
  	$statement->execute();

  	$row = $statement->fetch(PDO::FETCH_ASSOC);
  	$student = new Student($row['surname'], $row['description'],
    NULL, NULL, NULL, $row['year'],
    $row['email'], $row['pic']);

    $student->setId($row['id_student']);
    $student->setScore($row['score']);

    return $student;

  }
}
