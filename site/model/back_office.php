<?php

require('db_connect.php');

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
