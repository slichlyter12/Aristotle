<?php
	
	include_once 'db_config/conn.php';
	
	// set session variables
	$username = mysqli_real_escape_string($mysqli, strip_tags($_SESSION['onidid']));;
	$firstname = mysqli_real_escape_string($mysqli, strip_tags($_SESSION['firstname']));;
	$lastname = mysqli_real_escape_string($mysqli, strip_tags($_SESSION['lastname']));;
	
	// if form submitted, add user to database and redirect
	if (isset($_POST['role'])) {
		
		// sanitize role
		$role = mysqli_real_escape_string($mysqli, strip_tags($_POST['role']));
		if ($role == "TA") {
			$roleInt = 1;
			$redirectURL = "ta.php";
			$_SESSION['role'] = 'ta';
		} else if ($role == "Student") {
			$roleInt = 0;
			$redirectURL = "studentDashboard.php";
			$_SESSION['role'] = 'student';
		} else if ($role == "Admin"){
			 $roleInt = 2;
			 $redirectURL = "adminDashboard.php";
			 $_SESSION['role'] = 'admin';
		} else {
			die("Malicious code detected!");
		}
		
		// add user to database
		if ($insertStatement = $mysqli->prepare("INSERT INTO t_user (first_name, last_name, osu_id, role) VALUES (?, ?, ?, ?)")) {
			$insertStatement->bind_param("sssi", $firstname, $lastname, $username, $roleInt);
			$success = $insertStatement->execute();
			$mysqli->close();
			
			if ($success) {
				// redirect
				header("Location: $redirectURL");
			} else {
				die("Failed to update database");
			}
		} else {
			die("Failed to prepare INSERT statement");
		}		
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Select Role</title>
	</head>
	<body>
		<h1>Welcome <?php echo $firstname . " " . $lastname; ?>!</h1>
		<h2>It appears you haven't visited this site before,</h2>
		<h4>Please select your role below:</h4>
		<form action="selectrole.php" method="post" accept-charset="utf-8">
			<input type="submit" name="role" value="TA">
			<input type="submit" name="role" value="Student">
			<input type="submit" name="role" value="Admin">
		</form>
	</body>
</html>
