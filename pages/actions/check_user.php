<?php
	require_once ('../db_config/conn.php');
	include_once ("../models/User.class.php");
	include_once ("../models/Class.class.php");

	//parpare sql
	function checkUserSql(){
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
			t_class c, r_user_class r, t_user u, t_question q
		WHERE
			c.id = r.class_id
			AND u.id = r.user_id
			AND q.class_id = r.class_id
			AND u.osu_id = ?
			AND q.id = ?
			AND r.role = ?

		LIMIT 1";

		return $sql;
	}

	// parpare Json object
	function checkUserJson($result){
		while($row = $result->fetch_assoc()){
			//user_info
			$user_info['user_info'] = new User($row['uid'], $row['osu_id'], $row['last_name'], $row['first_name'], $row['u_role']);
			//class_info
			$user_info['class_info'] = new ClassInfo($row['cid'], $row['class_name'], $row['r_role']);
		}

		return $user_info;
	}

	function checkUserByQuestion($osu_id, $question_id, $r_role){
		global $mysqli;
		if(!isset($osu_id)){
			exit(json_encode(array('ERROR'=>'Failed to get onid!')));
		}

		if(!isset($question_id)){
			exit(json_encode(array('ERROR'=>'Failed to get question_id!')));
		}

		$sql = checkUserSql();

		// Preparing sql is failed, exit!
		if(!isset($sql)){
			exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
		}

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("sii", $osu_id, $question_id, $r_role);
		$stmt->execute();
		$result = $stmt->get_result();
		//build Json object
		if(isset($result)) {
			$user_info = checkUserJson($result);
		} else {
			// $mysqli->close();
			exit(json_encode(array('ERROR'=>'You are not TA in this class!')));
		}

		// mysql_free_result($result);

		return $user_info;
	}

	// $mysqli->close();
?>
