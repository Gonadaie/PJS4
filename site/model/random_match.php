<?php

require_once('db_connect.php');

function get_unmatched_student_first_year(){
$db = db_connect();
if($db) {
  $query = "SELECT student_id, score from student where year = 1 AND NOT EXISTS (SELECT
    student_id_god_son, student_id_god_father from student_match where final = true
    and (student_id_god_son = student_id OR student_id_god_father = student_id)) ORDER BY score";
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
    and (student_id_god_son = student_id OR student_id_god_father = student_id)) ORDER BY score";
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

  $nbFirstStudent = count($unmatched_student_first);
  $nbSecondStudent = count($unmatched_student_second);

  if($nbFirstStudent == $nbSecondStudent){
    for($i = 0; $i<$nbSecondStudent; $i++){
      insert_random_couple($unmatched_student_second[$i],$unmatched_student_first[$i]);
    }
  }

  else if($nbFirstStudent>$nbSecondStudent){
    while(!empty($unmatched_student_first)){
      for($i=0; $i<$nbSecondStudent; $i++){
        insert_random_couple($unmatched_student_second[$i],$unmatched_student_first[0]);
        array_shift($unmatched_student_first);
        if(empty($unmatched_student_first))
          break;
      }
    }
  }

  else if($nbFirstStudent<$nbSecondStudent){
    while(!empty($unmatched_student_second)){
      for($i=0; $i<$nbFirstStudent; $i++){
        insert_random_couple($unmatched_student_second[0],$unmatched_student_first[$i]);
        array_shift($unmatched_student_second);
        if(empty($unmatched_student_second))
          break;
      }
    }
  }
}


function insert_random_couple($id_god_father, $id_god_son){
  $db = db_connect();
  if($db) {
    $query = "INSERT INTO student_match(result, student_id_god_father, student_id_god_son,
      liked_by_god_father, liked_by_god_son, final, final_by_god_father, final_by_god_son)
      VALUES(true, :id_god_father, :id_god_son, 1, 1, true, true, true)";
    $statement = $db->prepare($query);
    $statement->bindValue(':id_god_father', $id_god_father);
    $statement->bindValue(':id_god_son', $id_god_son);
    $statement->execute();
  }
  error_log(print_r("Random match insert", TRUE));
}


 ?>
