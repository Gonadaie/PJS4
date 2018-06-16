<?php

function get_20_message($id_conv, $id_last_msg){
  $db = db_connect();
  if($db) {
    $query = "SELECT * FROM message WHERE conversation_id = :id_conv and
    message_id > :id_last_msg ORDER BY message_id DESC LIMIT 20";
    $statement = $db->prepare($query);
    $statement->bindValue(':id_conv',$id_conv);
    $statement->bindValue(':id_last_msg',$id_last_msg);
    $statement->execute();

		$array_message = array();
		while($row = $statement_preview->fetch(PDO::FETCH_ASSOC)){
			$message = new Message($row['message_id'], $row['conversation_id'],
			$row['message_date'], $row['content'], $row['sender_id'], $row['flag_read']);
			array_push($array_message, $message);
	}

  }
	return $array_message;
}


function getPreviewConversation($student_id) {

	$db = db_connect();
 $tab_previews = array();
	if($db) {

		if(get_year_student($student_id)==1){
			$query_get_preview_conversation ="SELECT C.conversation_id, C.last_message, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_2=S.student_id  WHERE C.student_1=:student_id AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id ORDER BY C.last_message::DATE desc)";
		}else {
			$query_get_preview_conversation ="SELECT C.conversation_id, C.last_message, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_1=S.student_id  WHERE C.student_2=:student_id AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id ORDER BY C.last_message::DATE desc)";
		}

		$statement_preview = $db->prepare($query_get_preview_conversation);
		$statement_preview->bindValue(':student_id',$student_id);
		$statement_preview->execute();

		$tab_previews = array();

		$count = 0;

		while($row = $statement_preview->fetch(PDO::FETCH_ASSOC)){
			$preview = new Preview($row['conversation_id'], $row['last_message'], $row['pic'], decrypt_data($row['surname'], new Message($row['message_id'], $row['conversation_id'], $row['message_date'], $row['content'], $row['sender_id'], $row['flag_read'])));
			$tab_previews[] = $preview->to_array();
			$count=$count+1;
		}
		return json_encode($tab_student);
	}
}
//new message avec tout dedans


// add a message in db  : insert into message (conversation_id, message_date,content,sender_id) values (1,now(),'bite inchallah ',14);

//SELECT C.conversation_id, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_2=S.student_id  WHERE C.student_1=6 AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id );
