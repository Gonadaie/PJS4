<?php
require_once("../controller/better_crypt.php");
require_once("../model/data_crypter.php");
require_once("../model/db_connect.php");

function add_admin(){
  $db = db_connect();
	if($db) {
  $query = "INSERT INTO student (surname, email, student_password, year,
    description, score, adjective_1, adjective_2, adjective_3, validate_account, admin)
    VALUES (:surname, :email, :student_password, 1, :description, 500, 1, 2, 3, true, true)";
      $statement = $db->prepare($query);
      $statement->bindValue(':surname', encrypt_data("admin"));
      $statement->bindValue(':email', encrypt_data("admin.admin"));
      $statement->bindValue(':description', "description");
      $statement->bindValue(':student_password', better_crypt("88888888"));
      $statement->execute();
}
}

function add_first_conv(){
  $db = db_connect();
	if($db) {
  $query = "INSERT INTO conversation(student_1, student_2)
  VALUES(1,1)";
  $statement = $db->prepare($query);
  $statement->execute();
}
}

function add_first_msg(){
  $db = db_connect();
	if($db) {
  $query = "INSERT INTO message (conversation_id, message_date,content,sender_id) values (1,now(),:msg,1)";
  $statement = $db->prepare($query);
  $statement->bindValue(':msg', "PAS ENCORE DE MESSAGE.");
  $statement->execute();
}
}

add_admin();
add_first_conv();
add_first_msg();
?>




	<!-- insert into message JDT
	INSERT INTO message (conversation_id, message_date,content,sender_id) values (39,now(),'On a assez travaillé pendant l esclavage',3); INSERT INTO message (conversation_id, message_date,content,sender_id) values (39,now(),'ouais grave',2); 
	INSERT INTO message (conversation_id, message_date,content,sender_id) values (39,now(),'J aimerais toucher le ciel mais j peux pas m envoler Mieux seul, pas d Lune de Miel, femme j ai l cœur gelé Laisse-moi sans nouvelles, et avec je ferai J prends l soleil sur la corniche, dans mon cabriolet J ai des potes qu ont grandi derrière les barbelés La rue leur joue des tours, elle les a ensorcelés J vois qu tu te prends la tête, suffisait de m appeler Au pire on s serait engueulés',3);
-->
