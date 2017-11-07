<?php

	include_once 'db_config/conn.php';

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
			$onididPattern = '/\\<cas\\:user\\>([a-zA-Z0-9]+)\\<\\/cas\\:user\\>/';
			$firstnamePattern = '/\\<cas\\:firstname\\>([a-zA-Z0-9]+)\\<\\/cas\\:firstname\\>/';
			$lastnamePattern = '/\\<cas\\:lastname\\>([a-zA-Z0-9]+)\\<\\/cas\\:lastname\\>/';
			preg_match($onididPattern, $html, $onididMatches);
			preg_match($firstnamePattern, $html, $firstnameMatches);
			preg_match($lastnamePattern, $html, $lastnameMatches);
			if ($onididMatches && count($onididMatches) > 0 && $firstnameMatches && count($firstnameMatches) > 0 && $lastnameMatches && count($lastnameMatches) > 0) {
				$onidid = $onididMatches[1];
				$_SESSION["onidid"] = $onidid;

				$firstname = $firstnameMatches[1];
				$_SESSION['firstname'] = $firstname;

				$lastname = $lastnameMatches[1];
				$_SESSION['lastname'] = $lastname;

				$_SESSION["ticket"] = $ticket;
				return $onidid;
			}
		} else if ($doRedirect) {
			$url = "https://login.oregonstate.edu/cas/login?service=".$pageURL;
			echo "<script>location.replace('" . $url . "');</script>";
		}

		return "";
	}

	// Return: {true: first time, false: returning visitor (session variables for first/last name and role set)}
	function checkFirstTime($mysqli) {

		// select first name, last name, and role to verify returning student
		if ($selectStatement = $mysqli->prepare("SELECT first_name, last_name, role FROM t_user WHERE osu_id=? LIMIT 1")) {
			$onidid = mysqli_real_escape_string($mysqli, strip_tags($_SESSION['onidid']));
			$selectStatement->bind_param("s", $onidid);
			$selectStatement->execute();
			$result = $selectStatement->get_result();

			// get results
			$return = "empty";
			if ($result->num_rows > 0) {
				$result = $result->fetch_assoc();
				$_SESSION['firstname'] = $result['first_name'];
				$_SESSION['lastname'] = $result['last_name'];
				if ($result['role'] == 0) {
					$_SESSION['role'] = 'student';
				} else if ($result['role'] == 2) {
					$_SESSION['role'] = 'admin';
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
	if (checkAuth(true) != "") {

		//	save the user_name in Session_Storage
		echo "<script>sessionStorage['user_name'] = '" . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . "';</script>";

		$firstVisit = checkFirstTime($mysqli);
		if ($firstVisit == true) {
			// redirect to select role
			$redirectURL = "selectrole.php";
			// header("Location: $redirectURL");
			echo "<script>window.location.href='" . $redirectURL . "'</script>";
		} else if ($firstVisit == false) {

			// authenticated and returning user
			if ($_SESSION['role'] == "student") {
				$redirectURL = "studentsQuestions.html";
			} else if ($_SESSION['role'] == "admin") {
				$redirectURL = "adminDashboard.php";
			} else {
				$redirectURL = "ta.html";
			}
			// header("Location: $redirectURL");
			echo "<script>window.location.href='" . $redirectURL . "'</script>";
		}
	} else {
		echo "Not authenticated";
	}


?>
