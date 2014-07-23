<?php
/**
 * Class used to install and configure the system automatically
 */
error_reporting(0);
//Import useful files
require_once("utils/functions.php");
require_once("utils/info.php");

//Check if the database's credentials aren't empty/null
if (($db_host != null && $db_username != null && $db_password != null && $db_database != null) && ($db_host != "" && $db_username != "" && $db_password != "" && $db_database != "")) {
	//Nothing is empty/null
	//If the database doesn't exist, create it
	if (!connectToDatabase($db_host, $db_username, $db_password, $db_database)) {
		//Create the database
		echo createDatabase(connectToDatabase($db_host, $db_username, $db_password, null));
	} else {
		//Check if the database has tables
		$tables = mysqli_fetch_row(mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), "SHOW TABLES"));
		if (count($tables) != 3) {
			//If the database isn't empty, create the tables
			//Create the "members" table
			echo createMembersTable(connectToDatabase($db_host, $db_username, $db_password, $db_database));
			echo "<br>";
			//Create the "tokens" table
			echo createTokensTable(connectToDatabase($db_host, $db_username, $db_password, $db_database));
			echo "<br>";
			//Create the "ES_frequencies" table
			echo createESFrequenciesTable(connectToDatabase($db_host, $db_username, $db_password, $db_database));
			echo "<br>";
			//Redirect the user to the admin register page
			echo "<script type\"Javascript\">window.location = \"adminRegister.php\";</script>";
		} else {
			//The system is already installed and configured
			echo "O sistema j� foi instalado e configurado com sucesso.";
		}
	}
} else {
	//Something is empty/null
	echo "� necess�rio definir as fun��es que permitem a conex�o � base de dados no ficheiro <b>info.php</b>.";
}