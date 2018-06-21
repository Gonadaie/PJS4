<?php

function get_number_click_itsTheRightOne($id){
    $db = db_connect();
    if($db) {
        if(get_year_student($id)==1)
        {
            $query = "SELECT COUNT(*) FROM STUDENT_MATCH  WHERE student_id_god_son = :student_id  AND final_by_god_son=true";
            //SELECT COUNT(*) FROM STUDENT_MATCH WHERE student_id_god_son = 1  AND final_by_god_son=true


        }
        else
        {
            $query = "SELECT COUNT(*) FROM STUDENT_MATCH  WHERE student_id_god_father = :student_id  AND final_by_god_father=true";

        }
        $statement = $db->prepare($query);
        $statement->bindValue(':student_id', $id);
        $statement->execute();

        $count=$statement->fetchColumn();

        return $count;
    }
}

function get_number_filleuls($id){
    $db = db_connect();
    if($db) {

            $query = "SELECT COUNT(*) FROM STUDENT_MATCH  WHERE student_id_god_father = :student_id  AND final=true";

            $statement = $db->prepare($query);
            $statement->bindValue(':student_id', $id);
            $statement->execute();

            $count=$statement->fetchColumn();

            return $count;
    }
}

function updateFinalByGodSon($id_student, $id_other_student) {
    $db = db_connect();

    if($db){
        $query = "UPDATE student_match SET final_by_god_son = true WHERE student_id_god_son = :id AND student_id_god_father=:id_other_student";
        $statement = $db->prepare($query);
        $statement->bindvalue(':id',$id_student);
        $statement->bindvalue(':id_other_student',$id_other_student);
        $statement -> execute();
    }
}
function updateFinalByGodFather($id_student, $id_other_student) {
    $db = db_connect();

    if($db){
        $query = "UPDATE student_match SET final_by_god_father = true WHERE student_id_god_father = :id AND student_id_god_son=:id_other_student";
        $statement = $db->prepare($query);
        $statement->bindvalue(':id',$id_student);
        $statement->bindvalue(':id_other_student',$id_other_student);
        $statement -> execute();
    }
}

function getFinalByGodFather($id_student, $id_other_student) {
    $db = db_connect();

    if($db){

        $query = "SELECT final_by_god_father FROM STUDENT_MATCH  WHERE student_id_god_son = :id  AND student_id_god_father=:id_other_student";
        $statement = $db->prepare($query);
        $statement->bindvalue(':id',$id_student);
        $statement->bindvalue(':id_other_student',$id_other_student);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $resultat = $row['final_by_god_father'];

        return $resultat;

    }
}

function getFinalByGodSon($id_student, $id_other_student) {
    $db = db_connect();

    if($db){

        $query = "SELECT final_by_god_son FROM STUDENT_MATCH  WHERE student_id_god_father = :id  AND student_id_god_son=:id_other_student";
        $statement = $db->prepare($query);
        $statement->bindvalue(':id',$id_student);
        $statement->bindvalue(':id_other_student',$id_other_student);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $resultat = $row['final_by_god_son'];

        return $resultat;

    }
}

function updateFinal($id_student, $id_other_student) {
    $db = db_connect();

    if($db){
        if(get_year_student($id_student)==1)
        {
            $query = "UPDATE student_match SET final = true WHERE student_id_god_son = :id AND student_id_god_father=:id_other_student";

        }
        else
        {
            $query = "UPDATE student_match SET final = true WHERE student_id_god_father = :id AND student_id_god_son=:id_other_student";

        }
        $statement = $db->prepare($query);
        $statement->bindvalue(':id',$id_student);
        $statement->bindvalue(':id_other_student',$id_other_student);
        $statement -> execute();

    }
}

function bloquerFilleul($id_student) {
    $db = db_connect();

    if($db){
        $query = "UPDATE student_match SET final_by_god_son = false WHERE student_id_god_son = :id";
        $statement = $db->prepare($query);
        $statement->bindvalue(':id',$id_student);
        $statement -> execute();
    }
}

function bloquerParrain($id_student) {
    $db = db_connect();

    if($db){
        $query = "UPDATE student_match SET final_by_god_father = false WHERE student_id_god_father = :id";
        $statement = $db->prepare($query);
        $statement->bindvalue(':id',$id_student);
        $statement -> execute();
    }
}
?>