<?php

require_once("../model/get_adjs.php");

$adjectives = get_adjs();

echo(json_encode($adjectives));

?>
