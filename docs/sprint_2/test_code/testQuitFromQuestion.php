<?php
use PHPUnit\Framework\TestCase;

class QuitFromQuestionUnitTest extends TestCase {
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
		$this->expectOutputString('The question cannot be quited by owner!');
		checkIsOwnerOfQuestion(1, 1);
		clear();
	}
/***************************************************************************/
	public function testCheckIsHasBeenJoined_OK(){
		clear();
		setup();
		$result = checkIsHasBeenJoined(3, 1);
		$this->assertEquals(true, $result);
	}

	public function testCheckIsHasBeenJoined_HasJoined(){
		clear();
		setup();
		$this->expectOutputString('You even did not join in this question!');
		checkIsHasBeenJoined(2, 1);
	}
/***************************************************************************/
	public function testQuitFromQuestion_OK(){
		clear();
		setup();
		quitFromQuestion(3, 1);
		$result = dbQuery('SELECT * FROM t_question_concern WHERE user_id=1 AND question_id=3 LIMIT 1');

		if (!$result->fetch_assoc()) $this->assertEquals(true, true);
		else $this->assertEquals(true, false);
	}

	public function testQuitFromQuestion_Failed(){
		clear();
		$this->expectOutputString('Quit failed!');
		quitFromQuestion(2, 1);

	}
/***************************************************************************/
	public function testUpdateQuestionTable_OK(){
		clear();
		setup();
		updateQuestionTable(2, "Jianchang","Bi","2011-01-01 00:00:00");
		$result = dbQuery('SELECT concern FROM t_question WHERE id=2 LIMIT 1');
		$row = $result->fetch_assoc();

		$this->assertEquals('',$row['concern']);
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
			echo 'The question cannot be quited by owner!';
			return false;
		}
	}
	return true;
}

function checkIsHasBeenJoined($questionId, $userId){
	//Get all questions id joined by current user
	$sql='SELECT created_time FROM t_question_concern WHERE user_id = '.$userId.' AND question_id = '.$questionId.' LIMIT 1';
	$result = dbQuery($sql);
	if($result) {
		if($row = $result->fetch_assoc()) {
			return true;
		}else{
			echo 'You even did not join in this question!';
			return false;
		}
	}
	return false;
}

function quitFromQuestion($questionId, $userId){

	$sql='DELETE FROM t_question_concern WHERE user_id = '.$userId.' AND question_id = '.$questionId.' LIMIT 1';
	$result = dbQuery($sql);
	if($result) {
		echo 'Quit success!';
		return true;
	}else {
		echo 'Quit failed!';
		return false;
	}
	return true;
}

function updateQuestionTable($questionId, $firstName,$lastName,$createdTime){
	//update the question table
	$concern = $firstName.' '.$lastName.','.$createdTime.'.';
	$sql='UPDATE t_question SET num_liked = num_liked - 1, concern = replace(concern, \''.$concern.'\',\'\') where id='.$questionId.' LIMIT 1';
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
	if(strpos($sql,'UPDATE')===0||strpos($sql,'DELETE')===0){
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