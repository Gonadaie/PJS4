<?php 

require_once('db_connect.php');

/**
 * @brief 	Return all the adjectives contained in the database
 * @return	an array of adjectives
 */
function get_adjs(){

	$db = db_connect();
	$adjectives = array();

	if($db){
		$adj_query = "SELECT wording FROM adjective";
		$adj_statement = $db->prepare($adj_query);
		$adj_statement->execute();

		while($row = $adj_statement->fetch(PDO::FETCH_ASSOC))
			array_push($adjectives, $row["wording"]);
	}
	return $adjectives;	
}

?>
