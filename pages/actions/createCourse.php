<?php 
	error_reporting(-1);
	require('../db_config/conn2.php');
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
	foreach ($ar->courseTAs as &$value) {
		//check to see if user exists, if so only add relation
		$sql = "SELECT id FROM t_user WHERE osu_id='".$value."'";
		$res = $mysqli->query($sql);
		if ($res->num_rows > 0) {
			$sql_add_real = "INSERT INTO r_user_class(user_id, class_id, role) VALUES (?, ?, ?)";
			if ($state = $mysqli->prepare($sql_add_real)) {
				$state->bind_param('iii', $res, $id, 1);
				$state->execute();
				$state->close();
			}
		}
		//otherwise add to t_user and the relationship
		else {
			$sql_add_use = "INSERT INTO t_user(first_name, last_name, osu_id, role) VALUES (?,?,?,?)";
			if ($state = $mysqli->prepare($sql_add_use)) {
				$first_name = 'TBA';
				$last_name = 'TBA';
				$role = 1;
				$state->bind_param('sssi', $first_name, $last_name, $value, $role);
				$state->execute();
				$state->close();
			}
			$sql_rel = "SELECT id FROM t_user WHERE osu_id='".$value."'";
			if ($res_rel = $mysqli->query($sql_rel)) {
				$sql_add_real = "INSERT INTO r_user_class(user_id, class_id, role) VALUES (?, ?, ?)";
				$row = $res_rel->fetch_assoc();
				$user_id = $row['id'];
				if ($statement = $mysqli->prepare($sql_add_real)) {
					$role = 1;
					$statement->bind_param('iii', $user_id, $id, $role);
					$statement->execute();
					$statement->close();
				}
			}
		}
		
	}
	$mysqli->close();
	
?>
