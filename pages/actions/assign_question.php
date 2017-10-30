<?php
	require('../db_config/conn.php');

	//parpare sql
	function buildSql(){
		$sql="UPDATE 
				t_question q 
			SET 
				q.status = 3 
			WHERE 
				q.id = ? ";

		return $sql;
	}

	
	$question_id = $_REQUEST['question_id'];
	// Can not get question_id from font page, exit! 
	if(!isset($question_id)){
		exit(json_encode(array('ERROR'=>'Failed to get question_id!')));
	}

	$sql = buildSql();

	// Preparing sql is failed, exit! 
	if(!isset($sql)){
		exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
	}

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("i", $question_id);

	//query question list
	$stmt->execute();
	$result = $stmt->get_result();

	echo json_encode(array('Success'=>'Status update successfully!'));
	mysql_free_result($result);
	$mysqli->close();
?>
