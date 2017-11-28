<?php
	require('../db_config/conn2.php');
	
	function complete($mysqli, $isError, $msg, $data){
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}

	$questionData = json_decode(file_get_contents("php://input"), true);
	
	//Get user_id(ONID) from session
	$osuId = $_SESSION['onidid'];
	$classId = $_REQUEST['classid'];
	
	//Check is osu id not null
	if($osuId=='null') complete($mysqli, 2, 'Please log in first', NULL);

	//Check is class id not null
	if($classId=='null') exit('No class has been selected!');

	//Check is current user a Student or is the user exist
	$sql = 'SELECT r.role AS role, t.id AS id FROM t_user AS t,r_user_class AS r WHERE r.class_id = '.$classId.' AND t.osu_id = "'.$osuId .'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$role = $row['role'];
			$userId = $row['id'];
			if($role!='0') complete($mysqli, 1, 'No permission!', NULL);
		}else complete($mysqli, 1, 'Please sign up first!', NULL);
	}

	//Check and format the data
	
	//for description
	if($questionData['ID']==''|| $questionData['ID']==NULL) complete($mysqli, 1, 'Question description cannot be empty!', NULL);
	$questionId = $questionData['ID'];
	
	//for description
	if($questionData['DESCRIPTION']==''|| $questionData['DESCRIPTION']==NULL) complete($mysqli, 1, 'Question description cannot be empty!', NULL);
	$description = $questionData['DESCRIPTION'];
	//for preferred time
	if($questionData['AVAILABLE_TIME']!=''){
		$preferredTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d', time()).' '.$questionData['AVAILABLE_TIME']));
	}else complete($mysqli, 1, 'Peferred time cannot be empty!', NULL);

	//Get and check the user info
	$sql = 'SELECT first_name, last_name FROM t_user WHERE id ="'.$userId.'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$stdntFirstName = $row['first_name'];
			$stdntLastName = $row['last_name'];
		}else complete($mysqli, 1, 'User account is unavailable!', NULL);
	}

	//Check the class id 
	$sql = 'SELECT name FROM t_class WHERE id = '.$classId;
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$className = $row['name'];
		}else complete($mysqli, 1, 'Current class is unavailable!', NULL);
	}
	//Modify a question
	//eg: "{\"ID\":\"90\",\"DESCRIPTION\":\"1231\",\"AVAILABLE_TIME\":\"4:41 pm\"}"
	
	$sql = 'UPDATE t_question SET description="'.$description.'", preferred_time="'.$preferredTime.'" WHERE id='.$questionId.' LIMIT 1';
	$result = $mysqli->query($sql);
	if($mysqli->affected_rows==1) complete($mysqli, 0, 'Modify succeed!', NULL);
	else complete($mysqli, 1, 'Modify failed!', NULL);
?>
