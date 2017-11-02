<?php
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase {
	public function testInsertNewClass_OK() {
		$classData =  ["NAME" => "TEST001", "NEEDADD" => ""];

		$this->expectOutputString('Create succeed!');
		insertNewClass($classData);

		$sql = 'SELECT * FROM t_class WHERE name = "'.$classData['NAME'].'"';
		$result = dbQuery($sql);
		$this->assertNotEmpty($result);

		$sql = 'DELETE FROM t_class';
		dbQuery($sql);
	}
	
	public function testInsertNewClass_NULLInput() {
		$classData =  ["NAME" => null, "NEEDADD" => ""];

		$this->expectOutputString('The class name cannot be empty!');
		insertNewClass($classData);

		$sql = 'DELETE FROM t_class';
		dbQuery($sql);
	}
}

function insertNewClass($classData){
	$name = $classData['NAME'];
	$needAdd = $classData['NEEDADD'];

	if($name=="" ||$name==NULL){
		echo 'The class name cannot be empty!';
		return;
	}

	$sql = 'INSERT INTO t_class (name) VALUE ("'.$name.'")';
	$result = dbQuery($sql);
	if($result) 
		echo 'Create succeed!';
	else
		echo 'Create failed!';
}

function dbQuery($sql){
	$mysqli = new mysqli("localhost", "root", "1588", "test_db");
	$result = $mysqli->query($sql);
	$mysqli->close();
	return $result;
	
}
?>