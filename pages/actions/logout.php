<?php
	
	SESSION_START();
	#echo $_SESSION['role'];
	//session_unset();
	$_SESSION = array();
	session_destroy();
	/*if(ini_get("session.use_cookies")) {
		$params = session_get_cookies_params();
		setcookie(session_name(), '', time() - 42000, 
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);	
	}*/
	if (isset($_SESSION['role'])) {
		echo "1";
	} else {
		echo "0";
	}
	//header("Location: ..\welcomePage.html");
?>
