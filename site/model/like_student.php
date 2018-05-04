<?php

function get_match($id1, $id2){
  $query = "SELECT id_student_god_father, id_student_god_son FROM match WHERE id_student_god_father = :id1 AND id_student_god_son = :id2";

  $statement = $db->prepare($query);
  $statement->bindValue(':id1', $id1);
  $statement->bindValue(':id2', $id1);
  $statement->execute();

  return $statement->rowCount();
}

  function update_match($id1, $id2){
    $query_update_match_first = "UPDATE match SET liked_by_god_son = true, result = true, liked_by_god_father = true WHERE id_student_god_father = :id1 AND id_student_god_son = :id2";
    $statement_update_match_first = $db->prepare($query_update_match_first);
    $statement_update_match_first->bindValue(':id1', $id1);
    $statement_update_match_first->bindValue(':id2', $id2);
    $statement_update_match_first->execute();
  }

  function insert_match_first($id1, $id2){
    $query_set_match_first = "INSERT INTO match(id_student_god_son, id_student_god_father, liked_by_god_son) VALUES(:id1,:id2, true)";
    $statement_set_match_first = $db->prepare($query_set_match_first);
    $statement_set_match_first->bindValue(':id1', $id1);
    $statement_set_match_first->bindValue(':id2', $id2);
    $statement_set_match_first->execute();
  }

  function insert_match_second($id1, $id2){
    $query_set_match_first = "INSERT INTO match(id_student_god_son, id_student_god_father, liked_by_god_father) VALUES(:id1,:id2, true)";
    $statement_set_match_first = $db->prepare($query_set_match_first);
    $statement_set_match_first->bindValue(':id1', $id1);
    $statement_set_match_first->bindValue(':id2', $id2);
    $statement_set_match_first->execute();
  }
