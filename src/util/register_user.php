<?php
	include_once("../utils.php");

	if(!isset($_POST["ip_address"]) || !isset($_POST["username"]) || !isset($_POST["youtube_account"]) || !isset($_POST["email"]) || !isset($_POST["text"])) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-info\"></i> Insufficient information, ignoring request.</h3>";
		die();
	}

	$con = startDBConnection();
	$query = "INSERT INTO $db_database.applications (ip_address, username, youtube_account, email, text) VALUES (\"". $_POST["ip_address"] ."\", \"". $_POST["username"] ."\", \"". $_POST["youtube_account"] ."\", \"". $_POST["email"] ."\", \"". $_POST["text"] ."\")";
	if(!mysqli_query($con, $query)) {
		redirect("../login.php?popup=error&popup_desc=Ocorreu um erro ao enviar a aplicação.");
	} else {
		redirect("../login.php?popup=success&popup_desc=Aplicação enviada!");
	}
	closeDBConnection();