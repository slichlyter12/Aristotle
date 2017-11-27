<?php

	$dir = dirname(__FILE__);
	require_once ($dir."/"."../db_config/conn2.php");
	require_once ($dir."/"."class_functions.php");
	//require_once($dir."/"."public_functions.php");
	require_once ($dir."/"."../models/CompleteMsg.class.php");

	//$pf = new PublicFunctions();
	$classFunctions = new ClassFunctions();

	function complete($mysqli, $isError, $msg, $data){
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}

	$classesData = json_decode(file_get_contents("php://input"), true);

	//Get user_id(ONID) from session
	$osuId = $_SESSION['onidid'];
	
	//Check is osu id not null
	if($osuId=='null') complete($mysqli, 2, 'Please log in first', NULL);
	
	//Check is current user a Student or is the user exist
	$completeMsg = $classFunctions->checkUser4Students($osuId);
	if(isset($completeMsg) && $completeMsg->isError == 0){
			$userId = $completeMsg->data;
	} else {
		complete($mysqli, $completeMsg->isError, $completeMsg->msg, $completeMsg->data);
	}

	//Reset the selected classes	
	// $completeMsg = $classFunctions->selectClasses4Students($userId, $classesData, 0);

	complete($mysqli, $completeMsg->isError,$completeMsg->msg, $completeMsg->data);

?>
