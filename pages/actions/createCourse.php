<?php 
	error_reporting(-1);
	$dir = dirname(__FILE__);
	require_once ($dir."/"."../db_config/conn2.php");
	require_once ($dir."/"."class_functions.php");
	require_once ($dir."/"."user_functions.php");
	require_once ($dir."/"."../models/CompleteMsg.class.php");

	$classFunctions = new ClassFunctions();
	$userFunctions = new UserFunctions();

	function complete($mysqli, $isError, $msg, $data){
		global $mysqli;
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}

	function checkSuccess($completeMsg){
		global $mysqli;
		if(isset($completeMsg) && $completeMsg->isError == 1){
		$mysqli->rollback();
		complete($mysqli, $completeMsg->isError, $completeMsg->msg, $completeMsg->data);
		}
		return true;
	}

	$onid = $_SESSION['onidid'];
	$obj = $_POST['x'];
	$ar = json_decode($obj);
	// $sql = "INSERT INTO t_class(id, name) VALUES (?,?)";
	$name = $ar->courseName;
	$class_id = $ar->classId;

	// $id = rand(40,100);
	
	// //add the new course to the DB
	// if ($statement = $mysqli->prepare($sql)) {
	// 	$statement->bind_param('is', $id, $name);
	// 	$statement->execute();
	// 	$statement->close();
	// }

	// foreach ($ar->courseTAs as &$value) {
	// 	//check to see if user exists, if so only add relation
	// 	$sql = "SELECT id FROM t_user WHERE osu_id='".$value."'";
	// 	$res = $mysqli->query($sql);
	// 	if ($res->num_rows > 0) {
	// 		$sql_add_real = "INSERT INTO r_user_class(user_id, class_id, role) VALUES (?, ?, ?)";
	// 		if ($state = $mysqli->prepare($sql_add_real)) {
	// 			$state->bind_param('iii', $res, $id, 1);
	// 			$state->execute();
	// 			$state->close();
	// 		}
	// 	}
	// 	//otherwise add to t_user and the relationship
	// 	else {
	// 		$sql_add_use = "INSERT INTO t_user(first_name, last_name, osu_id, role) VALUES (?,?,?,?)";
	// 		if ($state = $mysqli->prepare($sql_add_use)) {
	// 			$first_name = 'TBA';
	// 			$last_name = 'TBA';
	// 			$role = 1;
	// 			$state->bind_param('sssi', $first_name, $last_name, $value, $role);
	// 			$state->execute();
	// 			$state->close();
	// 		}
	// 		$sql_rel = "SELECT id FROM t_user WHERE osu_id='".$value."'";
	// 		if ($res_rel = $mysqli->query($sql_rel)) {
	// 			$sql_add_real = "INSERT INTO r_user_class(user_id, class_id, role) VALUES (?, ?, ?)";
	// 			$row = $res_rel->fetch_assoc();
	// 			$user_id = $row['id'];
	// 			if ($statement = $mysqli->prepare($sql_add_real)) {
	// 				$role = 1;
	// 				$statement->bind_param('iii', $user_id, $id, $role);
	// 				$statement->execute();
	// 				$statement->close();
	// 			}
	// 		}
	// 	}
		
	// }

	$mysqli->autocommit(false);

	if(!isset($class_id) || $class_id == ""){
		$dbType = "insert";
		//insert class into DB
		$completeMsg = $classFunctions->insertClass($name);
		if(checkSuccess($completeMsg)){
			$class_id = $completeMsg->data;
		}

		$completeMsg = $classFunctions->insertTags($class_id, $ar->courseTags);
		checkSuccess($completeMsg);

	} else {
		$dbType = "update";
		//update class into DB delete relationship
		$completeMsg = $classFunctions->deleteClasses4Tas($class_id, 1);
		checkSuccess($completeMsg);

		$completeMsg = $classFunctions->updateClasses($class_id, $name);
		checkSuccess($completeMsg);

		$completeMsg = $classFunctions->updateTags($class_id, $ar->courseTags);
		checkSuccess($completeMsg);
	}

	//find Users who are not in the DB by Onids
	$completeMsg = $userFunctions->filterUserbyOnids($ar->courseTAs);

	if(checkSuccess($completeMsg)){
		$taOnids = $completeMsg->data;
	}

	//insert tas in DB by Onids
	$completeMsg = $userFunctions->insertTabyOnids($taOnids);
	checkSuccess($completeMsg);

	//insert relationship in DB
	$completeMsg = $classFunctions->insertTa4Class($ar->courseTAs, $class_id, $onid, $dbType);
	checkSuccess($completeMsg);

	$mysqli->commit();
	$mysqli->autocommit(true);

	complete($mysqli, 0, "Create class success!", NULL);
	
?>
