<?php
/**
 * Class used to create tokens used in the register page
 */
error_reporting(0);

//POST Arguments
$canBeUsed = $_POST["canBeUsed"];
$expires = $_POST["expires"];

//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

isLogged_members();

if (!isAdmin(connectToDatabase($db_host, $db_username, $db_password, $db_database), getUsername())) {
	echo "<script type\"Javascript\">window.location = \"index.php\";</script>";
	die();
}

if ($canBeUsed != "" || $expires != "") {
	echo createToken(connectToDatabase($db_host, $db_username, $db_password, $db_database), $canBeUsed, $expires);
}