<?php
/**
 * Class used to authenticate the user from the launcher
 */
error_reporting(0);
//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

//POST arguments
$username = $_POST["username"];
$password = $_POST["password"];

//MySQL queries
$checkIfUsernameExists = "SELECT * FROM `members` WHERE `username` = \"$username\"";
$doesUsernameAndPasswordMatch = "SELECT * FROM `members` WHERE `username` = \"$username\" AND `password` = \"$password\"";
$isMojangAccount = "SELECT * FROM `members` WHERE `username` = \"$username\" AND `isMojangAccount` = \"true\"";
$getUsername = "SELECT `username` FROM `members` LIMIT 0, 30 ";
$getEmail = "SELECT `email` FROM `members` WHERE `username` = \"$username\"";

if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfUsernameExists)) == 1) {
	//Username existes
	if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $doesUsernameAndPasswordMatch)) == 1) {
		//Username and password matches
		if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $isMojangAccount)) == 1) {
			//Mojang email detected
			$mojangEmail = mysqli_fetch_array(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $getEmail));
			echo $username . ":" . $mojangEmail[0];
		} else {
			//No Mojang email detected
			echo $username;
		}
	} else {
		//Username and password don't match
		echo "A password n�o coincide com o username submetido!";
	}
} else {
	//Username doesn't exist
	echo "O username n�o existe!";
}