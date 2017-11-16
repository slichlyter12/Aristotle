<?php
	$dir = dirname(__FILE__);
	require_once ($dir."/"."../db_config/conn2.php");
	require_once ($dir."/"."class_functions.php");
	require_once ($dir."/"."user_functions.php");
	require_once ($dir."/"."../models/CompleteMsg.class.php");

	$classFunctions = new ClassFunctions();
	$userFunctions = new UserFunctions();

	function complete($mysqli, $isError, $msg, $data){
		global $mysqli;
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}

	function checkSuccess($completeMsg){
		global $mysqli;
		if(isset($completeMsg) && $completeMsg->isError == 1){
		$mysqli->rollback();
		complete($mysqli, $completeMsg->isError, $completeMsg->msg, $completeMsg->data);
		}
		return true;
	}

	$class_id = $_REQUEST['class_id'];
	// Can not get class_id from font page, exit!
	if(!isset($class_id)){
		complete($mysqli, 1, 'Failed to get class_id!', NULL);
	}

	$onid = $_SESSION['onidid'];
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];

	if(!isset($onid) || !isset($firstname) || !isset($lastname)){
		complete($mysqli, 1, 'Cannot get user information!', NULL);
	}

	//check the user is admin or not, only admin can edit class, role of admin is 2
	$completeMsg = $userFunctions->checkUserByClass($onid, $class_id, 2);

	if(checkSuccess($completeMsg)){
		$user_info = $completeMsg->data;
	}

	if($user_info){
		if($firstname == $user_info['user_info']->first_name && $lastname == $user_info['user_info']->last_name){
			$user_id = $user_info['user_info']->id;
		} else {
			complete($mysqli, 1, 'User information is error!', NULL);
		}
	} else {
		complete($mysqli, 1, 'User is not a Admin in this class!', NULL);
	}

	//find tas' name in class, role of ta is 1
	$completeMsg = $userFunctions->findTasinClass($class_id, 1);

	if(checkSuccess($completeMsg)){
		$ta_info = $completeMsg->data;
	}
	
	complete($mysqli, 0, "Open edit board success!", array($ta_info));

?>
