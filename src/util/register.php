<?php
	include_once("../utils.php");

	if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> You don't have permissions to be in this page.</h3>";
		die();
	}

	if(!isset($_POST["username"]) || !isset($_POST["password"])) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-info\"></i> No username and/or password provided, ignoring request.</h3>";
		die();
	}

	$con = startDBConnection();

	$query = "INSERT INTO $db_database.members (username, password) VALUES (\"". $_POST["username"] ."\", \"". $_POST["password"] ."\")";
	if(!mysqli_query($con, $query))
		die('Error: '. $con->error);
	else
		echo($_POST["username"] ." added successfully.");