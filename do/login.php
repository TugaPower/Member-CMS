<?php
/**
 * Class used to process the information from the login page
 */

//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

//POST arguments
$username = $_POST["username"];
$password = $_POST["password"];

//Encripted password
$encryptedPassword = md5($password);

//MySQL queries
$checkIfUsernameExists = "SELECT * FROM `members` WHERE `username` = \"$username\"";
$doesUsernameAndPasswordMatch = "SELECT * FROM `members` WHERE `username` = \"$username\" AND `password` = \"$encryptedPassword\"";

if ($username == "" || $password == "") {
	//Something is empty
	echo "<script type\"Javascript\">window.location = \"../login.php?empty=true\";</script>";
} else {
	//Nothing is empty
	if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfUsernameExists)) == 1) {
		//Username exists
		if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $doesUsernameAndPasswordMatch)) == 1) {
			//Username and password match
			session_start();
			$_SESSION["isLogged"] = true;
			$_SESSION["username"] = $username;

			//Save the user's email in the session
			$email = mysqli_fetch_array(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), "SELECT `email` FROM `members` WHERE `username` = \"$username\""));

			if ($email)
				$_SESSION["email"] = $email[0];
			else
				$_SESSION["email"] = "ERROR";

			//Save the user's "isMojangAccount" in the session
			$isMojang = mysqli_fetch_array(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), "SELECT `isMojangAccount` FROM `members` WHERE `username` = \"$username\""));

			if ($isMojang)
				$_SESSION["isMojang"] = $isMojang[0];
			else
				$_SESSION["isMojang"] = "ERROR";

			echo "<script type\"Javascript\">window.location = \"../index.php\";</script>";
		} else {
			//Username and password don't match
			echo "<script type\"Javascript\">window.location = \"../login.php?dontMatch=true\";</script>";
		}
	} else {
		//Username doesn't exist
		echo "<script type\"Javascript\">window.location = \"../login.php?unknownUsername=true\";</script>";
	}
}