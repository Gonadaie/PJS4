<?php
require('../model/find-the-right-one.php');
require ('../model/get_student.php');

session_start();

$student_id = $_SESSION['id'];
$other_student_id = $_POST['other_student_id'];

error_log(print_r("id current student:" . $student_id,true));
error_log(print_r("id other student:" . $other_student_id,true));

if(get_year_student($student_id)==1){  //student premiere annee
    if(get_number_click_itsTheRightOne($student_id)<1)   { // ok, droit de clicker
        updateFinalByGodSon($student_id,$other_student_id);
        if(getFinalByGodFather($student_id,$other_student_id)==true){
            updateFinal($student_id,$other_student_id);
            bloquerFilleul($student_id);

            if(get_number_filleuls($other_student_id)>=4){
                bloquerParrain($other_student_id);
            }

            //+ affichage page finale
            header("Location: https://skipti.fr/view/final.php");

        }
        else{
            //affichage massage d'attendre que le parrain click aussi
            error_log(print_r("Attendez que le parrain vous like",true));
        }

    }

}
else{ //student en deuxieme annee
    if(get_number_click_itsTheRightOne($student_id)<4) { // ok, droit de clicker
        updateFinalByGodFather($student_id,$other_student_id);
        if(getFinalByGodSon($student_id,$other_student_id)==true){
            updateFinal($student_id,$other_student_id);

            bloquerFilleul($other_student_id);
            //verifier si nb filleul<4
            if(get_number_filleuls($student_id)>=4){
                bloquerParrain($student_id);
            }

            //+ affichage page finale
            header("../view/final.php");
        }
        else{
            //affichage massage d'attendre que le filleul click aussi
            error_log(print_r("Attendez que le filleul vous like",true));
        }

    }

}