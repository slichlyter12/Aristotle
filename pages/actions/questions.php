<?php
	require_once ('../db_config/conn2.php');
	include_once ("../models/User.class.php");

	/*
	*	Questions Request Class
	*/
	class QuestionRequest
	{
		private static $method_type = array('get', 'post', 'put', 'patch', 'delete');

		public static function getRequest($mysqli) {
			//	request method
	        $method = strtolower($_SERVER['REQUEST_METHOD']);
	        if (in_array($method, self::$method_type)) {
		        //	call request method
	            $data_name = $method . 'Question';
	            return self::$data_name($_REQUEST, $mysqli);
			}
	        return false;
		}

		//	GET
		private static function getQuestion($request_data, $mysqli)
		{
		}

		//	POST
		private static function postQuestion($request_data, $mysqli)
		{
		}

		//	PUT
		private static function putQuestion($request_data, $mysqli)
		{
		}

		//	PATCH
		private static function patchQuestion($request_data, $mysqli)
		{
		}

		//	DELETE
		//	questions.php/{question_id}
		private static function deleteQuestion($request_data, $mysqli)
		{

			$url = $_SERVER['REQUEST_URI'];
			$question_id = self::getQuestionID($url);

			// Invalid parameter, no question_id
			if(!isset($question_id)){
 				$content = "Failed to get question_id!";
				return self::generateData(400, "Invalid Parameter", $content);
			}

			//	check user role is TA
			if(!(self::checkUserRole(1))) {
				$content = "User is not TA";
				return self::generateData(400, "Invalid User", $content);
			}

			//	sql delete operation
			// if($mysqli->connect_error){
			// 	$mysqli=null;
			// 	$content = "SQL connection Error";
			// 	return self::generateData(400, "SQL error", $content);
			// }
			$sql = "DELETE FROM t_question_concern WHERE question_id = ? ";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("i", $question_id);
			if($stmt->execute()) {

				$sql = "DELETE FROM t_question WHERE id = ? ";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("i", $question_id);
				if($stmt->execute()) {
					$content = "Success, "  . ' Question id = ' . $question_id;
					return self::generateData(200, "OK", $content);
				}
				else {
					$content = "Failed to Execute DELETE question concern SQL " . $mysqli->error;
					return self::generateData(400, "SQL error", $content);
				}
			}
			else {
				$content = "Failed to Execute DELETE question SQL: " . $mysqli->error;
				return self::generateData(400, "SQL error", $content);
			}
		}

		private static function getQuestionID($url) {
			$index = strpos($url, 'questions.php') + 14;
			if($index < strlen($url)) {

				$index_slash = strpos($url, '/', $index);
				if($index_slash < strlen($url) && $index_slash > $index) {
					$question_id = substr($url, $index, $index_slash-$index);
				}
				else {
					$question_id = substr($url, $index, strlen($url)-$index);
				}
				return intval($question_id);
			}
			else {
				return null;
			}
		}

		//	generate the return data array
		private static function generateData($code, $message, $content) {
			$data = array();
			$data['code'] = $code;
			$data['message'] = $message;
			$data['content'] = array("message"=>$content);
			return $data;
		}

		// parpare Json object
		private static function checkUserJson($result){
			while($row = $result->fetch_assoc()){
				//user_info
				$user_info['user_info'] = new User($row['id'], $row['osu_id'], $row['last_name'], $row['first_name'], $row['role']);
			}
			return $user_info;
		}

		//	check user role
		private static function checkUserRole($role) {
			global $mysqli;

			$onid = $_SESSION['onidid'];
			if(!isset($onid)){
				return false;
			}

			$sql = "SELECT * FROM t_user WHERE osu_id = ? ";
			$stmt = $mysqli->prepare($sql);
			$stmt->bind_param("s", $onid);
			$stmt->execute();
			$result = $stmt->get_result();
			if(isset($result)) {
				$user_info = self::checkUserJson($result);
				if($user_info['user_info']->role == $role) {
					return true;
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}
	}

	/*
	*	Questions Response Class
	*/
	class QuestionResponse {

		public static function sendResponse($data) {
		   	header("HTTP/1.1" . " " . $data['code'] . " " . $data['message']);
			header("Content-Type: application/json");
			echo self::encodeJson($data['content']);
			return;
	   	}

		private static function encodeJson($responseData) {
		   	return json_encode($responseData);
		}
	}


	$data = QuestionRequest::getRequest($mysqli);
	QuestionResponse::sendResponse($data);

	// $onid = $_SESSION['onidid'];
	// $firstname = $_SESSION['firstname'];
	// $lastname = $_SESSION['lastname'];
    //
	// if(!isset($onid) || !isset($firstname) || !isset($lastname)){
	// 	exit(json_encode(array('ERROR'=>'Cannot get user information!')));
	// }

	// check the user is ta or not, only ta can assign question, role of ta is 1
	// $role = 1;
    //
	// $user_info = checkUserByQuestion($onid, $question_id, $role);
	// if($user_info){
	// 	if($firstname == $user_info['user_info']->first_name && $lastname == $user_info['user_info']->last_name){
	// 		$user_id = $user_info['user_info']->id;
	// 	} else {
	// 		exit(json_encode(array('ERROR'=>'User information is error!')));
	// 	}
	// } else {
	// 	exit(json_encode(array('ERROR'=>'User is not a TA in this class!')));
	// }

	// //parpare sql
	// function buildSql(){
	// 	$sql="DELETE FROM `t_question` q WHERE q.id = ? ";
    //
	// 	return $sql;
	// }
    //
	// $sql = buildSql();
    //
	// // Preparing sql is failed, exit!
	// if(!isset($sql)){
	// 	exit(json_encode(array('ERROR'=>'Failed to Prepare sql!')));
	// }
    //
	// $stmt = $mysqli->prepare($sql);
	// $stmt->bind_param("issi", $user_id, $firstname, $lastname, $question_id);
	// $stmt->execute();

	// echo json_encode(array('SUCCESS'=>'Status update successfully!'));
	// $mysqli->close();

?>