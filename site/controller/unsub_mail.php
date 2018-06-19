<?php
require_once('back_office_tools.php');

require_once('../controller/send_mail_unsubs.php');
require_once('../model/get_student.php');


 if (isset($_FILES["file"])) {
   $storagename = "liste_etudiant.csv";
   move_uploaded_file($_FILES["file"]["tmp_name"], "../Back_office/" . $storagename);
   $array_student = get_unregistered_student('../Back_office/liste_etudiant.csv');
   for($i=0; $i<count($array_student); $i++){
     error_log(print_r($array_student[$i], TRUE));
     error_log(print_r($array_student[$i][0], TRUE));
     send_mail_unsubs($array_student[$i][0]);
     error_log(print_r("mail", TRUE));
     error_log(print_r($array_student[$i][0], TRUE));
   }
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
