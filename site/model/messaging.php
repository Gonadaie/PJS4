<?php

require_once("../model/db_connect.php");
require_once("../model/get_student.php");
require_once("../model/chat.php");
require_once("data_crypter.php");

function insert_message($message, $sender_id, $receiver_id){
  $conv_id = get_id_conversation($sender_id, $receiver_id);
  $db = db_connect();
  if($db) {
    $query = "INSERT INTO message (conversation_id,message_date, content, sender_id)
    VALUES(:conversation, now(), :message, :id)";
    $statement = $db->prepare($query);
    $statement->bindValue(':conversation',$conv_id);
    $statement->bindValue(':message',encrypt_data($message));
    $statement->bindValue(':id',$sender_id);
    $statement->execute();

    update_con($conv_id);

  }
}

function update_con($conv_id){
  $db = db_connect();
  if($db) {
    $query = "UPDATE conversation set last_message = now() where conversation_id = :conversation";
    $statement = $db->prepare($query);
    $statement->bindValue(':conversation',$conv_id);
    $statement->execute();
  }
}


/*retourne les 20 derniers messages d'une conversation*/
function get_old_messages($id_conv){
  $db = db_connect();
  if($db) {
    $query = "SELECT * FROM message WHERE conversation_id = :id_conv and
    message_id <= (Select MAX(message_id) from message where conversation_id = :id_conv) ORDER BY message_id DESC LIMIT 20";
    $statement = $db->prepare($query);
    $statement->bindValue(':id_conv',$id_conv);
    $statement->execute();

		$array_messages = array();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$message = new Message($row['message_id'], $row['conversation_id'],
			$row['message_date'], decrypt_data($row['content']), $row['sender_id'], $row['flag_read']);
			array_push($array_messages, $message->to_array());
	}
  }
	return $array_messages;
}

/*retourne les 20 messages précédents le message donné en paramètre*/
function get_older_messages($id_conv, $id_last_msg){
  $db = db_connect();
  if($db) {
    $query = "SELECT * FROM message WHERE conversation_id = :id_conv and
    message_id > :id_last_msg ORDER BY message_id DESC LIMIT 20";
    $statement = $db->prepare($query);
    $statement->bindValue(':id_conv',$id_conv);
    $statement->bindValue(':id_last_msg',$id_last_msg);
    $statement->execute();

		$array_messages = array();
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$message = new Message($row['message_id'], $row['conversation_id'],
			$row['message_date'], decrypt_data($row['content']), $row['sender_id'], $row['flag_read']);
			array_push($array_messages, $message->to_array());
	}

  }
	return $array_messages;
}

/*retourne une array de preview d'un student*/
function getPreviewConversation($student_id) {

	$db = db_connect();
 $tab_previews = array();
	if($db) {

		if(get_year_student($student_id)==1){
			$query_get_preview_conversation ="SELECT S.student_id, C.conversation_id, C.last_message, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_2=S.student_id  WHERE C.student_1=:student_id AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id) ORDER BY C.last_message desc";
		}else {
			$query_get_preview_conversation ="SELECT S.student_id, C.conversation_id, C.last_message, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_1=S.student_id  WHERE C.student_2=:student_id AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id) ORDER BY C.last_message desc";
		}

		$statement_preview = $db->prepare($query_get_preview_conversation);
		$statement_preview->bindValue(':student_id',$student_id);
		$statement_preview->execute();

		$tab_previews = array();

		$count = 0;

		while($row = $statement_preview->fetch(PDO::FETCH_ASSOC)){
			$preview = new Preview($row['student_id'], $row['conversation_id'], $row['last_message'], $row['pic'], decrypt_data($row['surname']), new Message($row['message_id'], $row['conversation_id'], $row['message_date'], decrypt_data($row['content']), $row['sender_id'], $row['flag_read']));
			$tab_previews[] = $preview->to_array();
			$count=$count+1;
		}
		return $tab_previews;
	}
}

function updateFlagLecture($conversation_id) {

	$db = db_connect();
	if($db) {

		$query_update_flag_read ="Update message set flag_read=true where conversation_id=:conversation_id";

		$statement_update_flag  = $db->prepare($query_update_flag_read);
		$statement_update_flag ->bindValue(':conversation_id',$conversation_id);
		$statement_update_flag ->execute();

		}
	}

//new message avec tout dedans


// add a message in db  : insert into message (conversation_id, message_date,content,sender_id) values (1,now(),'bite inchallah ',14);

//SELECT C.conversation_id, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_2=S.student_id  WHERE C.student_1=6 AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id );


//SELECT * FROM message WHERE conversation_id = 12 and message_id >= (Select MAX(message_id) from message where conversation_id = 12) ORDER BY message_id DESC LIMIT 20;
