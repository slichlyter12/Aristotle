<?php
	
	// start session on every page
	session_start();

	$db = json_decode(file_get_contents("../../db/config.json"), true);
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'likang-db';
	$dbuser = 'likang-db';
	$dbpass = 'UqQzhOSG6H4Z4RLL';
	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("Could not connect to database");	
	
?>