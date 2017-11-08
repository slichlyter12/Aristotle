<?php
	require('../db_config/conn2.php');
	
	function complete($mysqli, $isError, $msg, $data){
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}
	
	//Get required data
	$data = json_decode(file_get_contents("php://input"), true);
	$questionId = $data['id'];
	$osuId = $_SESSION['onidid'];
	$firstName = $_SESSION['firstname'];
	$lastName = $_SESSION['lastname'];
	$classId = $_REQUEST['classid'];
	
	//Check is osu id not null
	if($osuId=='null') complete($mysqli, 2, 'Please log in first', NULL);

	//Check is class id not null
	if($classId=='null') complete($mysqli, 1, 'No class has been selected!', NULL);

	
	//Check is current user a Student or is the user exist
	$sql = 'SELECT r.role AS role, t.id AS id FROM t_user AS t,r_user_class AS r WHERE r.class_id = '.$classId.' AND t.osu_id = "'.$osuId.'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$role = $row['role'];
			$userId = $row['id'];
			if($role!='0') complete($mysqli, 1, 'No permission!', NULL);
		}else complete($mysqli, 1, 'Please sign up first!', NULL);
	}
	
	//Check question: is owner
	$sql='SELECT id FROM t_question where id = '.$questionId.' AND stdnt_user_id <> '.$userId.' LIMIT 1';
	$result=$mysqli->query($sql);
	if(!$result) complete($mysqli, 1, 'No such question or the question cannot be quited in by owner!', NULL);
	
	//Check is the current question has been joined in
	$sql='SELECT created_time FROM t_question_concern WHERE user_id = '.$userId.' AND question_id = '.$questionId.' LIMIT 1';
	$result=$mysqli->query($sql);
	if($result) {
		if(($row = $result->fetch_assoc())) {
			$createdTime = $row['created_time'];
		} else {
			$complete($mysqli, 1, 'You even did not join in this question!', NULL);
		}
	}else complete($mysqli, 1, 'Cannot get concern information!', NULL);

	//Quit from the question 
	$sql='DELETE FROM t_question_concern WHERE user_id = '.$userId.' AND question_id = '.$questionId.' LIMIT 1';
	$result = $mysqli->query($sql);
	if(!$result) complete($mysqli, 1, 'Quit failed!', NULL);
	
	//Update the question table
	$concern = $firstName.' '.$lastName.','.$createdTime.'.';
	$sql='UPDATE t_question SET num_liked = num_liked - 1, concern = replace(concern, \''.$concern.'\',\'\') where id='.$questionId.' LIMIT 1';
	$result = $mysqli->query($sql);
	if(!$result) complete($mysqli, 1, 'Update question info failed!', NULL);

	//Get new question info
	$sql='SELECT num_liked FROM t_question where id = '.$questionId.' LIMIT 1';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()) complete($mysqli, 0, 'Quit success!', $row['num_liked']);
		else complete($mysqli, 1, 'Question was deleted', NULL);
	}else complete($mysqli, 1, 'Get question info failed!', NULL);

	



?>