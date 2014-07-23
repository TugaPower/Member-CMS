<?php
/**
 * Class used to process the information from the admin register page
 */
error_reporting(0);
//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

//POST arguments
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

//Encripted password
$encriptedPassword = md5($password);

//Set the $isMojangAccount variable based on the POST arguments
if ($_POST["isMojangAccount"] == "" || $_POST["isMojangAccount"] == null) {
	$isMojangAccount = "false";
} else {
	$isMojangAccount = "true";
}

//MySQL queries
$checkIfAdminExists = "SELECT * FROM `members` WHERE `isAdmin` = \"true\"";
$checkIfUserExists = "SELECT * FROM `members` WHERE `username` = \"$username\"";
$checkIfEmailExists = "SELECT * FROM `members` WHERE `email` = \"$email\"";
$insertIntoTable = "INSERT INTO `members` (`ID`, `username`, `password`, `email`, `isMojangAccount`, `isAdmin`, `joined`) VALUES (NULL, \"$username\", \"$encriptedPassword\", \"$email\", \"$isMojangAccount\", \"true\", CURRENT_TIMESTAMP)";

//Checks if some field is empty
if ($username == "" || $password == "" || $email == "") {
	//Something is empty
	echo "<script type\"Javascript\">window.location = \"../adminRegister.php?empty=true\";</script>";
} else {
	//Nothing is empty
	//Check if the user already exists
	if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfAdminExists)) == 0) {
		//There isn't any admin
		if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfUserExists)) == 1) {
			//The username provided is already on the database
			echo "<script type\"Javascript\">window.location = \"../adminRegister.php?usernameExists=true&username=$username\";</script>";
		} else {
			//The username provided isn't on the database
			if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfEmailExists)) == 1) {
				//The email provided is already on the database
				echo "<script type\"Javascript\">window.location = \"../adminRegister.php?emailExists=true&email=$email\";</script>";
			} else {
				//The username and email provided aren't on the database
				if (mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $insertIntoTable)) {
					//Success - Everything went right
					echo "<script type\"Javascript\">window.location = \"../adminRegister.php?success=true\";</script>";
					mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $updateToken);
				} else {
					//Error
					echo "<script type\"Javascript\">window.location = \"../adminRegister.php?error=true\";</script>";
				}
			}
		}
	} else {
		//Admin already exists
		echo "<script type\"Javascript\">window.location = \"../adminRegister.php?error=true\";</script>";
	}
}