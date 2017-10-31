<?php

	// start session on every page
	session_start();

	// $db = json_decode(file_get_contents("../../db/config.json"), true);
	$dbhost = 'localhost';
	$dbname = 'cs561';
	$dbuser = 'demo';
	$dbpass = 'demo';
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Could not connect to database");

?>
