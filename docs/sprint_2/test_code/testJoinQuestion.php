<?php
use PHPUnit\Framework\TestCase;

class JoinInQuestionUnitTest extends TestCase {
/***************************************************************************/
	public function testCheckIsOwnerOfQuestion_OK() {
		clear();
		setup();
		$this->expectOutputString('');
		checkIsOwnerOfQuestion(2, 1);

	}

	public function testCheckIsOwnerOfQuestion_IsOwners() {
		clear();
		setup();
		$this->expectOutputString('Question cannot be joined in by owner!');
		checkIsOwnerOfQuestion(1, 1);
		clear();
	}
/***************************************************************************/
	public function testGetJoinedQuestionIds_OK(){
		clear();
		setup();
		$result = getJoinedQuestionIds(2, 1);
		$this->assertEquals(true, $result);
	}

	public function testGetJoinedQuestionIds_HasJoined(){
		clear();
		setup();
		$this->expectOutputString('Question cannot be joined twice!');
		getJoinedQuestionIds(3, 1);
	}

	public function testGetJoinedQuestionIds_QueryError(){
		clear();
		$this->expectOutputString('Cannot get concern information!');
		getJoinedQuestionIds(3, 1);
	}
/***************************************************************************/
	public function testJoinInQuestion_OK(){
		clear();
		setup();
		joinInQuestion(2, 1,"Jianchang","Bi","2011-01-01 00:00:00");
		$result = dbQuery('SELECT * FROM t_question_concern WHERE user_id=1 AND question_id=2 LIMIT 1');

		if ($result->fetch_assoc()) $this->assertEquals(true, true);
		else $this->assertEquals(true, false);
	}

	public function testJoinInQuestion_Failed(){
		clear();
		$this->expectOutputString('Join failed!');
		joinInQuestion(2, 1,"Jianchang","Bi","2011-01-01 00:00:00");

	}
/***************************************************************************/
	public function testUpdateQuestionTable_OK(){
		clear();
		setup();
		updateQuestionTable(2, "Jianchang","Bi","2011-01-01 00:00:00");
		$result = dbQuery('SELECT concern FROM t_question WHERE id=2 LIMIT 1');
		$row = $result->fetch_assoc();

		$this->assertEquals('Jianchang Bi,2011-01-01 00:00:00.',$row['concern']);
	}

	public function testUpdateQuestionTable_QueryError(){
		clear();
		$this->expectOutputString('Update question info failed!');
		updateQuestionTable(2, "Jianchang","Bi","2011-01-01 00:00:00");
	}
/***************************************************************************/
}

function checkIsOwnerOfQuestion($questionId, $userId){
	$sql='SELECT id FROM t_question where id = '.$questionId.' AND stdnt_user_id <> '.$userId.' LIMIT 1';
	$result = dbQuery($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			return true;
		}else{
			echo 'Question cannot be joined in by owner!';
			return false;
		}
	}
	return true;
}

function getJoinedQuestionIds($questionId, $userId){
	//Get all questions id joined by current user
	$sql='SELECT question_id FROM t_question_concern WHERE user_id = '.$userId;
	$result = dbQuery($sql);
	$numRow = 0;
	if($result) {
		$isJoinedIds=array();
		while($row = $result->fetch_assoc()) {
			$numRow++;
			if($questionId==$row['question_id']){
				echo 'Question cannot be joined twice!';
				return false;
			}	
		}
	}
	if($numRow==0){
		echo 'Cannot get concern information!';
		return false;
	}
	return true;
}

function joinInQuestion($questionId, $userId,$firstName,$lastName,$createdTime){
	//Join in the question 
	$sql='INSERT INTO t_question_concern (question_id, user_id, first_name, last_name, created_time) VALUE ('.$questionId.', '.$userId.', "'.$firstName.'", "'.$lastName.'", "'.$createdTime.'")';
	$result = dbQuery($sql);
	if($result) {
		echo 'Join success!';
		return true;
	}else {
		echo 'Join failed!';
		return false;
	}
	return true;
}

function updateQuestionTable($questionId, $firstName,$lastName,$createdTime){
	//update the question table
	$concern = $firstName.' '.$lastName.','.$createdTime.'.';
	$sql='UPDATE t_question SET num_liked = num_liked + 1, concern = concat(IFNULL(concern,""),"'.$concern.'") where id='.$questionId.' LIMIT 1';
	$result = dbQuery($sql);
	if($result==1) {
		return true;
	}else{
		echo 'Update question info failed!';
		return false;
	}
	return true;
}
/***************************************************************************/
function dbQuery($sql){
	$mysqli = new mysqli("localhost", "root", "1588", "test_db");
	if(strpos($sql,'UPDATE')===0){
		$mysqli->query($sql);
		$rows = $mysqli->affected_rows;
		$mysqli->close();
		return $rows;
	}else{
		$result = $mysqli->query($sql);
		$mysqli->close();
		return $result;
	}
}

function setup(){
	dbQuery('INSERT INTO t_user (id, first_name, last_name, osu_id, role) VALUE (1, "Jianchang","Bi","bij",0)');

	dbQuery('INSERT INTO t_user (id, first_name, last_name, osu_id, role) VALUE (2, "Some","One","smo",0)');
	
	dbQuery('INSERT INTO t_class (id, name) VALUE(1,"test")');

	dbQuery('INSERT INTO t_question (id, class_id, stdnt_first_name, stdnt_last_name, stdnt_user_id, created_time, title, description, preferred_time, status, concern, num_liked) VALUE (1,1,"Jianchang","Bi",1,"2011-01-01 00:00:00","test","test","2011-01-01 00:00:00",0,"",0)');

	dbQuery('INSERT INTO t_question (id, class_id, stdnt_first_name, stdnt_last_name, stdnt_user_id, created_time, title, description, preferred_time, status, concern, num_liked) VALUE (2,1,"Some","One",2,"2011-01-01 00:00:00","test","test","2011-01-01 00:00:00",0,"",0)');

	dbQuery('INSERT INTO t_question (id, class_id, stdnt_first_name, stdnt_last_name, stdnt_user_id, created_time, title, description, preferred_time, status, concern, num_liked) VALUE (3,1,"Some","One",2,"2011-01-01 00:00:00","test","test","2011-01-01 00:00:00",0,"Jianchang Bi,2011-01-01 00:00:00.",1)');

	dbQuery('INSERT INTO t_question_concern (question_id, user_id, first_name, last_name, created_time) VALUE (3,1,"Jianchang","Bi","2011-01-01 00:00:00")');
}

function clear(){
	dbQuery('DELETE FROM t_question_concern');

	dbQuery('DELETE FROM t_user');

	dbQuery('DELETE FROM t_question');

	dbQuery('DELETE FROM t_class');
}

?>