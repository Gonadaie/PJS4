<?php

function get_couples(){
  $db = db_connect();
  if($db) {
    $query = "SELECT M.student_id_god_father, M.student_id_god_son, S1.email, S2.email FROM student_match as M,
    student as S1, student as S2 where M.student_id_god_father = S1.student_id and M.student_id_god_son = S2.student_id
    and where M.final = true";
    $statement = $db->prepare($query);
    $statement->execute();
    $couples = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
      array_push($couples, $row['student_id_god_father']);
      array_push($couples, $row['student_id_god_son']);
    }
  }
  return $couples;
}

?>
