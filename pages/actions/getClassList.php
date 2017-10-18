<?php
	require('../db_config/conn.php');
	
	//Get user_id(ONID) from session
	$userId = $_SESSION['onidid'];
	
	//Check is current user a TA or is the user exist
	$sql='SELECT id, role FROM t_user WHERE osu_id ="'.$userId.'"';
	$result=$mysqli->query($sql);
	if($result) {
		if($row = $result->fetch_assoc()){
			$role = $row['role'];
			$id = $row['id'];
			if($role!='1'){
				$mysqli->close();
				exit(json_encode(array('ERROR'=>'No permission!')));
			}
		}else{
			$mysqli->close();
			exit(json_encode(array('ERROR'=>'Please sign up first!')));
		}
	}
	

	//Get all classes id selected by current user
	$sql='SELECT class_id FROM r_user_class WHERE user_id = '.$id;
	$result=$mysqli->query($sql);
	if($result) {
		$selectedClass=array();
		$i=0;
		while($row = $result->fetch_assoc()){
			$selectedClass[$i]=$row['class_id'];
			$i++;
		}
	}

	//Get all classes info
	$sql="SELECT id, name FROM t_class";
	$resultAll=$mysqli->query($sql);
	if($resultAll) {
		$classInfos=array();
		$i=0;
		while($row = $resultAll->fetch_assoc()){
			$classInfos[$i]['NAME']=$row['name'];
			if(in_array($row['id'],$selectedClass))
				$classInfos[$i]['ISSELECT']=1;
			else
				$classInfos[$i]['ISSELECT']=0;
			$i++;
		}
	}else{
		$mysqli->close();
		exit(json_encode(array('ERROR'=>'No class here!')));
	}

	echo json_encode(array('CLASSES'=>$classInfos));
	mysql_free_result($resultAll);
	$mysqli->close();
?>
