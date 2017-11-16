<?php
/*$isError is a flag sending to front end. Front end will deal with it.
**$isError = 0 : no error
**$isError = 1 : error, stay in current page
**$isError = 2 : error, go back to the previous page
**$isError = 3 : error, go to the login page
*/
function error($mysqli, $isError, $msg, $data){
	$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
	if(isset($mysqli)) $mysqli->close();
	exit(json_encode($return));
}

function success($mysqli, $msg, $data){
	$return = array('ERROR'=> 0, 'MESSAGE'=>$msg, 'DATA'=>$data);
	if(isset($mysqli))
		$mysqli->close();
	exit(json_encode($return));
}

?>