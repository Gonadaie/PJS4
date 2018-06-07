<?php
require_once("../model/db_connect.php");
require("../model/student.php");
require("../model/data_crypter.php")


function get_student_by_id_no_adj($id){
  $db = db_connect();
  if($db) {
    $query = "SELECT S.student_id, S.score, S.year, S.surname, S.email, S.pic, S.description
        FROM STUDENT S WHERE S.student_id = :student_id";

        $statement = $db->prepare($query);
        $statement->bindValue(':student_id', $id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $student = new Student(decrypt($row['surname']), decrypt($row['description']),
                $row['year'], decrypt($row['email']), $row['pic']);
    $student->setScore($row['score']);
    $student->setId($id);

    return $student;

  }
}

function get_student_by_id_one_adj($id){
  $db = db_connect();
  if($db) {
    $query = "SELECT S.student_id, S.validate_account, S.student_password, S.score, S.year, S.surname, S.email, S.pic, S.description, S.adjective_1
        FROM STUDENT S WHERE S.student_id = :student_id";

        $statement = $db->prepare($query);
        $statement->bindValue(':student_id', $id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $student = new Student(decrypt($row['surname']), decrypt($row['description']),
                $row['year'], decrypt($row['email']), $row['pic']);

    $student->setAdjectiveOne($row['adjective_1']);
    $student->setScore($row['score']);
    $student->setId($id);
    $student->setPassword($row['student_password']);
    $student->setValidateAccount($row['validate_account']);

    return $student;

  }
}

function get_student_by_id($id){
  $db = db_connect();
  if($db) {
    $query = "SELECT S.student_id, S.validate_account, S.student_password, S.score, S.year, S.surname, S.email, S.pic, S.description, A.wording as adj1, A2.wording as adj2, A3.wording as adj3
        FROM ADJECTIVE A, ADJECTIVE A2, ADJECTIVE A3, STUDENT S WHERE S.student_id = :student_id AND S.adjective_1 = A.id_adjective AND S.adjective_2 = A2.id_adjective AND S.adjective_3 = A3.id_adjective";

        $statement = $db->prepare($query);
        $statement->bindValue(':student_id', encrypt($id));
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $student = new Student(decrypt($row['surname']), decrypt($row['description']),
                $row['year'], decrypt($row['email']), $row['pic']);

    $student->setAdjectives($row['adj1'], $row['adj2'], $row['adj3']);
    $student->setScore($row['score']);
    $student->setId($id);
    $student->setPassword($row['student_password']);
    $student->setValidateAccount($row['validate_account']);

    return $student;

  }



function get_student_by_email_no_adj($email){
  $db = db_connect();
  if($db) {
    $query = "SELECT S.student_id, S.score, S.year, S.surname, S.email, S.pic, S.description
    FROM STUDENT S WHERE S.email = :student_email";

        $statement = $db->prepare($query);
        $statement->bindValue(':student_email', encrypt($email));
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $student = new Student(decrypt($row['surname']), decrypt($row['description']),
                $row['year'], decrypt($row['email']), $row['pic']);
    $student->setId($row['student_id']);
    $student->setScore($row['score']);

    return $student;
  }
}

function get_student_by_email($email){
  $db = db_connect();
  if($db) {
    $query = "SELECT S.student_id, S.validate_account, S.student_password, S.score, S.year, S.surname, S.email, S.pic, S.description, A.wording as adj1, A2.wording as adj2, A3.wording as adj3
    FROM ADJECTIVE A, ADJECTIVE A2, ADJECTIVE A3, STUDENT S WHERE S.email = :student_email AND S.adjective_1 = A.id_adjective AND S.adjective_2 = A2.id_adjective AND S.adjective_3 = A3.id_adjective";


        $statement = $db->prepare($query);
        $statement->bindValue(':student_email', encrypt($email));
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $student = new Student(decrypt($row['surname']), decrypt($row['description']),
                $row['year'], decrypt($row['email']), $row['pic']);

    $student->setAdjectives($row['adj1'], $row['adj2'], $row['adj3']);
    $student->setId($row['student_id']);
    $student->setScore($row['score']);
    $student->setPassword($row['student_password']);
    $student->setValidateAccount($row['validate_account']);
    return $student;

  }

  function get_student_by_email_one_adj($email){
    $db = db_connect();
    if($db) {
      $query = "SELECT S.student_id, S.validate_account, S.student_password, S.score, S.year, S.surname, S.email, S.pic, S.description, S.adjective_1, S.admin
      FROM STUDENT S WHERE S.email = :student_email";

        $statement = $db->prepare($query);
        $statement->bindValue(':student_email', encrypt($email));
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $student = new Student(decrypt($row['surname']), decrypt($row['description']),
                $row['year'], decrypt($row['email']), $row['pic']);

      $student->setAdjectiveOne($row['adjective_1']);
      $student->setId($row['student_id']);
      $student->setScore($row['score']);
      $student->setPassword($row['student_password']);
      $student->setValidateAccount($row['validate_account']);
      $student->setAdmin($row['admin']);
      error_log(print_r($row['admin'], TRUE));
      return $student;

    }
}

?>
