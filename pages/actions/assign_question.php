<?php
	require('../db_config/conn.php');

	//parpare sql
	function buildSql(){
		$sql="UPDATE 
				t_question q 
			SET 
				q.status = 3,
				q.ta_user_id = ? , 
        		q.ta_first_name = ? , 
        		q.ta_last_name = ? 
			WHERE 
				q.id = ? ";

		return $sql;
	}
	
	$question_id = $_REQUEST['question_id'];
	// Can not get question_id from font page, exit! 
	if(!isset($question_id)){
		exit(json_encode(array('ERROR'=>'Failed to get question_id!')));
	}

	$user_id = $_SESSION['user_id'];
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];

	if(!isset($user_id) || !isset($firstname) || !isset($lastname)){
		exit(json_encode(array('ERROR'=>'Cannot get unser information!')));
	}

	$sql = buildSql();

	// Preparing sql is failed, exit! 
	if(!isset($sql)){
		exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
	}

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("issi", $user_id, $firstname, $lastname, $question_id);
	$stmt->execute();

	echo json_encode(array('Success'=>'Status update successfully!'));
	$mysqli->close();
?>
