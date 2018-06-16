<?php

function getPreviewConversation($student_id) {

	$db = db_connect();
 $tab_previews = array();
	if($db) {
		$query_get_preview_conversation ="SELECT C.conversation_id, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_2=S.student_id  WHERE C.student_1=:student_id AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id );"

		$statement_preview_1 = $db->prepare($query_get_preview_conversation);
		$statement_preview_1->bindValue(':student_id',$student_id);
		$statement_preview_1->execute();

		$tab_previews = array();

		$count = 0;

		while($row = $statement_preview_1->fetch(PDO::FETCH_ASSOC)){
			array_push($tab_previews,array($row[conversation_id]),)
		}

//new message avec tout dedans





$student = new Student(decrypt_data($row['surname']), $row['description'], NULL, decrypt_data($row['email']), $row['pic'] );
		
			$student->setAdjectives($row['adj1'], $row['adj2'], $row['adj3']);
			$tab_previews[] = $student->to_array();
			$count=$count+1;

// add a message in db  : insert into message (conversation_id, message_date,content,sender_id) values (1,now(),'bite inchallah ',14);
		
	SELECT C.conversation_id, S.pic, S.surname, M1.* FROM message M1, conversation C INNER JOIN student S ON C.student_2=S.student_id  WHERE C.student_1=6 AND M1.message_id =(SELECT COALESCE(MAX(message_id),'1') FROM message M where M.conversation_id=C.conversation_id );
