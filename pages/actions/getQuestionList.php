<?php
	require('../db_config/conn.php');
	require('question.php');

	function question_sort($a,$b) {
		if ($a['WEIGHT']==$b['WEIGHT']) return 0;
		return ($a['WEIGHT']>$b['WEIGHT'])?-1:1;
	}

	$sql="SELECT title, created_time, preferred_time, stdnt_first_name, stdnt_last_name,status, num_liked FROM t_question ORDER BY id ASC";
	$result=$mysqli->query($sql);
	
	if($result) {
		$questions=array();
		$i=0;
		while($row = $result->fetch_assoc()){
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
			
			//Get weight for each question for sort
			$tmp = new question($i, $questions[$i]['NUM_JOIN']+1, $questions[$i]['CREATE_TIME'], $questions[$i]['PREFERRED_TIME']);
			$questions[$i]['WEIGHT'] = $tmp->getIntIndex();

			$i++;
		}
	}else{
		$mysqli->close();
		exit(json_encode(array('ERROR'=>'No question here!')));
	}
	
	uasort($questions,"question_sort");
	
	echo json_encode(array('QUESTIONS'=>array_values($questions)));
	$mysqli->free($result);
	$mysqli->close();
?>
