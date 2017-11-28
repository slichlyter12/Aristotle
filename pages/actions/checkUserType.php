<?php
	require('../db_config/conn2.php');

	function complete($mysqli, $isError, $msg, $data){
		$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
		$mysqli->close();
		exit(json_encode($return));
	}
	
	//Get ONID from session
	$osuId = $_SESSION['onidid'];
	
	//Check is osu id not null
	if($osuId=='null') complete($mysqli, 2, 'Please log in first', NULL);

	//Check is current user a Student or is the user exist:::TODO
	$sql = 'SELECT role FROM t_user WHERE osu_id = "'.$osuId .'"';
	$result = $mysqli->query($sql);

	if($result) {
		$userinfo = array();
		if(!$row = $result->fetch_assoc()) complete($mysqli, 3, 'Please sign up first!', NULL);
		$userinfo['ROLE'] = $row['role'];
		$userinfo['FIRSTNAME'] = $_SESSION['firstname'];
		$userinfo['LASTNAME'] = $_SESSION['lastname'];
		if(!($userinfo['ROLE']=='0'||$userinfo['ROLE']=='1' ||$userinfo['ROLE']=='2')) complete($mysqli, 4, 'No permission!', NULL);
	}
	complete($mysqli, 0, NULL, array('USERINFO'=>$userinfo, '_SESSION'=>json_encode($_SESSION)));

?>
