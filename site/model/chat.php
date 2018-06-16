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
}
class Preview {
	private $conversation_id;
	private $last_message;
	private $pic;
	private $surname;
	private $message;



	public function __construct($conversation_id, $last_message, $pic, $surname, $message) {

		$this->$conversation_id = $conversation_id;
		$this->last_message = $last_message;
		$this->pic = $pic;
		$this->surname = $surname;
		$this->message = $message;
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
}
