<?php
/**
 * Class used to process the information from the register page
 */
error_reporting(0);
//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

//POST arguments
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$token = $_POST["token"];
$isMojangAccount = $_POST["isMojangAccount"];

//Encripted password
$encriptedPassword = md5($password);

//MySQL queries
$checkIfUserExists = "SELECT * FROM `members` WHERE `username` = \"$username\"";
$checkIfEmailExists = "SELECT * FROM `members` WHERE `email` = \"$email\"";
$insertIntoTable = "INSERT INTO `members` (`ID`, `username`, `password`, `email`, `isMojangAccount`, `isAdmin`, `joined`) VALUES (NULL, \"$username\", \"$encriptedPassword\", \"$email\", \"$isMojangAccount\", \"false\", CURRENT_TIMESTAMP)";
$updateToken = "UPDATE `tokens` SET timesUsed = timesUsed + 1 WHERE token = \"$token\"";

//Checks if some field is empty
if ($username == "" || $password == "" || $email == "" || $token == "") {
	//Something is empty
	echo "<script type\"Javascript\">window.location = \"../register.php?empty=true\";</script>";
} else {
	//Nothing is empty
	//Check if the token is valid
	if (isTokenValid(connectToDatabase($db_host, $db_username, $db_password, $db_database), $token) == "O token submetido � v�lido!") {
		//Check if the user already exists
		if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfUserExists)) == 1) {
			//The username provided is already on the database
			echo "<script type\"Javascript\">window.location = \"../register.php?usernameExists=true\";</script>";
		} else {
			//The username provided isn't on the database
			if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfEmailExists)) == 1) {
				//The email provided is already on the database
				echo "<script type\"Javascript\">window.location = \"../register.php?emailExists=true\";</script>";
			} else {
				//The username and email provided aren't on the database
				if (mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $insertIntoTable)) {
					//Success - Everything went right
					echo "<script type\"Javascript\">window.location = \"../login.php?register=true\";</script>";
					mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $updateToken);
				} else {
					//Error
					echo "<script type\"Javascript\">window.location = \"../register.php?error=true\";</script>";
				}
			}
		}
	} else {
		//The token isn't valid
		echo "<script type\"Javascript\">window.location = \"../register.php?error=" . isTokenValid(connectToDatabase($db_host, $db_username, $db_password, $db_database), $token) . "\";</script>";
	}
}