<?php
error_log(print_r("Debut", TRUE));
require_once('../model/back_office.php');
require_once('back_office_tools.php');

$student_list = get_couples();



$csv_file = "../Back_office/liste_couple_etudiant.csv";

build_csv($csv_file, $student_list);

error_log(print_r("Traitement fini", TRUE));

download_file($csv_file);


?>
