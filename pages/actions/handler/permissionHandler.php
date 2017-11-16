<?php
	//Check the current user is existed
	function checkUser($osuId, $mysqli){
		$sql = 'SELECT id FROM t_user WHERE osu_id = "'.$osuId.'" LIMIT 1';
		$result = $mysqli->query($sql);
		if($result) {
			if(!$row = $result->fetch_assoc())
				error($mysqli, 3, 'Please sign up first!', NULL);
		} else error($mysqli, 1, 'Query error!', NULL);
	}

	//Check the current class is existed
	function checkClass($classId, $mysqli){
		$sql = 'SELECT id FROM t_class WHERE id = '.$classId.' LIMIT 1';
		$result = $mysqli->query($sql);
		if($result) {
			if(!$row = $result->fetch_assoc())
				error($mysqli, 2, 'No such class!', NULL);
		} else error($mysqli, 1, 'Query error!', NULL);
	}
	
	//Check is the current user selected the current class
	function checkUserClass($classId, $userId, $mysqli){
		$sql = 'SELECT * FROM r_user_class WHERE user_id = '.$userId.' AND class_id = '.$classId.' LIMIT 1';
		$result = $mysqli->query($sql);
		if($result) {
			if(!$row = $result->fetch_assoc())
				error($mysqli, 2, 'No permission!', NULL);
		} else error($mysqli, 1, 'Query error!', NULL);
	}

	//Check the role of current user or is the user exist
	function checkRole($role, $classId, $userId, $mysqli){
		if(isset($classId))
			$sql = 'SELECT role FROM r_user_class WHERE class_id = '.$classId.' AND user_id = '.$userId .' LIMIT 1';
		else
			$sql = 'SELECT role FROM t_user WHERE id = '.$userId.' LIMIT 1';
		$result = $mysqli->query($sql);
		if($result) {
			if($row = $result->fetch_assoc()){
				$_role = $row['role'];
				if($_role!=$role) error($mysqli, 3, 'No permission!', NULL);
			} else error($mysqli, 3, 'Please sign up first!', NULL);
		} else error($mysqli, 1, 'Query error!', NULL);
	}
?>
