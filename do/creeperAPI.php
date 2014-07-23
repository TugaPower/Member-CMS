<?php
/**
 * Class used to control the Minecraft server
 */
error_reporting(0);

//POST Arguments
$start = $_POST["start"];
$restart = $_POST["restart"];
$stop = $_POST["stop"];

//GET arguments
$console = $_GET["console"];

//Import useful files
require_once("../utils/info.php");
require_once("../utils/functions.php");

isLogged_members();

if (!isAdmin(connectToDatabase($db_host, $db_username, $db_password, $db_database), getUsername())) {
	echo "<script type\"Javascript\">window.location = \"index.php\";</script>";
	die();
}

if ($start) {
	$result = file_get_contents("http://api.creeperhost.net/?key=" . $creeper_key . "&method=Control&command=Start");
	echo "Comando executado " . ((substr($result, 0, 4) == "true") ? "com sucesso." : "sem sucesso.");
} elseif ($stop) {
	$result = file_get_contents("http://api.creeperhost.net/?key=" . $creeper_key . "&method=Control&command=Stop");
	echo "Comando executado " . ((substr($result, 0, 4) == "true") ? "com sucesso." : "sem sucesso.");
} elseif ($restart) {
	$result = file_get_contents("http://api.creeperhost.net/?key=" . $creeper_key . "&method=Control&command=Restart");
	echo "Comando executado " . ((substr($result, 0, 4) == "true") ? "com sucesso." : "sem sucesso.");
} elseif ($console) {
	$result = file_get_contents("http://api.creeperhost.net/?key=" . $creeper_key . "&method=Console&command=Get");
	$resultHacked = explode("2014", $result);
	$count = 0;
	foreach ($resultHacked as $line) {
		if ($count != 0) {
			echo "2014" . $line . "</br>";
		}

		$count++;
	}
}