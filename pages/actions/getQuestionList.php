<?php
	require('../db_config/conn2.php');
	require('question.php');

	function question_sort($a,$b) {
		if ($a['WEIGHT']==$b['WEIGHT']) return 0;
		return ($a['WEIGHT']>$b['WEIGHT'])?-1:1;
	}
	
	//Get ONID from session
	$osuId = $_SESSION['onidid'];

	//Check is current user a Student or is the user exist
	$sql = 'SELECT role, id FROM t_user WHERE osu_id = "'.$osuId .'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$role = $row['role'];
			$userId = $row['id'];
			if($role!='0'){
				$mysqli->close();
				exit('Please join the class first!');
			}
		}else{
			$mysqli->close();
			exit('Please sign up first!');
		}
	}
	
	//Get all questions id joined by current user
	$sql='SELECT question_id FROM t_question_concern WHERE user_id = '.$userId;
	$result=$mysqli->query($sql);
	if($result) {
		$isJoinedIds=array();
		while($row = $result->fetch_assoc()) array_push($isJoinedIds, $row['question_id']);

	}else{
		$mysqli->close();
		exit(json_encode(array('ERROR'=>'Cannot get concern information!')));
	}

	$sql='SELECT id, title, stdnt_user_id, created_time, preferred_time, stdnt_first_name, stdnt_last_name,status, num_liked FROM t_question ORDER BY id ASC';
	$result=$mysqli->query($sql);
	
	if($result) {
		$questions=array();
		$i=0;
		while($row = $result->fetch_assoc()){
			$questions[$i]['ID']=$row['id'];
			$questions[$i]['TITLE']=$row['title'];
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
		if($questions==NULL){
			$mysqli->close();
			exit(json_encode(array('ERROR'=>'No question here!')));
		}
	}else{
		$mysqli->close();
		exit(json_encode(array('ERROR'=>'Cannot get questions!')));
	}	
	
	uasort($questions,"question_sort");
	
	echo json_encode(array('QUESTIONS'=>array_values($questions)));
	$mysqli->free($result);
	$mysqli->close();
?>
