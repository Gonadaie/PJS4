<?php

require_once('../model/random_match.php');

$unmatched_student_first = get_unmatched_student_first_year();
$unmatched_student_second = get_unmatched_student_second_year();

random_match($unmatched_student_first, $unmatched_student_second);


?>
