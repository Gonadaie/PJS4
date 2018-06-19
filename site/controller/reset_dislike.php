<?php
error_log(print_r("reset dislike debut", TRUE));
require("../model/swipe.php");
require("../model/get_student.php");

session_start();

reset_dislike(get_student_by_id($_SESSION['id']));

error_log(print_r("reset dislike ", TRUE));

?>
