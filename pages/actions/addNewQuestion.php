<?php
	require('../db_config/conn.php');

	$questionData = json_decode(file_get_contents("php://input"), true);

	$userId = $_SERVER['HTTP_USERID'];
	$className = 'CS561';	//should send with json data

	$title = $questionData['TITLE'];
	$description = $questionData['DESCRIPTION'];
	if($questionData['AVAILABLE_TIME']=='now')
		$preferredTime  = date('Y-m-d H:i:s', time());
	else if($questionData['AVAILABLE_TIME']!=''){			//need a regular expression to check the format of time
		$preferredTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d', time()).' '.$questionData['AVAILABLE_TIME']));
	}
	$createdTime = date('Y-m-d H:i:s', time());


	$sql = 'SELECT id, first_name, last_name FROM t_user WHERE role = 0 AND osu_id ="'.$userId.'"';
	$result = mysql_query($sql);
	if($result) {
		if($row=mysql_fetch_array($result,MYSQL_ASSOC)){
			$stdntUserId = $row['id'];
			$stdntFirstName = $row['first_name'];
			$stdntLastName = $row['last_name'];
		}else{
			mysql_close();
			exit('User account is unavailable!');
		}
	}

	$sql = 'SELECT id FROM t_class WHERE name = "'.$className.'"';
	$result = mysql_query($sql);
	if($result) {
		if($row=mysql_fetch_array($result,MYSQL_ASSOC)){
			$classId = $row['id'];
		}else{
			mysql_close();
			exit('Current class is unavailable!');
		}
	}
	$sql = 'INSERT INTO t_question (class_id, stdnt_first_name, stdnt_last_name, stdnt_user_id, created_time, title, description, preferred_time, num_liked) VALUES ('.$classId.', "'.$stdntFirstName.'", "'.$stdntLastName.'", '.$stdntUserId.', "'.$createdTime.'", "'.$title.'", "'.$description.'", "'.$preferredTime.'", 0)';

	$result = mysql_query($sql);
	if($result) 
		echo 'Create succeed!';
	else
		echo 'Create failed!';

	mysql_close();
?>
