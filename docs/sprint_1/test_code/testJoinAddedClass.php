<?php
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase {
	public function testGetClassId_OK() {
		$className = 'TEST001';

		$sql = 'INSERT INTO t_class (name) VALUE ("'.$className.'")';
		dbQuery($sql);

		$this->assertNotEmpty(getClassId($className));

		$sql = 'DELETE FROM t_class';
		dbQuery($sql);
	}

	public function testGetClassId_NoSuchClass() {
		$className = 'TEST001';

		$sql = 'INSERT INTO t_class (name) VALUE ("'.$className.'")';
		dbQuery($sql);
		
		$sql = 'DELETE FROM t_class';
		dbQuery($sql);

		$this->expectOutputString('No such class!');
		$this->assertEmpty(getClassId($className));
	}

	public function testGetUserId_OK() {
		$osuId = 'bij';
		$firstName = 'Jianchang';
		$lastName = 'Bi';

		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id) VALUE ("'.$firstName.'","'.$lastName.'","'.$osuId.'")';
		dbQuery($sql);

		$this->assertNotEmpty(getUserId($osuId));

		$sql = 'DELETE FROM t_user';
		dbQuery($sql);
	}

	public function testGetUserId_NoSuchUser() {
		$osuId = 'bij';
		$firstName = 'Jianchang';
		$lastName = 'Bi';

		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id) VALUE ("'.$firstName.'","'.$lastName.'","'.$osuId.'")';
		dbQuery($sql);
		
		$sql = 'DELETE FROM t_user';
		dbQuery($sql);

		$this->expectOutputString('No such user!');
		$this->assertEmpty(getUserId($osuId));
	}
	
	public function testGetUserId_NULLInput() {
		$osuId = 'bij';

		$sql = 'INSERT INTO t_user (osu_id) VALUE ("'.$osuId.'")';
		dbQuery($sql);

		$this->expectOutputString('No such user!');
		$this->assertEmpty(getUserId($osuId));

		$sql = 'DELETE FROM t_user';
		dbQuery($sql);
	}

	public function testSelectClass_OK() {

		$osuId = 'bij';
		$firstName = 'Jianchang';
		$lastName = 'Bi';
		$className = 'TEST001';
		
		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id) VALUE ("'.$firstName.'","'.$lastName.'","'.$osuId.'")';
		dbQuery($sql);
		$userId = getUserId($osuId);

		$sql = 'INSERT INTO t_class (name) VALUE ("'.$className.'")';
		dbQuery($sql);
		$classId = getClassId($className);

		$this->expectOutputString('Join class succeed!');
		selectClass($userId, $classId);

		$sql = 'DELETE FROM t_class';
		dbQuery($sql);

		$sql = 'DELETE FROM t_user';
		dbQuery($sql);

		$sql = 'DELETE FROM r_user_class';
		dbQuery($sql);
	}

	public function testSelectClass_NoSuchUser() {

		$osuId = 'bij';
		$firstName = 'Jianchang';
		$lastName = 'Bi';
		$className = 'TEST001';
		
		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id) VALUE ("'.$firstName.'","'.$lastName.'","'.$osuId.'")';
		dbQuery($sql);
		$userId = getUserId($osuId);

		$sql = 'INSERT INTO t_class (name) VALUE ("'.$className.'")';
		dbQuery($sql);
		$classId = getClassId($className);
		
		$sql = 'DELETE FROM t_user';
		dbQuery($sql);

		$this->expectOutputString('Join class failed!');
		selectClass($userId, $classId);

		$sql = 'DELETE FROM t_class';
		dbQuery($sql);

		$sql = 'DELETE FROM r_user_class';
		dbQuery($sql);
	}

	public function testSelectClass_NoSuchClass() {

		$osuId = 'bij';
		$firstName = 'Jianchang';
		$lastName = 'Bi';
		$className = 'TEST001';
		
		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id) VALUE ("'.$firstName.'","'.$lastName.'","'.$osuId.'")';
		dbQuery($sql);
		$userId = getUserId($osuId);

		$sql = 'INSERT INTO t_class (name) VALUE ("'.$className.'")';
		dbQuery($sql);
		$classId = getClassId($className);
		
		$sql = 'DELETE FROM t_class';
		dbQuery($sql);

		$this->expectOutputString('Join class failed!');
		selectClass($userId, $classId);

		$sql = 'DELETE FROM t_user';
		dbQuery($sql);

		$sql = 'DELETE FROM r_user_class';
		dbQuery($sql);
	}
}

function getClassId($name){
	$sql = 'SELECT id FROM t_class WHERE name = "'.$name.'"';
	$result = dbQuery($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$classId = $row['id'];
			return $classId;
		}else{
			echo('No such class!');
		}
	}
}

function getUserId($osuId){
	$sql = 'SELECT id FROM t_user WHERE osu_id = "'.$osuId.'"';
	$result = dbQuery($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$userId = $row['id'];
			return $userId;
		}else{
			echo('No such user!');
		}
	}
}

function selectClass($id, $classId){
	$sql = 'INSERT INTO r_user_class (user_id, class_id) VALUE ('.$id.','.$classId.')';
	$result = dbQuery($sql);
	if($result) 
		echo 'Join class succeed!';
	else
		echo 'Join class failed!';
}
function dbQuery($sql){
	$mysqli = new mysqli("localhost", "root", "1588", "test_db");
	$result = $mysqli->query($sql);
	$mysqli->close();
	return $result;
	
}
?>