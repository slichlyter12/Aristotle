<?php
	require('../db_config/conn2.php');

	$questionData = json_decode(file_get_contents("php://input"), true);

	//Get user_id(ONID) from session
	$userId = $_SESSION['onidid'];
	
	//Hard code because Select-Class func isn't in Sprint 1
	$className = 'CS561';
	

	//Check and format the data
	//for title 
	if($questionData['TITLE']==''|| $questionData['TITLE']==NULL){
		$mysqli->close();
		exit('Question title cannot be empty!');
	} $title = $questionData['TITLE'];
	//for description
	if($questionData['DESCRIPTION']==''|| $questionData['DESCRIPTION']==NULL){
		$mysqli->close();
		exit('Question description cannot be empty!');
	} $description = $questionData['DESCRIPTION'];
	//for preferred time
	if($questionData['AVAILABLE_TIME']=='now')
		$preferredTime  = date('Y-m-d H:i:s', time());
	else if($questionData['AVAILABLE_TIME']!=''){
		$preferredTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d', time()).' '.$questionData['AVAILABLE_TIME']));
	}else{
		$mysqli->close();
		exit('Peferred time cannot be empty!');
	}
	//for created time
	$createdTime = date('Y-m-d H:i:s', time());

	//Get and check the user info
	$sql = 'SELECT id, first_name, last_name FROM t_user WHERE role = 0 AND osu_id ="'.$userId.'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$stdntUserId = $row['id'];
			$stdntFirstName = $row['first_name'];
			$stdntLastName = $row['last_name'];
		}else{
			$mysqli->close();
			exit('User account is unavailable!');
		}
	}
	//Get and check the class id 
	$sql = 'SELECT id FROM t_class WHERE name = "'.$className.'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$classId = $row['id'];
		}else{
			$mysqli->close();
			exit('Current class is unavailable!');
		}
	}
	//Add new question
	$sql = 'INSERT INTO t_question (class_id, stdnt_first_name, stdnt_last_name, stdnt_user_id, created_time, title, description, preferred_time, num_liked) VALUES ('.$classId.', "'.$stdntFirstName.'", "'.$stdntLastName.'", '.$stdntUserId.', "'.$createdTime.'", "'.$title.'", "'.$description.'", "'.$preferredTime.'", 0)';
	$result = $mysqli->query($sql);
	if($result) 
		echo 'Create succeed!';
	else
		echo 'Create failed!';

	$mysqli->close();
?>
