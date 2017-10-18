<?php
	require('../db_config/conn.php');

	$classData = json_decode(file_get_contents("php://input"), true);

	//Get user_id(ONID) from session
	$userId = $_SESSION['onidid'];

	//Check is current user a TA or is the user exist
	$sql = 'SELECT role, id FROM t_user WHERE osu_id = "'.$userId.'"';
	$result = $mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$role = $row['role'];
			$id = $row['id'];
			if($role!='1'){
				$mysqli->close();
				exit('No permission!');
			}
		}else{
			$mysqli->close();
			exit('Please sign up first!');
		}
	}
	
	//Get class info from front end 
	$name = $classData['NAME'];
	$needAdd = $classData['NEEDADD'];

	//Check is the name legal
	if($name=='' ||$name==NULL){
		$mysqli->close();
		exit('Empty class name is not accepted!');
	}
	
	//Insert the new class
	$sql = 'INSERT INTO t_class (name) VALUE ("'.$name.'")';
	$result = $mysqli->query($sql);
	if($result) 
		echo 'Create succeed!';
	else{
		$mysqli->close();
		exit('Create failed!');
	}
	
	//Select the class for current user
	if($needAdd){

		//Get the id of class
		$sql = 'SELECT id FROM t_class WHERE name = "'.$name.'"';
		$result = $mysqli->query($sql);
		if($result) {
			if($row = $result->fetch_assoc()){
				$classId = $row['id'];
			}else{
				$mysqli->close();
				exit('No such class!');
			}
		}
		
		//Insert the relationship
		$sql = 'INSERT INTO r_user_class (user_id, class_id) VALUE ('.$id.','.$classId.')';
		$result = $mysqli->query($sql);
		if($result) 
			echo 'Join in class succeed!';
		else{
			echo 'Join in class failed!';
		}

	}
	$mysqli->close();

?>
