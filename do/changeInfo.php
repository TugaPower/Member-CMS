<?php
/**
 * Class used to change the user's information on request
 */
error_reporting(0);
//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

//POST arguments
$username = $_POST["username"];
$email = $_POST["email"];
$mojang = $_POST["mojang"];
$password = md5($_POST["password"]);
$passwordVerify = md5($_POST["passwordVerify"]);
$currentPassword = md5($_POST["currentPassword"]);

//Variables
$currentUsername = getUsername();
$somethingChanged = false;

//MySQL queries
$checkIfPasswordIsValid = "SELECT `password` FROM `members` WHERE `username` = \"$currentUsername\" AND `password` = \"$currentPassword\"";
$getCurrentUsername = "SELECT `username` FROM `members` WHERE `username` = \"$currentUsername\"";
$changeUsername = "UPDATE `members` SET `username` = \"$username\" WHERE `username` = \"$currentUsername\"";
$getCurrentEmail = "SELECT `email` FROM `members` WHERE `username` = \"$currentUsername\"";
$changeEmail = "UPDATE `members` SET `email` = \"$email\" WHERE `username` = \"$currentUsername\"";
$getCurrentIsMojang = "SELECT `isMojangAccount` FROM `members` WHERE `username` = \"$currentUsername\"";
$changeIsMojang = "UPDATE `members` SET `isMojangAccount` = \"$mojang\" WHERE `username` = \"$currentUsername\"";
$getCurrentPassword = "SELECT `password` FROM `members` WHERE `username` = \"$currentUsername\"";
$changePassword = "UPDATE `members` SET `password` = \"$password\" WHERE `username` = \"$currentUsername\"";

//The current password exists
//Check if the current password is valid
if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfPasswordIsValid)) == 1) {
	//The password is valid
	//Check if the username isn't empty
	if ($username != "") {
		//Check if the username changed
		if (mysqli_fetch_array(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $getCurrentUsername))[0] != $username) {
			//The username isn't the same
			if (mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $changeUsername)) {
				//Success!
				$somethingChanged = true;
			} else {
				//An error occurred
				echo "<script type\"Javascript\">window.location = \"../account.php?error=true\";</script>";
			}
		}
	}

	//Check if the email isn't empty
	if ($email != "") {
		//Check if the email changed
		if (mysqli_fetch_array(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $getCurrentEmail))[0] != $email) {
			//The email isn't the same
			if (mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $changeEmail)) {
				//Success!
				$somethingChanged = true;
			} else {
				//An error occurred
				echo "<script type\"Javascript\">window.location = \"../account.php?error=true\";</script>";
			}
		}
	}

	//Check if the "isMojang" isn't empty
	if ($mojang != "") {
		//Check if the "isMojang" changed
		if (mysqli_fetch_array(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $getCurrentIsMojang))[0] != $mojang) {
			//The "isMojang" isn't the same
			if (mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $changeIsMojang)) {
				//Success!
				$somethingChanged = true;
			} else {
				//An error occurred
				echo "<script type\"Javascript\">window.location = \"../account.php?error=true\";</script>";
			}
		}
	}

	//Check if the passwords aren't empty
	if ($_POST["password"] != "" || $_POST["passwordVerify"] != "") {
		//Check if the passwords provided are the same
		if ($password == $passwordVerify) {
			//Check if the password changed
			if (mysqli_fetch_array(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $getCurrentPassword))[0] != $password) {
				//The password isn't the same
				if (mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $changePassword)) {
					//Success!
					$somethingChanged = true;
				} else {
					//An error occurred
					echo "<script type\"Javascript\">window.location = \"../account.php?error=true\";</script>";
				}
			}
		} else {
			//The passwords provided aren't the same
			echo "<script type\"Javascript\">window.location = \"../account.php?dontMatch=true\";</script>";
		}
	}
} else {
	//The password isn't valid
	echo "<script type\"Javascript\">window.location = \"../account.php?wrongPassword=true\";</script>";
}

if ($somethingChanged)
	echo "<script type\"Javascript\">window.location = \"../do/logout.php?uponChanges=true\";</script>";
else
	echo "<script type\"Javascript\">window.location = \"../account.php?nothingChanged=true\";</script>";