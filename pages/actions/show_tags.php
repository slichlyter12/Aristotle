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

	//find tags in class
	$completeMsg = $classFunctions->findTagsinClass($class_id);

	if(checkSuccess($completeMsg)){
		$tag_info = $completeMsg->data;
	}
	// echo $tag_info;
	complete($mysqli, 0, "Open find tags success!", array($tag_info));

?>
