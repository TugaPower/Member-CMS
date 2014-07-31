<?php
	include("../utils.php");

	if(!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["mojang"]) || !isset($_POST["email"])) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-info\"></i> Insufficient information, ignoring request.</h3>";
		die();
	}

	if(usernameExists($_POST["username"])) {
		redirect("../login.php?popup=error&popup_desc=O utilizador <b>". $_POST["username"] ."</b> já está em uso.");
		die();
	}

	$con = startDBConnection();

	// Set the token to used
	$query = "UPDATE $db_database.tokens SET used=1 WHERE token='". $_POST["token"] ."'";
	mysqli_query($con, $query);

	// Add the user to the db
	$encryptedPass = md5(sha1(md5($_POST["password"])) . $_POST["password"]);
	$query = "INSERT INTO $db_database.members (username, password, is_mojang_account, email) VALUES (\"". $_POST["username"] ."\", \"$encryptedPass\", \"". $_POST["mojang"] ."\", \"". $_POST["email"] ."\")";
	if(!mysqli_query($con, $query))
		redirect("../login.php?popup=error&popup_desc=Ocorreu um erro ao registar.");
	else
		redirect("../login.php?popup=success&popup_desc=Podes agora iniciar sessão!");

	closeDBConnection();