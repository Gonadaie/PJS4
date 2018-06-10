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
			$statement = db->prepare($query);
			$statement->bindValue(":id1", $this->student1_id);
			$statement->bindValue(":id2", $this->student2_id);
			$statement->execute();
			$ret = NULL;	
			while($result = $statement->fetch(PDO::FETCH_ASSOC)
				$ret = $result['id'];
			return $ret;
		}	
	}

	
}

class Message {
	private $id_from;
	private $id_dest;
	private $content;
	private $date;

	public function __construct($id_from, $id_dest, $content, $date) {
		$this->id_from = $id_from;
		$this->id_dest = $id_dest;
		$this->content = $content;
		$this->date = date;
	}

	public function get_id_from() {
		return $this->id_dest;
	}

	public function get_id_dest() {
		return $this->id_from;
	}

	public function get_content() {
		return $this->content;
	}
}

?>
