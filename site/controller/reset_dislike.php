<?php

require("../model/swipe.php");

require("../model/get_student.php");

reset_dislike(get_student_by_id($_SESSION['id']));

?>
