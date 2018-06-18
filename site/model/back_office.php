<?php

require_once('db_connect.php');
require_once("data_crypter.php");

function get_all_student(){
  $db = db_connect();
  $list = array();
  if($db){
    $query = "SELECT email, year FROM student where admin = false ORDER BY year, email";
    $statement = $db->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
      array_push($list, array(decrypt_data($row["email"]), $row["year"]));
    }

  error_log(print_r("Requete fini", TRUE));
  return $list;
}


function get_couples(){
  $db = db_connect();
  if($db) {
    $query = "SELECT S1.email as email1, S2.email as email2, S1.surname as name1,
    S2.surname as name2 FROM student_match as M,
    student as S1, student as S2 where M.student_id_god_father = S1.student_id and M.student_id_god_son = S2.student_id
    and M.final = true";
    $statement = $db->prepare($query);
    $statement->execute();
    $couples = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
      array_push($couples, array(decrypt_data($row['email1']), decrypt_data($row['name1']),
      decrypt_data($row['name2']), decrypt_data($row['email2'])));
    }
  }
  return $couples;
}

?>
