<?php
	include_once("../utils.php");

	if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> You don't have permissions to be in this page.</h3>";
		die();
	}

	if(!isset($_POST["token"]) || !isset($_POST["expire_date"])) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-info\"></i> No data provided, ignoring request.</h3>";
		die();
	}

	$con = startConnection();
	$query = "INSERT INTO ". DB_NAME .".tokens (token, expire_date) VALUES (\"". $_POST["token"] ."\", \"". $_POST["expire_date"] ."\")";
	if(!mysqli_query($con, $query)) {
		redirect("../index.php?popup=error&popup_desc=Ocorreu um erro ao adicionar o token!");
		die('Error: '. $con->error);
	} else {
		redirect("../index.php?popup=success&popup_desc=Token <b>". $_POST["token"] ."</b> adicionado!");
	}