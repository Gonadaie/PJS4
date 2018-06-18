<?php
require_once('back_office_tools.php');
require_once('../controller/get_student.php');
require_once('../controller/send_mail_unsubs.php');


 if (isset($_FILES["file"])) {
   $storagename = "liste_etudiant.csv";
   move_uploaded_file($_FILES["file"]["tmp_name"], "../Back_office/" . $storagename);
   $array_student = get_unregistered_student('../Back_office/liste_etudiant.csv');
   for($i=0; $i<count($array_student); $i++){
     send_mail_unsubs($array_student[$i]->getEmail());
     error_log(print_r("mail", TRUE));
   }
}

   ?>
