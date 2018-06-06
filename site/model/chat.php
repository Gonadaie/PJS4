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

?>
