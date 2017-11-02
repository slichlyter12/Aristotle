<?php 
	require('../db_config/conn.php');
	$obj = $_POST['x'];
	$ar = json_decode($obj);
	$sql = "INSERT INTO t_class(id, name) VALUES (?,?)";
	$name = $ar->courseName;
	$id = rand(40,100);
	
	//add the new course to the DB
	if ($statement = $mysqli->prepare($sql)) {
		$statement->bind_param('is', $id, $name);
		$statement->execute();
		$statement->close();
	}
	/*echo $ar->courseTAs;
	foreach ($ar->courseTAs as &$value) {
		//check to see if user exists, if so only add relation
		echo $value;
		$sql = "SELECT id FROM t_user WHERE osu_id='".$value."'";
		if ($res = $mysqli->query($sql)) {
			$sql_add_real = "INSERT INTO r_user_class(user_id, class_id, role) VALUES (?, ?, ?)";
			if ($state = $mysqli->prepare($sql_add)) {
				$state->bind_param('iii', $res, $id, 1);
				$state->execute();
				$state->close();
			}
		}
		//otherwise add to t_user and the relationship
		else {
			$sql_add_use = "INSERT INTO t_user(first_name, last_name, osu_id, role) VALUES (?,?,?,?)";
			if ($state = $mysqli->prepare($sql_add_use)) {
				$state->bind_param('sssi', "TBA", "TBA", $value, 1);
				$state->execute();
				$state->close();
			}
			$sql = "SELECT id FROM t_user WHERE osu_id='".$value."'";
			if ($res = $mysqli->query($sql)) {
				$sql_add_real = "INSERT INTO r_user_class(user_id, class_id, role) VALUES (?, ?, ?)";
				if ($state = $mysqli->prepare($sql_add)) {
					$state->bind_param('iii', $res, $id, 1);
					$state->execute();
					$state->close();
				}
			}
		}
		
	}*/
	$mysqli->close();
	
?>
