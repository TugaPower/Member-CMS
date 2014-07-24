<?php
	include_once("../utils.php");

	if(!isset($_SESSION["isAuthenticated"]) || !$_SESSION["isAuthenticated"]) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> You don't have permissions to be in this page.</h3>";
		die();
	}

	if(!isset($_POST["username"]) || !isset($_POST["username_old"]) || !isset($_POST["password"]) || !isset($_POST["current_password"]) || !isset($_POST["mojang"]) || !isset($_POST["email"])) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-info\"></i> Missing data, ignoring request.</h3>";
		die();
	}

	$con = startDBConnection();

	// Check if the password is correct
	$queryPassword = "SELECT password FROM $db_database.members WHERE username='". $_POST["username_old"] ."' AND password='". $_POST["current_password"] ."'";
	if(mysqli_num_rows(mysqli_query($con, $queryPassword)) < 1) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-warning\"></i> Incorrect password.</h3>";
		die();
	}

	$query = "UPDATE $db_database.members SET username='". $_POST["username"] ."', password='". (!empty($_POST["password"]) ? $_POST["password"] : $_POST["current_password"]) ."', is_mojang_account='". ($_POST["mojang"] ? '1' : '0') ."', email='". $_POST["email"] ."' WHERE username='". $_POST["username_old"] ."'";
	if(!mysqli_query($con, $query))
		die('Error: '. $con->error);
	else {
		echo("Profile update successfully.");

		// Update session credentials
		$_SESSION["isMojang"] = $_POST["mojang"];
		$_SESSION["email"] = $_POST["email"];
	}