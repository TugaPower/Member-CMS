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
	$encryptedPassword = md5(sha1(md5($_POST["password"])) . $_POST["password"]);

	$query = "INSERT INTO $db_database.members (username, password) VALUES (\"". $_POST["username"] ."\", \"$encryptedPassword\")";
	if(!mysqli_query($con, $query)) {
		redirect("../index.php?popup=error&popup_desc=Ocorreu um erro ao adicionar o utilizador!");
		die('Error: '. $con->error);
	} else {
		redirect("../index.php?popup=success&popup_desc=Utilizador adicionado!");
	}