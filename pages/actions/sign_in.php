<?php
	require('../db_config/conn2.php');
	include ("../models/User.class.php");
	include ("../models/Class.class.php");

	//parpare sql
	function buildSql(){
	   $sql="SELECT
			u.id uid,
			u.osu_id osu_id,
			u.last_name last_name,
			u.first_name first_name,
			u.role u_role,
			c.id cid,
			c.name class_name,
			r.role r_role
		FROM
			t_class c, r_user_class r, t_user u
		WHERE
			c.id = r.class_id
			AND u.id = r.user_id
			AND u.osu_id = ? ";

		return $sql;
	}

	// parpare Json object
	function buildJson($result){
		$classInfos['class_info'] = array();
		$i = 0;
		while($row = $result->fetch_assoc()){
			//user_info
			if($i == 0){
				$classInfos['user_info'] = new User($row['uid'], $row['osu_id'], $row['last_name'], $row['first_name'], $row['u_role']);
			}
			//class_info
			$classInfos['class_info'][$i] = new ClassInfo($row['cid'], $row['class_name'], $row['r_role']);
			$i++;
		}

		return $classInfos;
	}

	$onid = $_SESSION['onidid'];
	//$onid = "900000009";

	if(!isset($onid)){
		exit(json_encode(array('ERROR'=>'Failed to get onid!')));
	}

	$sql = buildSql();

	// Preparing sql is failed, exit!
	if(!isset($sql)){
		exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
	}

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $onid);
	$stmt->execute();
	$result = $stmt->get_result();

	//build Json object
	if(isset($result)) {
		$classInfos = buildJson($result);
	}else{
		$mysqli->close();
		exit(json_encode(array('ERROR'=>'No class here!')));
	}

	echo json_encode($classInfos);
	// mysql_free_result($result);
	$mysqli->close();
?>
