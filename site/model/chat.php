<?php

require_once("../model/db_connect.php");

class Conversation {

	private $id;
	private $student1_id;
	private $student2_id;

	public function __construct($student1_id, $student2_id) {
		$this->student1_id = $student1_id;
		$this->student2_id = $student2_id;
		$this->id = get_id_from_database();
	}




	private function get_id_from_database() {
		$db = db_connect();
		if($db) {
			$query = "SELECT id_conversation FROM conversation where (student_1 = :id1 or student_1 = :id2) or (student_2 = :id2 or student_2 = :id1)";
			$statement = $db->prepare($query);
			$statement->bindValue(":id1", $this->student1_id);
			$statement->bindValue(":id2", $this->student2_id);
			$statement->execute();
			$ret = NULL;
			while($result = $statement->fetch(PDO::FETCH_ASSOC)){
				$ret = $result['id'];
			}

			return $ret;
		}
	}


}

class Message {
	private $message_id;
	private $sender_id;
	private $conversation_id;
	private $message_date;
	private $content;
	private $flag_read;



	public function __construct($message_id, $conversation_id, $message_date, $content, $sender_id, $flag_read) {

		$this->message_id = $message_id;
		$this->conversation_id = $conversation_id;
		$this->content = $content;
		$this->message_date = $message_date;
		$this->sender_id = $sender_id;
		$this->flag_read = $flag_read;
	}

	public function get_message_id(){
		return $this->message_id;
	}
	public function get_sender_id() {
		return $this->sender_id;
	}
	public function get_conversation_id(){
		return $this->conversation_id;
	}
	public function get_message_date(){
		return $this->message_date;
	}
	public function get_flag_read(){
		return $this->flag_read;
	}
	public function get_content() {
		return $this->content;
	}
	
	public function to_array(){
		$return = array(
		
		'message_id' => $this->message_id,
		'conversation_id' => $this->conversation_id,
		'content' => $this->content,
		'message_date' => $this->message_date,
		'sender_id' => $this->sender_id,
		'flag_read' => $this->flag_read
			
		);
		return $return;
	}
}
class Preview {
	private $conversation_id;
	private $last_message;
	private $pic;
	private $surname;
	private $message;
	private $other_student_id;



	public function __construct($other_student_id, $conversation_id, $last_message, $pic, $surname, $message) {

		$this->conversation_id = $conversation_id;
		$this->last_message = $last_message;
		$this->pic = $pic;
		$this->surname = $surname;
		$this->message = $message;
		$this->other_student_id = $other_student_id;
		
	}



	public function get_conversation_id(){
		return $this->conversation_id;
	}
	public function get_date_last_message(){
		return $this->last_message;
	}
	public function get_pic(){
		return $this->pic;
	}
	public function get_surname() {
		return $this->surname;
	}
	public function get_message() {
		return $this->message;
	}
	public function get_other_student_id() {
		return $this->other_student_id;
	}
		
	public function to_array(){
		$return = array(
		
		'conversation_id' => $this->conversation_id,
		'other_student_id' => $this->other_student_id,
		'last_message' => $this->last_message,
		'pic' => $this->pic,
		'surname' => $this->surname,
		'message' => $this->message->to_array()
			
		);
		return $return;
	}
}
