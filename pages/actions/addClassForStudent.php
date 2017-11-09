<?php
	require('../db_config/conn2.php');

	function complete($mysqli, $isError, $msg, $data){
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}

	$classesData = json_decode(file_get_contents("php://input"), true);

	//Get user_id(ONID) from session
	$osuId = $_SESSION['onidid'];
	
	//Check is osu id not null
	if($osuId=='null') complete($mysqli, 2, 'Please log in first', NULL);

	//Check is current user a Student or is the user exist
	$sql = 'SELECT role, id FROM t_user WHERE osu_id = "'.$osuId .'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$role = $row['role'];
			$userId = $row['id'];
			if(!($role=='0'||$role=='1')) complete($mysqli, 1, 'No permission!', NULL);
		}else complete($mysqli, 1, 'Please sign up first!', NULL);
	}

	//Reset the selected classes
	$sql = 'DELETE FROM r_user_class WHERE user_id = '.$userId.' AND role=0';
	$result = $mysqli->query($sql);
	if(!$result) complete($mysqli, 1, 'Reset class infomation failed!', NULL);
	
	if(is_array($classesData['classes'])!=1) {
		$classId = $classesData['classes'];
		$sql = 'INSERT INTO r_user_class (user_id, class_id, role) VALUES ('.$userId.', '.$classId.',0)';
		$result = $mysqli->query($sql);
		if(!$result) complete($mysqli, 1, 'Add class failed!', NULL);
	}else{
		$i=0;
		while( $classId = $classesData['classes'][$i]){
			$sql = 'INSERT INTO r_user_class (user_id, class_id, role) VALUES ('.$userId.', '.$classId.',0)';
			$result = $mysqli->query($sql);
			$i++;
			if(!$result) complete($mysqli, 1, 'Add class failed!', NULL);
		}
	}

	complete($mysqli, 0,'Class information updates success!', NULL);
?>
