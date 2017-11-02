<?php
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase {
	public function testCheckTA_NotTA() {
		$userId = 'bij';
		$role = '0';

		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id, role) VALUE ("Test","Test","'.$userId.'",'.$role.')';
		dbQuery($sql);

		$this->expectOutputString('No permission!');
		checkTA($userId);

		$sql = 'DELETE FROM t_user ';
		dbQuery($sql);
	}

	public function testCheckTA_OK() {
		$userId = 'bij';
		$role = '1';

		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id, role) VALUE ("Test","Test","'.$userId.'",'.$role.')';
		dbQuery($sql);

		$this->assertNotEmpty(checkTA($userId));

		$sql = 'DELETE FROM t_user';
		dbQuery($sql);

	}

	public function testCheckTA_NoSuchUser() {
		$userId = 'bij';
		$role = '1';
		$_userId = 'others';

		$sql = 'INSERT INTO t_user (first_name, last_name, osu_id, role) VALUE ("Test","Test","'.$userId.'",'.$role.')';
		dbQuery($sql);
	
		$this->expectOutputString('Please sign up first!');
		checkTA($_userId);

		$sql = 'DELETE FROM t_user';
		dbQuery($sql);
	}

}
		function checkTA($userId){
			global $mysqli;
			$sql = 'SELECT role, id FROM t_user WHERE osu_id = "'.$userId.'"';
			$result = dbQuery($sql);
			if($result) {
				if($row = $result->fetch_assoc()){
					$role = $row['role'];
					if($role!='1'){
						echo('No permission!');
						return false;
					}
				}else{
					echo('Please sign up first!');
					return false;
				}
			}else{
				echo('Find user info error!');
				return false;

			}
			return true;
		}
function dbQuery($sql){
	$mysqli = new mysqli("localhost", "root", "1588", "test_db");
	$result = $mysqli->query($sql);
	$mysqli->close();
	return $result;
	
}

?>