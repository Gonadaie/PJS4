<?php

function getArrayStudents($student) {

	$db = db_connect();
	$tab_student = array();
	if($db) {

		$score_min = $student->getScore() - 10;
		$score_max = $student->getScore() + 10;

		if($student->getYear() == 1){
			$query_get_student =
			"SELECT A.wording as adj1, A2.wording as adj2, A3.wording as adj3, S.surname, S.description, S.pic, S.email
			FROM ADJECTIVE A, ADJECTIVE A2, ADJECTIVE A3, STUDENT S
			WHERE S.student_id <> :student_id AND admin=false AND year = 2 AND S.score BETWEEN :score_min AND :score_max AND S.adjective_1 = A.id_adjective AND S.adjective_2 = A2.id_adjective AND S.adjective_3 = A3.id_adjective and S.student_id NOT IN (SELECT student_id_god_father FROM student_match WHERE student_id_god_son = :student_id and liked_by_god_son = 0 OR liked_by_god_son = 1)";
		}
		else {
			$query_get_student =
			"SELECT A.wording as adj1, A2.wording as adj2, A3.wording as adj3, S.surname, S.description, S.pic, S.email
			FROM ADJECTIVE A, ADJECTIVE A2, ADJECTIVE A3, STUDENT S
			WHERE S.student_id <> :student_id AND admin=false AND year = 1 AND S.score BETWEEN :score_min AND :score_max AND S.adjective_1 = A.id_adjective AND S.adjective_2 = A2.id_adjective AND S.adjective_3 = A3.id_adjective and S.student_id NOT IN (SELECT student_id_god_son FROM student_match WHERE student_id_god_father = :student_id and liked_by_god_father = 0 OR liked_by_god_father = 1)";
		}

		$statement_student = $db->prepare($query_get_student);
		$statement_student->bindValue(':score_min', $score_min, PDO::PARAM_INT);
		$statement_student->bindValue(':score_max', $score_max, PDO::PARAM_INT);
		$statement_student->bindValue(':student_id',$student->getId());
		$statement_student->execute();

		$tab_student = array();

		$count = 0;

		while($row = $statement_student->fetch(PDO::FETCH_ASSOC)){
			$student = new Student($row['surname'], $row['description'],NULL, $row['email'], $row['pic'] );
			$student->setAdjectives($row['adj1'], $row['adj2'], $row['adj3']);
			$tab_student[] = $student->to_array();
			$count=$count+1;
		}
	}

	return json_encode($tab_student);
}
