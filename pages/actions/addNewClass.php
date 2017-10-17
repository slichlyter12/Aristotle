<?php
	require('../db_config/conn.php');

	$classData = json_decode(file_get_contents("php://input"), true);

	$userId = $_SERVER['HTTP_USERID'];

	//Check is current user a TA or is the user exist
	$sql = 'SELECT role, id FROM t_user WHERE osu_id = "'.$userId.'"';
	$result = mysql_query($sql);
	if($result) {
		if($row=mysql_fetch_array($result,MYSQL_ASSOC)){
			$role = $row['role'];
			$id = $row['id'];
			if($role!='1'){
				mysql_close();
				exit('No permission!');
			}
		}else{
			mysql_close();
			exit('Please sign up first!');
		}
	}
	
	//Get class info from front end 
	$name = $classData['NAME'];
	$needAdd = $classData['NEEDADD'];

	//Insert the new class
	$sql = 'INSERT INTO t_class (name) VALUE ("'.$name.'")';
	$result = mysql_query($sql);
	if($result) 
		echo 'Create succeed!';
	else{
		mysql_close();
		exit('Create failed!');
	}
	
	//Select the class for current user
	if($needAdd){
		$sql = 'SELECT id FROM t_class WHERE name = "'.$name.'"';
		$result = mysql_query($sql);
		if($result) {
			if($row=mysql_fetch_array($result,MYSQL_ASSOC)){
				$classId = $row['id'];
			}else{
				mysql_close();
				exit('No such class!');
			}
		}

		$sql = 'INSERT INTO r_user_class (user_id, class_id) VALUE ('.$id.','.$classId.')';
		$result = mysql_query($sql);
		if($result) 
			echo 'Join in class succeed!';
		else{
			echo 'Join in class failed!';
		}

	}
	mysql_close();

?>
