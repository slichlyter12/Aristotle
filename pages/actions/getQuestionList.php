<?php
	require('../db_config/conn2.php');
	require('question.php');
	require('handler/errorHandler.php');
	require('handler/requestHandler.php');
	require('handler/permissionHandler.php');
	
	function question_sort($a,$b) {
		if ($a['WEIGHT']==$b['WEIGHT']) return 0;
		return ($a['WEIGHT']>$b['WEIGHT'])?-1:1;
	}
	
	//Get user id by using osu id
	function getUserId($osuId, $mysqli){
		$sql = 'SELECT id FROM t_user WHERE osu_id = "'.$osuId.'" LIMIT 1';
		$result = $mysqli->query($sql);
		if($result) {
			if($row = $result->fetch_assoc()){
				$userId = $row['id'];
			} else error($mysqli, 2, 'Please sign up first!', NULL);
		} else error($mysqli, 1, 'Query error!', NULL);
		return $userId;
	}
	
	//Get all questions id joined by current user
	function getConcernQuestionIds($userId, $mysqli){
		$sql='SELECT question_id FROM t_question_concern WHERE user_id = '.$userId;
		$result=$mysqli->query($sql);
		if($result) {
			$isJoinedIds=array();
			$i=0;
			while($row = $result->fetch_assoc()){
				$isJoinedIds[$i] = $row['question_id'];
				$i++;
			}
		}else error($mysqli, 1, 'Query error!', NULL);
		return $isJoinedIds;
	}
	
	function getFormatedQuestionInfos($userId, $isJoinedIds, $classId, $mysqli){
		$sql='SELECT id, title, stdnt_user_id, description, created_time, preferred_time, stdnt_first_name, stdnt_last_name,status, num_liked FROM t_question WHERE status <> 1 and class_id = '.$classId.' ORDER BY id ASC';
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
				$questions[$i]['PREFERRED_TIME']= date('Y-m-d g:i a', strtotime($row['preferred_time']));
				switch($row['status']){
					case '0': $questions[$i]['STATUS']= 'Proposed';break;
					case '1': $questions[$i]['STATUS']= 'Answered';break;
					case '2': $questions[$i]['STATUS']= 'Deleted';break;
					case '3': $questions[$i]['STATUS']= 'Assigned';
				}
				$questions[$i]['NUM_JOIN']=$row['num_liked'];
				
				if($row['stdnt_user_id']==$userId) $questions[$i]['ISMINE']=1;
				else {
					$questions[$i]['ISMINE']=0;

					if($isJoinedIds!=NULL){
						if(in_array($row['id'],$isJoinedIds)) $questions[$i]['ISJOIN'] = 1;
						else $questions[$i]['ISJOIN'] = 0;
					}else {
						$questions[$i]['ISJOIN'] = 0;
					}
				}

				//Get weight for each question for sort
				$tmp = new question($i, $questions[$i]['NUM_JOIN']+1, $questions[$i]['CREATE_TIME'], $questions[$i]['PREFERRED_TIME']);
				$questions[$i]['WEIGHT'] = $tmp->getIntIndex();
				
				$i++;
			}
			if($questions==NULL) error($mysqli, 1,'No question here!', NULL);
		}else error($mysqli, 1, 'Query error!', NULL);

		uasort($questions,"question_sort");
		return $questions;
	}

	$classId = getClassId($_REQUEST);
	$osuId = getOsuId($_SESSION);
	$userId = getUserId($osuId, $mysqli);

	checkClass($classId, $mysqli);
	checkUserClass($classId, $userId, $mysqli);
	checkRole(0, $classId, $userId, $mysqli);

	$isJoinedIds = getConcernQuestionIds($userId, $mysqli);
	$questions = getFormatedQuestionInfos($userId, $isJoinedIds, $classId, $mysqli);

	success($mysqli, NULL, array('QUESTIONS'=>array_values($questions)));
	
?>
