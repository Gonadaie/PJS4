<?php

function get_unmatched_student_first_year(){
$db = db_connect();
if($db) {
  $query = "SELECT student_id, score from student where year = 1 NOT EXISTS (SELECT
    student_id_god_son, student_id_god_father from student_match where final = true
    and (student_id_god_son = student_id OR student_id_god_father = student_id)) ORDER BY score"
    $statement = $db->prepare($query);
    $statement->execute();
    $unmatched_student = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
      array_push($unmatched_student, $row['student_id']);
    }
  }
  return $unmatched_student;
}



function get_unmatched_student_second_year(){
$db = db_connect();
if($db) {
  $query = "SELECT student_id, score from student where year = 2 AND NOT EXISTS (SELECT
    student_id_god_son, student_id_god_father from student_match where final = true
    and (student_id_god_son = student_id OR student_id_god_father = student_id)) ORDER BY score"
    $statement = $db->prepare($query);
    $statement->execute();
    $unmatched_student = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
      array_push($unmatched_student, $row['student_id']);
    }
  }
  return $unmatched_student;
}

function random_match(){
  $unmatched_student_first = get_unmatched_student_first_year();
  $unmatched_student_second = get_unmatched_student_second_year();

}


SELECT P.* from pokemon AS P where id_pokemon IN (SELECT id_poke from poke_type where id_poke = P.id)

SELECT DISTINCT P.*, T.name from pokemon AS P, Poke_type as PT, Type as T where P.id = PT.id_poke and PT.id_poke = T.id group by;

 ?>
