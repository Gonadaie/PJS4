<?php

require_once('../model/back_office.php');
require_once('mail_summary_couples.php');


function send_summary(){
	$student_list = get_couples();

for($i=0; $i<count($student_list); $i++){
	send_mail_recap($student_list[$i][2],$student_list[$i][3], 1, $student_list[$i][1]);
}
	for($j=0; $j<count($student_list); $j++){
		send_mail_recap($student_list[$j][0],$student_list[$j][1], 2, $student_list[$j][2]);
	}

}

send_summary();
?>
