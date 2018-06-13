<?php

require('db_connect.php');
require_once("data_crypter.php");

function get_all_student(){
  $db = db_connect();
  $list = array();
  if($db){
    $query = "SELECT email, year FROM student ORDER BY year, email";
    $statement = $db->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
      array_push($list, array($row["email"], $row["year"]));
    }

  error_log(print_r("Requete fini", TRUE));
  return $list;
}

function get_couples(){
  $db = db_connect();
  if($db) {
    $query = "SELECT S1.email as email1, S2.email as email2 FROM student_match as M,
    student as S1, student as S2 where M.student_id_god_father = S1.student_id and M.student_id_god_son = S2.student_id
    and M.final = true";
    $statement = $db->prepare($query);
    $statement->execute();
    $couples = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
      array_push($couples, decrypt_data($row['email1']));
      array_push($couples, decrypt_data($row['email2']));
    }
  }
  return $couples;
}

?>
