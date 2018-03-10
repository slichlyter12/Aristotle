<?php
	$dir = dirname(__FILE__);
	require_once ($dir."/"."../db_config/conn2.php");

	function complete($mysqli, $isError, $msg, $data){
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}
	
	//Get ONID from session
	$osuId = $_SESSION['onidid'];
	$classId = $_REQUEST['classid'];
	$questionId = $_REQUEST['questionid'];

	//Check is osu id not null
	if($osuId=='null') complete($mysqli, 2, 'Please log in first', NULL);

	//Check is class id not null
	if($classId=='null') complete($mysqli, 1, 'No class has been selected!', NULL);
	
	//Check is current user a Student or is the user exist
	$sql = 'SELECT r.role AS role, t.id AS id FROM t_user AS t,r_user_class AS r WHERE r.user_id = t.id AND r.class_id = '.$classId.' AND t.osu_id = "'.$osuId .'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$role = $row['role'];
			$userId = $row['id'];
			if($role!='0' && $role!='1') complete($mysqli, 1, 'No permission!', NULL);
		}else complete($mysqli, 1, 'Please sign up first!', NULL);
	}
	
	//Check is the current user has selected this class
	$sql = 'SELECT * FROM r_user_class WHERE user_id = '.$userId .' AND class_id = '.$classId;
	$result = $mysqli->query($sql);
	if($result) {
		if(!$row = $result->fetch_assoc()){
			complete($mysqli, 1, 'You do not have the access for this class!', NULL);
		}
	}
	
	//Get question details
	$sql='SELECT id, title, description, created_time, preferred_time,stdnt_user_id, stdnt_first_name, stdnt_last_name,status, num_liked, concern, course_keywords FROM t_question WHERE id = '.$questionId.' LIMIT 1';
	$result=$mysqli->query($sql);
	if($result) {
		$question=array();
		if($row = $result->fetch_assoc()){
			$question['ID']=$row['id'];
			$question['DESCRIPTION']=$row['description'];
			$question['TITLE']=$row['title'];
			$question['NAME']=$row['stdnt_first_name'].' '.$row['stdnt_last_name'];
			$question['CREATE_TIME']= date('Y-m-d g:i a', strtotime($row['created_time']));
			$question['PREFERRED_TIME']= date('Y-m-d g:i a', strtotime($row['preferred_time']));
			$question['CONCERN']= $row['concern'];
			switch($row['status']){
				case '0': $question['STATUS']= 'Proposed';break;
				case '1': $question['STATUS']= 'Answered';break;
				case '2': $question['STATUS']= 'Deleted';
			}
			$question['NUM_JOIN']=$row['num_liked'];
			
			if($row['stdnt_user_id']==$userId) $question['ISMINE']=1;
			else {
				$question['ISMINE']=0;
			}
			$question['TAG']=$row['course_keywords'];
		}else complete($mysqli, 1,'No such question here!', NULL);
	}else complete($mysqli, 1, 'Cannot get question!', NULL);
	

	complete($mysqli, 0, NULL, array('QUESTION'=>array_values($question)));

?>
