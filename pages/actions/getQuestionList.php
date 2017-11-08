<?php
	require('../db_config/conn2.php');
	require('question.php');

	function complete($mysqli, $isError, $msg, $data){
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}

	function question_sort($a,$b) {
		if ($a['WEIGHT']==$b['WEIGHT']) return 0;
		return ($a['WEIGHT']>$b['WEIGHT'])?-1:1;
	}
	
	//Get ONID from session
	$osuId = $_SESSION['onidid'];
	$classId = $_REQUEST['classid'];
	
	//Check is osu id not null
	if($osuId=='null') complete($mysqli, 2, 'Please log in first', NULL);

	//Check is class id not null
	if($classId=='null') complete($mysqli, 1, 'No class has been selected!', NULL);
	

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
	
	//Check is the current user has selected this class
	$sql = 'SELECT * FROM r_user_class WHERE user_id = '.$userId .' AND class_id = '.$classId;
	$result = $mysqli->query($sql);
	if($result) {
		if(!$row = $result->fetch_assoc()){
			complete($mysqli, 1, 'You do not have the access for this class!', NULL);
		}
	}

	//Get all questions id joined by current user
	$sql='SELECT question_id FROM t_question_concern WHERE user_id = '.$userId;
	$result=$mysqli->query($sql);
	if($result) {
		$isJoinedIds=array();
		while($row = $result->fetch_assoc()) array_push($isJoinedIds, $row['question_id']);
	}else complete($mysqli, 1, 'Cannot get concern information!', NULL);

	$sql='SELECT id, title, stdnt_user_id, description, created_time, preferred_time, stdnt_first_name, stdnt_last_name,status, num_liked FROM t_question WHERE class_id = '.$classId.' ORDER BY id ASC';
	$result=$mysqli->query($sql);
	
	if($result) {
		$questions=array();
		$i=0;
		while($row = $result->fetch_assoc()){
			$questions[$i]['ID']=$row['id'];
			$questions[$i]['TITLE']=$row['title'];
			$questions[$i]['DESCRIPTION']=$row['description'];
			$questions[$i]['NAME']=$row['stdnt_first_name'].' '.$row['stdnt_last_name'];
			$questions[$i]['CREATE_TIME']= date('Y-m-d g:i a', strtotime($row['created_time']));
			$questions[$i]['PREFERRED_TIME']= $row['preferred_time'];
			switch($row['status']){
				case '0': $questions[$i]['STATUS']= 'Proposed';break;
				case '1': $questions[$i]['STATUS']= 'Answered';break;
				case '2': $questions[$i]['STATUS']= 'Deleted';
			}
			$questions[$i]['NUM_JOIN']=$row['num_liked'];
			
			if($row['stdnt_user_id']==$userId) $questions[$i]['ISMINE']=1;
			else {
				$questions[$i]['ISMINE']=0;

				if($isJoinedIds!=NULL){
					if(in_array($row['id'],$isJoinedIds)) $questions[$i]['ISJOIN'] = 1;
					else $questions[$i]['ISJOIN'] = 0;
				}
			}

			//Get weight for each question for sort
			$tmp = new question($i, $questions[$i]['NUM_JOIN']+1, $questions[$i]['CREATE_TIME'], $questions[$i]['PREFERRED_TIME']);
			$questions[$i]['WEIGHT'] = $tmp->getIntIndex();
			
			$i++;
		}
		if($questions==NULL) complete($mysqli, 1,'No question here!', NULL);
	}else complete($mysqli, 1, $classId.'Cannot get questions!', NULL);
	
	uasort($questions,"question_sort");
	
	complete($mysqli, 0, NULL, array('QUESTIONS'=>array_values($questions)));

?>
