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

	$con = startConnection();
	$encryptedCurrPass = md5(sha1(md5($_POST["current_password"])) . $_POST["current_password"]);
	$encryptedNewPass = md5(sha1(md5($_POST["password"])) . $_POST["password"]);

	// Check if the password is correct
	$queryPassword = "SELECT password FROM ". DB_NAME .".members WHERE username='". $_POST["username_old"] ."' AND password='$encryptedCurrPass'";
	if(mysqli_num_rows(mysqli_query($con, $queryPassword)) < 1) {
		redirect("../index.php?popup=warning&popup_desc=Senha incorreta!");
		die();
	}

	$query = "UPDATE ". DB_NAME .".members SET username='". $_POST["username"] ."', password='". (!empty($_POST["password"]) ? $encryptedNewPass : $encryptedCurrPass) ."', is_mojang_account='". ($_POST["mojang"] ? '1' : '0') ."', email='". $_POST["email"] ."' WHERE username='". $_POST["username_old"] ."'";
	if(!mysqli_query($con, $query)) {
		redirect("../index.php?popup=error&popup_desc=Ocorreu um erro ao atualizar o perfil.");
		die('Error: '. $con->error);
	} else {
		// Update session credentials
		$_SESSION["isMojang"] = $_POST["mojang"];
		$_SESSION["email"] = $_POST["email"];
		redirect("../index.php?popup=success&popup_desc=Perfil atualizado!");
	}

