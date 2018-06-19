<?php
require("../model/delete_student.php");
$id = $_SESSION["id"];
delete_student_byID($id);
header("Location: http://skipti.fr/");
?> 