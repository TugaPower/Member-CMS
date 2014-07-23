<?php
/**
 * Class used to create tokens used in the register page
 */
error_reporting(0);

//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

isLogged_members();

//POST Arguments
$description = $_POST["description"];
$type = $_POST["type"];
$color1 = $_POST["color1"];
$color2 = $_POST["color2"];
$color3 = $_POST["color3"];

$username = getUsername();

//MySQL queries
//"SELECT * FROM `members` WHERE `username` = \"$username\"";
$checkIfFrequencyExists = "SELECT * from `ES_frequencies` WHERE `type` = \"$type\" AND `color1` = \"$color1\" AND `color2` = \"$color2\" AND `color3` = \"$color3\"";
$insertIntoTable = "INSERT INTO `ES_frequencies` (`ID`, `type`, `color1`, `color2`, `color3`, `description`, `owner`, `registered`) VALUES (NULL, \"$type\", \"$color1\", \"$color2\", \"$color3\", \"$description\", \"$username\", CURRENT_TIMESTAMP)";

//Check if some field is empty
if ($description == "" || $type == "" || $color1 == "" || $color2 == "" || $color3 == "") {
	//Something is empty
	echo "<script type\"Javascript\">window.location = \"../freqs.php?empty=true\";</script>";
} else {
	//Nothing is empty
	//Check if frequency already exists
	if (mysqli_num_rows(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $checkIfFrequencyExists)) == 1) {
		//Frequency exists
		echo "<script type\"Javascript\">window.location = \"../freqs.php?exists=true\";</script>";
	} else {
		//Frequency doesn't exist
		if (mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), $insertIntoTable)) {
			echo "<script type\"Javascript\">window.location = \"../freqs.php?success=true\";</script>";
		} else {
			echo "<script type\"Javascript\">window.location = \"../freqs.php?error=true\";</script>";
		}
	}
}

require_once("utils/footer.php");