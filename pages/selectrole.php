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
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/login_page/style.css">
		<link rel="stylesheet" href="./css/login_page/home-style.css">
		<link rel="stylesheet" type="text/css" href="css/base.css" />
	</head>
	<body>
		<main>
			<style>@media (min-width:800px) {html { background-image: url(css/login_page/bg/large2); }}</style>
			<h1 style="margin-left:0rem">Welcome <?php echo $firstname . " " . $lastname; ?>!</h1>
			<div class="tagline" style="max-width:100in">
				It appears you haven't visited this site before,
				<br>
				Please select your role below:
			</div>
			<form action="selectrole.php" method="post" accept-charset="utf-8">
				<input class='btn' type="submit" name="role" value="TA" style="margin-right: 1%;">
				<input class='btn' type="submit" name="role" value="Student" style="margin-right: 1%;">
				<input class='btn' type="submit" name="role" value="Admin">
			</form>
		</main>
	</body>
</html>
