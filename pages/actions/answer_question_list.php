<?php
	require('../db_config/conn2.php');
	include ("../models/Question.class.php");
	include ("../models/QuestionConcern.class.php");

	function complete($mysqli, $isError, $msg, $data){
		global $mysqli;
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}

	//parpare sql
	function buildSql(){
		$sql="SELECT
			q.id qid,
			q.class_id cid,
			q.stdnt_first_name q_stdnt_first_name,
			q.stdnt_last_name q_stdnt_last_name,
			q.stdnt_user_id q_stdnt_user_id,
			q.created_time created_time,
			q.title title,
			q.description description,
			q.course_keywords course_keywords,
			q.preferred_time preferred_time,
			q.ta_first_name ta_first_name,
			q.ta_last_name ta_last_name,
			q.ta_user_id ta_user_id,
			d.dictdata_value q_status,
			c.first_name c_first_name,
			c.last_name c_last_name,
			c.user_id c_user_id,
			a.created_time answer_time,
			a.comment comment

		FROM
			d_dictionary d,
			t_question_answer a,
			t_question q
			LEFT JOIN
				t_question_concern c
				ON
					q.id = c.question_id
		WHERE
			d.dict_attribute = 'question_status'
			AND d.dict_value = q.status
			AND q.id = a.question_id
			AND q.class_id = ?

		ORDER BY
			q.id";

		return $sql;
	}

	//prepare Json object
	function buildJson($result){
		$questions['QUESTIONS'] = array();
		$i = -1;
		$j = 0;
		$current_qid = 0;
		while($row = $result->fetch_assoc()){
			//questions info
			if($row['qid'] != $current_qid){
				$current_qid = $row['qid'];
				$i++;
				$questions['QUESTIONS'][$i] = new Question($row['qid'], $row['cid'], $row['q_stdnt_first_name'], $row['q_stdnt_last_name'], $row['q_stdnt_user_id'], $row['created_time'], $row['title'], $row['description'], $row['course_keywords'], $row['preferred_time'], $row['ta_first_name'], $row['ta_last_name'], $row['ta_user_id'], $row['q_status'], $row['answer_time'], $row['comment']);

				//concern info
				if(isset($row['c_first_name'])){
					$questions['QUESTIONS'][$i]->students = array();
					$j = 0;
					$questions['QUESTIONS'][$i]->students[$j] = new QuestionConcern($row['c_first_name'], $row['c_last_name'], $row['c_user_id']);

					$j++;
				}
			}else{
				//concern info
				$questions['QUESTIONS'][$i]->students[$j] = new QuestionConcern($row['c_first_name'], $row['c_last_name'], $row['c_user_id']);
				$j++;
			}
		}

		return $questions;
	}

	$class_id = $_REQUEST['class_id'];
	// Can not get class_id from font page, exit!
	if(!isset($class_id)){
		exit(json_encode(array('ERROR'=>'Failed to get class_id!')));
	}

	$sql = buildSql();

	// Preparing sql is failed, exit!
	if(!isset($sql)){
		exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
	}

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("i", $class_id);

	//query question list
	$stmt->execute();
	$result = $stmt->get_result();

	if(isset($result)) {
		//build Json object
		$questions = buildJson($result);
	}else{
		$mysqli->close();
		exit(json_encode(array('ERROR'=>'No Question here!')));
	}

	complete($mysqli, 0, "Query answer list success!", $questions);
	//echo json_encode($questions);
	// mysql_free_result($result);
	//$mysqli->close();
?>
