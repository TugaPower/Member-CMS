<?php
/**
 * Class used to register an user on the website
 */
error_reporting(0);

//Import useful files
require_once("utils/functions.php");

//Check if the user is logged
isLogged_login();

//URL arguments
$usernameExists = $_GET["usernameExists"];
$username = $_GET["username"];
$emailExists = $_GET["emailExists"];
$email = $_GET["email"];
$success = $_GET["success"];
$error = $_GET["error"];
$empty = $_GET["empty"];

//Check if there is any URL argument. If there is, print out a message
//Check if the username exists
if ($usernameExists) {
	echo "username exists! " . $username;
}
//Check if the email exists
if ($emailExists) {
	echo "email exists! " . $email;
}
//Everything went right
if ($success) {
	echo "success!";
}
//Something wrong happened
if ($error) {
	if ($error == "true") {
		echo "error!";
	} else {
		echo "error: " . $error;
	}
}
//Something is empty
if ($empty) {
	echo "something is empty!";
}
?>

<form action="do/adminRegister.php" method="post">
	Username: <input type="text" name="username" required autofocus autocomplete/>
	Password: <input type="password" name="password" pattern=".{6,99}" required autocomplete/>
	Email: <input type="email" name="email" required autocomplete/>
	Conta Mojang? <input type="checkbox" name="isMojangAccount" value="true"/>
	<input type="submit" value="Registar"/>
</form>