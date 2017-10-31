<?php
	require_once ('../db_config/conn.php');
	include_once ('check_user.php');

	$question_id = $_REQUEST['question_id'];
	// Can not get question_id from font page, exit! 
	if(!isset($question_id)){
		exit(json_encode(array('ERROR'=>'Failed to get question_id!')));
	}

	$onid = $_SESSION['onidid'];
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];

	if(!isset($onid) || !isset($firstname) || !isset($lastname)){
		exit(json_encode(array('ERROR'=>'Cannot get user information!')));
	}

	//check the user is ta or not, only ta can assign question, role of ta is 1
	$role = 1;
	
	$user_info = checkUserByQuestion($onid, $question_id, $role);
	if($user_info){
		if($firstname == $user_info['class_info']->first_name && $lastname == $user_info['class_info']->last_name){
			$user_id = $user_info['class_info']->id;
		} else {
			exit(json_encode(array('ERROR'=>'User information is error!')));
		}
	} else {
		exit(json_encode(array('ERROR'=>'User is not a TA in this class!')));
	}

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
	
	$sql = buildSql();

	// Preparing sql is failed, exit! 
	if(!isset($sql)){
		exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
	}

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("issi", $user_id, $firstname, $lastname, $question_id);
	$stmt->execute();

	echo json_encode(array('SUCCESS'=>'Status update successfully!'));
	$mysqli->close();
?>
