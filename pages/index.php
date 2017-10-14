<?php
	
	session_start();
		
	function checkAuth($doRedirect) {
		
		// check if ONID exists
		if (isset($_SESSION["onidid"]) && $_SESSION["onidid"] != "") return $_SESSION["onidid"];
	
		// create URL as callback
		$pageURL = 'http';
		if (isset($_SERVER["HTTP"]) && $_SERVER["HTTP"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
		}
	
		// check for ticket
		$ticket = isset($_REQUEST["ticket"]) ? $_REQUEST["ticket"] : "";
	
		// if ticket then set ONID session, else send to login
		if ($ticket != "") {
			$url = "https://login.oregonstate.edu/cas/serviceValidate?ticket=".$ticket."&service=".$pageURL;
			$html = file_get_contents($url);
			$pattern = '/\\<cas\\:user\\>([a-zA-Z0-9]+)\\<\\/cas\\:user\\>/';
			preg_match($pattern, $html, $matches);
			if ($matches && count($matches) > 1) {
				$onidid = $matches[1];
				$_SESSION["onidid"] = $onidid;
				$_SESSION["ticket"] = $ticket;
				return $onidid;
			} 
		} else if ($doRedirect) {
			$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
			echo "<script>location.replace('" . $url . "');</script>";
		} else if ($doRedirect == false) {
			// FIXME: testing
			$_SESSION['onidid'] = "lichlyts";
			$_SESSION['ticket'] = "fakeTicket12345";
			return $_SESSION['onidid'];
		}
		return "";
	}
	
	// Return: {true: first time, false: returning visitor (session variables for first/last name and role set)}
	function checkFirstTime() {
		
		// create connection to database
		$db = json_decode(file_get_contents("../config.json"), true);
		$mysqli = new mysqli($db['Hostname'], $db['Username'], $db['Password'], $db['Databasename']) or die("Could not connect to database");
				
		// select first name, last name, and role to verify returning student
		if ($selectStatement = $mysqli->prepare("SELECT first_name, last_name, role FROM t_user WHERE osu_id=? LIMIT 1")) {
			$selectStatement->bind_param("s", $_SESSION["onidid"]);
			$selectStatement->execute();
			$result = $selectStatement->get_result();
			
			// get results
			$return = "empty";
			if ($result) {
				$result = $result->fetch_assoc();
				$_SESSION['first_name'] = $result['first_name'];
				$_SESSION['last_name'] = $result['last_name'];
				if ($result['role'] == 0) {
					$_SESSION['role'] = 'student';
				} else {
					$_SESSION['role'] = 'ta';
				}
				
				$return = false;
			} else {
				$return = true;
			}
			
			$mysqli->close();
			return $return;
		} else {
			echo "Failed to prepare SELECT";
			return false;
		}
		
		return NULL;
	}
		
	// Authenticated!
	// FIXME: testing
	if (checkAuth(true) != "") {
		$firstVisit = checkFirstTime();
		if ($firstVisit == true) { 
			
			// redirect to select role
			$redirectURL = "selectRole.php";
			header("Location: $redirectURL");
// 			echo "Select role " . $redirectURL;
		} else if ($firstVisit == false) {
			
			// authenticated and returning user
			if ($_SESSION['role'] == "student") {
				$redirectURL = "students.html";
			} else {
				$redirectURL = "ta.html";
			}
			header("Location: $redirectURL");
// 			echo "existing role of " . $_SESSION['role'] . " " . $redirectURL;
		} else if ($firstVisit == false) {
			echo "First visit is Null";
		}
	} else {
		echo "Not authenticated";
	}
	
	
?>
