<?php
	$dir = dirname(__FILE__);
	require_once($dir."/"."../db_config/conn2.php");

	class PublicFunctions{
		
		function complete($mysqli, $isError, $msg, $data){
			global $mysqli;
			$return = array('ERROR'=> $isError, 'MESSAGE'=>$msg, 'DATA'=>$data);
			$mysqli->close();
			exit(json_encode($return));
		}

		function checkRollback($completeMsg){
			global $mysqli;
			if(isset($completeMsg) && $completeMsg->isError == 1){
				$mysqli->rollback();
				complete($mysqli, $completeMsg->isError, $completeMsg->msg, $completeMsg->data);
			}
			return true;
		}

		function checkSuccess($completeMsg){
			global $mysqli;
			if(isset($completeMsg) && $completeMsg->isError == 1){
				complete($mysqli, $completeMsg->isError, $completeMsg->msg, $completeMsg->data);
			}
			return true;
		}
	}
?>
