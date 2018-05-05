<?php

/**
 * Calculate a new score for two student.
 * We run a formul, and remove the result to the
 * highest score and add it to the lowest.
 */
require("../model/score.php");

  $s1 = $student_connected->getScore();
  $s2 = $student_liked->getScore();

	$ratio = ((abs($s1 - $s2)**2)/100)+1;
	if($s1>$s2){
		$s1 = $s1-$ratio;
		$s2 = $s2+$ratio;
	}
	else{
		$s1 = $s1+$ratio;
		$s2 = $s2-$ratio;
	}

  update_score($id_student_connected, ceil($s1));
  update_score($student_liked->getId(), ceil($s2));
