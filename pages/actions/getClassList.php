<?php
	require('../db_config/conn.php');
	
	//Get user_id(ONID) from requestHead
	$userId = $_SERVER['HTTP_USERID'];
	
	//Check is current user a TA or is the user exist
	$sql='SELECT id, role FROM t_user WHERE osu_id ="'.$userId.'"';
	$result=mysql_query($sql);
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
	

	//Get all classes id selected by current user
	$sql='SELECT class_id FROM r_user_class WHERE user_id = '.$id;
	$result=mysql_query($sql);
	if($result) {
		$selectedClass=array();
		$i=0;
		while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
			$selectedClass[$i]=$row['class_id'];
			$i++;
		}
	}


	//Get all classes info
	$sql="SELECT id, name FROM t_class";
	$resultAll=mysql_query($sql);
	if($resultAll) {
		$classInfos=array();
		$i=0;
		while($row=mysql_fetch_array($resultAll,MYSQL_ASSOC)){
			$classInfos[$i]['NAME']=$row['name'];
			if(in_array($row['id'],$selectedClass))
				$classInfos[$i]['ISSELECT']=1;
			else
				$classInfos[$i]['ISSELECT']=0;
			$i++;
		}
	}

	echo json_encode(array('CLASSES'=>$classInfos));
	mysql_free_result($resultAll);
	mysql_close();
?>
