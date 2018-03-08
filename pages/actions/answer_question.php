<?php
	$dir = dirname(__FILE__);
	require_once ($dir."/"."../db_config/conn2.php");
	require_once ($dir."/"."check_user.php");
	require_once ($dir."/"."user_functions.php");

	$userFunctions = new UserFunctions();

	function complete($mysqli, $isError, $msg, $data){
		global $mysqli;
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}
	$classesData = json_decode(file_get_contents("php://input"), true);
	$question_id = $classesData['question_id'];
	$comment = $classesData['comment'];
	// Can not get question_id from font page, exit!
	if(!isset($question_id)){
		complete($mysqli, 1, 'Failed to get question_id!', NULL);
	}

	$onid = $_SESSION['onidid'];
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];

	if(!isset($onid) || !isset($firstname) || !isset($lastname)){
		complete($mysqli, 1, 'Cannot get user information!', NULL);
	}

	//check the user is ta or not, only ta can answer question, role of ta is 1
	$role = 1;

	$user_info = checkUserByQuestion($onid, $question_id, $role);
	if($user_info){
		if($firstname == $user_info['user_info']->first_name && $lastname == $user_info['user_info']->last_name){
			$user_id = $user_info['user_info']->id;
		} else {
			complete($mysqli, 1, 'User information is error!', NULL);
		}
	} else {
		complete($mysqli, 1, 'User is not a TA in this class!', NULL);
	}

	$mysqli->autocommit(false);
	$status = 1;
	$completeMsg = $userFunctions->answerQuestoin($status, $user_id, $firstname, $lastname, $question_id, $comment);
	
	if(isset($completeMsg) && $completeMsg->isError == 1){
		$mysqli->rollback();
	}

	$mysqli->autocommit(true);
	complete($mysqli, $completeMsg->isError, $completeMsg->msg, $completeMsg->data);

?>
