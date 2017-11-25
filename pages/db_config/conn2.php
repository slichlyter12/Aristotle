<?php
	$dir = dirname(__FILE__);
	// start session on every page
	session_start();
	$db = json_decode(file_get_contents($dir."/"."../../db/config.json"), true);
	$mysqli = new mysqli($db["Hostname"], $db["Username"], $db["Password"], $db["Databasename"]) or die("Could not connect to database");
?>
