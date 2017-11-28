<?php
	require_once ('../db_config/conn2.php');
	include_once ("../models/Class.class.php");
	


	// //parpare sql
	function buildSql($category){
	   $sql="SELECT 
			c.id cid, 
			c.name class_name, 
			r.role r_role
		FROM 
			t_class c, r_user_class r, t_user u 
		WHERE 
			c.id = r.class_id 
			AND u.id = r.user_id 
			AND u.osu_id = ? ";

		if ($category == "student"){
			$sql = $sql." AND r.role = 0 ";
		} else if ($category == "ta") {
			$sql = $sql." AND r.role = 1 ";
		} else if ($category == "admin") {
			$sql = $sql." AND r.role = 2 ";
		}else if ($category == "all"){
			$sql="SELECT 
				c.id cid, 
				c.name class_name
			FROM 
				t_class c";}

		return $sql;
	}

	// parpare Json object
	function buildJson($result){
		$classInfos['class_info'] = array();
		$i = 0;
		while($row = $result->fetch_assoc()){
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
	
	$category = $_REQUEST['category'];
	// Can not get category from font page, exit! 
	if(!isset($category) || !($category == "student" || $category == "ta" || $category == "admin" || $category == "all")){
		exit(json_encode(array('ERROR'=>'Failed to get category!')));
	}

	$sql = buildSql($category);
	// Preparing sql is failed, exit! 
	if(!isset($sql)){
		exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
	}

	$stmt = $mysqli->prepare($sql);
	if($category!="all") $stmt->bind_param("s", $onid);
	$stmt->execute();
	$result = $stmt->get_result();

	//build Json object
	if(isset($result)) {
		$classInfos = buildJson($result);
	} else {
		$mysqli->close();
		exit(json_encode(array('ERROR'=>'No class here!')));
	}

	echo json_encode($classInfos);
	//mysql_free_result($result);
	$mysqli->close();
?>
