<?php
	require_once ('../db_config/conn2.php');
	include_once ('check_user.php');


	/*
	*	Questions Request Class
	*/
	class QuestionRequest
	{
		private static $method_type = array('get', 'post', 'put', 'patch', 'delete');

		public static function getRequest() {
			//	request method
	        $method = strtolower($_SERVER['REQUEST_METHOD']);
	        if (in_array($method, self::$method_type)) {
		        //	call request method
	            $data_name = $method . 'Question';
	            return self::$data_name($_REQUEST);
	        }
	        return false;
		}

		//	GET
		private static function getQuestion($request_data)
		{
		}

		//	POST
		private static function postQuestion($request_data)
		{
		}

		//	PUT
		private static function putQuestion($request_data)
		{
		}

		//	PATCH
		private static function patchQuestion($request_data)
		{
		}

		//	DELETE
		//	questions.php/{question_id}
		private static function deleteQuestion($request_data)
		{
			$data = array();

			$url = $_SERVER['REQUEST_URI'];
			$index = strpos($url, 'questions.php') + 14;
			if($index < strlen($url)) {

				$index_slash = strpos($url, '/', $index);
				if($index_slash < strlen($url) && $index_slash > $index) {
					$question_id = substr($url, $index, $index_slash-$index);
				}
				else {
					$question_id = substr($url, $index, strlen($url)-$index);
				}
			}

			// Invalid parameter, no question_id
			if(!isset($question_id)){
				$data['code'] = 400;
				$data['message'] = "Invalid Parameter";
				$data['data'] = "Failed to get question_id!";
				return $data;
			}
			$data['code'] = 200;
			$data['message'] = "OK";
			$data['data'] = "Success"  . ' Question id = ' . $question_id;
			return $data;
		}
	}

	/*
	*	Questions Response Class
	*/
	class QuestionResponse {

		const HTTP_VERSION = "HTTP/1.1";

		public static function sendResponse($data) {
		   	header(self::HTTP_VERSION . " " . $data['code'] . " " . $data['message']);
			header("Content-Type: application/json");
			echo self::encodeJson($data['data']);
	   	}

		private static function encodeJson($responseData) {
		   	return json_encode($responseData);
		}
	}

	$data = QuestionRequest::getRequest();

	QuestionResponse::sendResponse($data);

	// $onid = $_SESSION['onidid'];
	// $firstname = $_SESSION['firstname'];
	// $lastname = $_SESSION['lastname'];
    //
	// if(!isset($onid) || !isset($firstname) || !isset($lastname)){
	// 	exit(json_encode(array('ERROR'=>'Cannot get user information!')));
	// }

	//check the user is ta or not, only ta can assign question, role of ta is 1
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

	// $stmt = $mysqli->prepare($sql);
	// $stmt->bind_param("issi", $user_id, $firstname, $lastname, $question_id);
	// $stmt->execute();

	// echo json_encode(array('SUCCESS'=>'Status update successfully!'));
	// $mysqli->close();

?>
