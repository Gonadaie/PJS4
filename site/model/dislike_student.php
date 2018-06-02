<?php


/**
 * Update match between two student in database
 * @param integer $id id of the first student
 * @param integer $id id of the second student
 * @return void
 */
  function update_match_first($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_update_match_first = "UPDATE student_match SET liked_by_god_son = 0 WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";
      $statement_update_match_first = $db->prepare($query_update_match_first);
      $statement_update_match_first->bindValue(':id1', $id1);
      $statement_update_match_first->bindValue(':id2', $id2);
      $statement_update_match_first->execute();
    }
  }

  /**
   * Update match between two student in database
   * @param integer $id id of the first student
   * @param integer $id id of the second student
   * @return void
   */
    function update_match_second($id1, $id2){
      $db = db_connect();
      if($db) {
        $query_update_match_second = "UPDATE student_match SET liked_by_god_father = 0 WHERE student_id_god_father = :id1 AND student_id_god_son = :id2";
        $statement_update_match_second = $db->prepare($query_update_match_second);
        $statement_update_match_second->bindValue(':id1', $id1);
        $statement_update_match_second->bindValue(':id2', $id2);
        $statement_update_match_second->execute();
      }
    }

  /**
   * Insert a match between two student in database.
   * Use it when the student connected is in year 1.
   * @param integer $id id of the first student
   * @param integer $id id of the second student
   * @return void
   */
  function insert_match_dislike_first($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_set_match_first = "INSERT INTO student_match(student_id_god_son, student_id_god_father, liked_by_god_son) VALUES(:id1,:id2, 0)";
      $statement_set_match_first = $db->prepare($query_set_match_first);
      $statement_set_match_first->bindValue(':id1', $id1);
      $statement_set_match_first->bindValue(':id2', $id2);
      $statement_set_match_first->execute();
    }
  }

  /**
   * Insert a match between two student in database.
   * Use it when the student connected is in year 2.
   * @param integer $id id of the first student
   * @param integer $id id of the second student
   * @return void
   */
  function insert_match_dislike_second($id1, $id2){
    $db = db_connect();
    if($db) {
      $query_set_match_first = "INSERT INTO student_match(student_id_god_son, student_id_god_father, liked_by_god_father) VALUES(:id1,:id2, 0)";
      $statement_set_match_first = $db->prepare($query_set_match_first);
      $statement_set_match_first->bindValue(':id1', $id1);
      $statement_set_match_first->bindValue(':id2', $id2);
      $statement_set_match_first->execute();
    }
  }
