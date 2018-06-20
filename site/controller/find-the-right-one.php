<?php
require('../model/find-the-right-one.php');

$student_id = $_SESSION['id'];
$other_student_id = $_POST['other_student_id'];

if(get_year_student($student_id)==1){  //student premiere annee
    if(get_number_click_itsTheRightOne($student_id)<1)   { // ok, droit de clicker
        updateFinalByGodSon($student_id,$other_student_id);
        if(getFinalByGodFather($student_id,$other_student_id)==true){
            updateFinal($student_id,$other_student_id);
            bloquerFilleul($student_id);

            //+ affichage page finale

        }
        else{
            //affichage massage d'attendre que le parrain click aussi
        }

    }
}
else{ //student en deuxieme annee
    if(get_number_click_itsTheRightOne($student_id)<4) { // ok, droit de clicker
        updateFinalByGodFather($student_id,$other_student_id);
        if(getFinalByGodSon($student_id,$other_student_id)==true){
            updateFinal($student_id,$other_student_id);

            //verifier si nb filleul<4
            if(get_number_filleuls()>=4){
                bloquerParrain($student_id);
            }

            //+ affichage page finale
        }
        else{
            //affichage massage d'attendre que le filleul click aussi
        }

    }

}