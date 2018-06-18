<?php

require_once('back_office_tools.php');
require_once('../model/get_student.php');


 if (isset($_FILES["file"])) {
   $storagename = "liste_etudiant.csv";
   move_uploaded_file($_FILES["file"]["tmp_name"], "../Back_office/" . $storagename);
   $array_unregistered_student = get_unregistered_student('../Back_office/liste_etudiant.csv');
   $result = '../Back_office/etudiants_non_inscrit.csv';
   build_csv($result, $array_unregistered_student);
   download_file('../Back_office/etudiants_non_inscrit.csv');

 }


function get_unregistered_student($student_list_file){
  $list = file($student_list_file);
  $array_unregistered_student = array();


  foreach ($list as $fields) {
    $fields = trim(preg_replace('/\s+/', ' ', $fields));
    $student = get_student_by_email_no_adj($fields);

    if(student_is_null($student)){

      array_push($array_unregistered_student, array($fields));
    }
  }
 return $array_unregistered_student;
}

?>
