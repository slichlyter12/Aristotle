<?php

use PHPUnit\Framework\TestCase;

function addingClassToTable($courseName, $id){
	$sql = "INSERT INTO t_class(id, name) Values (?,?)";
	if ($statement = $mysqli->prepare($sql)) {
		$statement->bind_param('is', $id, $courseName);
		$statement->execute();
		$statement->close();
	}
	$sql = "SELECT * FROM t_class WHERE name='".$courseName."'";
	$res = $mysqli->query($sql);
	if ($res->num_rows > 0) {
		$sql = "DELETE FROM t_class WHERE name='".$courseName."' AND id=".$id;
		$mysqli->query($sql);
		return true;	
	}
	else {
		return false;	
	}
}

class CreateCourseUnitTest extends TestCase {
	public function testAddingClassToTable() {
		$res = addingClassToTable("TESTING CLASS", "1234");
		$this->assertEquals(true, $res);	
	} 
		
}

?>
