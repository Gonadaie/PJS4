<?php

/**
 * Get student_match between to student in database
 * @param integer $id id of the first student
 * @param integer $id id of the second student
 * @return integer the number of row found in the table
 */
function get_student_match($id1, $id2){
  $db = db_connect();
  if($db) {
    $query = "SELECT student_id_god_father, student_id_god_son, liked_by_god_father, liked_by_god_son FROM student_match WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";


    $statement = $db->prepare($query);
    $statement->bindValue(':id1', $id1);
    $statement->bindValue(':id2', $id2);

    $statement->execute();

    $result = array();

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $result[] = $statement->rowCount();
    $result[] = $row['liked_by_god_son'];
    $result[] = $row['liked_by_god_father'];
    return $result;
  }
}

function get_match_result($id1,$id2){
  $db = db_connect();
  if($db) {
    $query = "SELECT result FROM student_match WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";

    $statement = $db->prepare($query);
    $statement->bindValue(':id1', $id1);
    $statement->bindValue(':id2', $id2);

    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $result = $row['result'];
  }
  return $result;
}

function update_match_result($id1,$id2){
  $db = db_connect();
  if($db) {
    $query = "UPDATE student_match set result=true WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";

    $statement = $db->prepare($query);
    $statement->bindValue(':id1', $id1);
    $statement->bindValue(':id2', $id2);

    $statement->execute();

}
}

/**
 * Update student_match between two student in database
 * @param integer $id id of the first student
 * @param integer $id id of the second student
 * @return void
 */
  function update_student_match($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_update_match_first = "UPDATE student_match SET liked_by_god_son = 1, result = true, liked_by_god_father = 1 WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";
      $statement_update_match_first = $db->prepare($query_update_match_first);
      $statement_update_match_first->bindValue(':id1', $id1);
      $statement_update_match_first->bindValue(':id2', $id2);
      $statement_update_match_first->execute();
    }
  }

  function update_student_match_first($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_update_match_first = "UPDATE student_match SET liked_by_god_son = 1 WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";
      $statement_update_match_first = $db->prepare($query_update_match_first);
      $statement_update_match_first->bindValue(':id1', $id1);
      $statement_update_match_first->bindValue(':id2', $id2);
      $statement_update_match_first->execute();
    }
  }


  function update_student_match_second($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_update_match_second = "UPDATE student_match SET liked_by_god_father = 1 WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";
      $statement_update_match_first = $db->prepare($query_update_match_second);
      $statement_update_match_first->bindValue(':id1', $id1);
      $statement_update_match_first->bindValue(':id2', $id2);
      $statement_update_match_first->execute();
    }
  }

  /**
   * Insert a student_match between two student in database.
   * Use it when the student connected is in year 1.
   * @param integer $id id of the first student
   * @param integer $id id of the second student
   * @return void
   */
  function insert_match_first($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_set_match_first = "INSERT INTO student_match(student_id_god_son, student_id_god_father,
        liked_by_god_son) VALUES(:id1,:id2, 1)";
      $statement_set_match_first = $db->prepare($query_set_match_first);
      $statement_set_match_first->bindValue(':id1', $id1);
      $statement_set_match_first->bindValue(':id2', $id2);
      $statement_set_match_first->execute();
    }
  }

  /**
   * Insert a student_match between two student in database.
   * Use it when the student connected is in year 2.
   * @param integer $id id of the first student
   * @param integer $id id of the second student
   * @return void
   */
  function insert_match_second($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_set_match_first = "INSERT INTO student_match(student_id_god_son, student_id_god_father, liked_by_god_father) VALUES(:id1,:id2, 1)";
      $statement_set_match_first = $db->prepare($query_set_match_first);
      $statement_set_match_first->bindValue(':id1', $id1);
      $statement_set_match_first->bindValue(':id2', $id2);
      $statement_set_match_first->execute();
    }
  }



  /**
   * Insert a new conversation between two student in database.
   * Use it when students match
   * @param integer $id id of the first student
   * @param integer $id id of the second student
   * @return void
   */
  function insert_conversation($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_set_conversation = "INSERT INTO conversation(student_1, student_2)
      VALUES(:id1,:id2)";
      $statement_set_conversation = $db->prepare($query_set_conversation);
      $statement_set_conversation->bindValue(':id1', $id1);
      $statement_set_conversation->bindValue(':id2', $id2);
      $statement_set_conversation->execute();
    }
  }
