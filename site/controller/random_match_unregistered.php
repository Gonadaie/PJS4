<?php

require_once('back_office_tools.php');
require_once('../model/get_student.php');


 if (isset($_FILES["fileyear1"])) {
    if (isset($_FILES["fileyear2"])) {
   $storagename1 = "liste_etudiant_1.csv";
   $storagename2 = "liste_etudiant_2.csv";
   move_uploaded_file($_FILES["fileyear1"]["tmp_name"], "../Back_office/" . $storagename1);
   move_uploaded_file($_FILES["fileyear2"]["tmp_name"], "../Back_office/" . $storagename2);
   $array_unregistered_student_first = get_unregistered_student('../Back_office/liste_etudiant_1.csv', 1);
   $array_unregistered_student_second = get_unregistered_student('../Back_office/liste_etudiant_2.csv', 2);

   $array_couples = random_match($array_unregistered_student_first,$array_unregistered_student_second);

   $result = '../Back_office/Parainage_aleatoire.csv';
   build_csv($result, $array_couples);
   download_file($result);
}
 }

 function random_match($unmatched_student_first, $unmatched_student_second){
   $nbFirstStudent = count($unmatched_student_first);
   $nbSecondStudent = count($unmatched_student_second);

   $array_couples = array();

   if($nbFirstStudent == $nbSecondStudent){
     for($i = 0; $i<=$nbSecondStudent; $i++){
       array_push($array_couples, array($unmatched_student_second[$i][0],$unmatched_student_first[$i][0]));
     }
   }

   else if($nbFirstStudent>$nbSecondStudent){
     while(!empty($unmatched_student_first)){
       for($i=0; $i<$nbSecondStudent; $i++){
         array_push($array_couples, array($unmatched_student_second[$i][0],$unmatched_student_first[0][0]));
         array_shift($unmatched_student_first);
         if(empty($unmatched_student_first))
           break;
       }
     }
   }

   else if($nbFirstStudent<$nbSecondStudent){
     while(!empty($unmatched_student_second)){
       for($i=0; $i<$nbFirstStudent; $i++){
         array_push($array_couples, array($unmatched_student_second[0][0],$unmatched_student_first[$i][0]));
         array_shift($unmatched_student_second);
         if(empty($unmatched_student_second))
           break;
       }
     }
   }
   return $array_couples;
 }

function get_unregistered_student($student_list_file, $year){
  $list = file($student_list_file);
  $array_unregistered_student = array();
  foreach ($list as $fields) {
    $fields = trim(preg_replace('/\s+/', ' ', $fields));
    $student = get_student_by_email_no_adj_year($fields, $year);

    if(student_is_null($student)){

      array_push($array_unregistered_student, array($fields));
    }
  }
 return $array_unregistered_student;
}

?>
