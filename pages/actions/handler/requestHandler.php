<?php
	//Get osu id in session
	function getOsuId($session){
		if(isset($session['onidid'])) 
			$osuId = $session['onidid'];
		else
			error(NULL, 2, 'Please log in first', NULL);
		return $osuId;
	}

	//Get class id in http request
	function getClassId($request){
		if(isset($request['classid'])) 
			$classId = $request['classid'];
		else
			error(NULL, 1, 'No class has been selected!', NULL);
		return $classId;
	}
	
?>
