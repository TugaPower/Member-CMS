<?php
/**
 * Class used to store useful functions that will be used all over the place
 */
/**
 * Used to connect to the database
 *
 * @param $db_host
 * @param $db_username
 * @param $db_password
 * @param $db_database
 * @return mysqli
 */
function connectToDatabase($db_host, $db_username, $db_password, $db_database)
{
	if ($db_database == null) {
		return mysqli_connect($db_host, $db_username, $db_password);
	} else {
		return mysqli_connect($db_host, $db_username, $db_password, $db_database);
	}
}

/**
 * Used to create the database
 *
 * @param $mysqli_connect (connectToDatabase)
 * @return string
 */
function createDatabase($mysqli_connect)
{
	if (mysqli_query($mysqli_connect, "CREATE DATABASE tugapower")) {
		return "Base de dados criada com sucesso.";
	} else {
		return "Erro ao criar a base de dados.";
	}
}

/**
 * Used to create the table "members" on the database
 *
 * @param $mysqli_connect (connectToDatabase)
 * @return string
 */
function createMembersTable($mysqli_connect)
{
	if (mysqli_query($mysqli_connect, "CREATE TABLE members(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),username TEXT, password TEXT, email TEXT, isMojangAccount TEXT, isAdmin TEXT, joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP)")) {
		return "Tabela \"members\" criada com sucesso.";
	} else {
		return "Erro ao criar a tabela.";
	}
}

/**
 * Used to create the table "tokens" on the database
 *
 * @param $mysqli_connect (connectToDatabase)
 * @return string
 */
function createTokensTable($mysqli_connect)
{
	if (mysqli_query($mysqli_connect, "CREATE TABLE tokens(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),token TEXT, canBeUsed INT, timesUsed INT, created TIMESTAMP DEFAULT CURRENT_TIMESTAMP, expires TIMESTAMP)")) {
		return "Tabela \"tokens\" criada com sucesso.";
	} else {
		return "Erro ao criar a tabela.";
	}
}

/**
 * Used to create the table "ES_frequencies" on the database
 *
 * @param $mysqli_connect (connectToDatabase)
 * @return string
 */
function createESFrequenciesTable($mysqli_connect)
{
	if (mysqli_query($mysqli_connect, "CREATE TABLE ES_frequencies(ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),type TEXT, color1 TEXT, color2 TEXT, color3 TEXT, description TEXT, owner TEXT, registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP)")) {
		mysqli_query($mysqli_connect, "INSERT INTO `ES_frequencies` (`ID`, `type`, `color1`, `color2`, `color3`, `description`, `owner`, `registered`) VALUES (NULL, \"enderchest\", \"white\", \"white\", \"white\", \"Frequ�ncia Padr�o\", \"Servidor\", CURRENT_TIMESTAMP)");
		mysqli_query($mysqli_connect, "INSERT INTO `ES_frequencies` (`ID`, `type`, `color1`, `color2`, `color3`, `description`, `owner`, `registered`) VALUES (NULL, \"endertank\", \"white\", \"white\", \"white\", \"Frequ�ncia Padr�o\", \"Servidor\", CURRENT_TIMESTAMP)");
		return "Tabela \"ES_frequencies\" criada com sucesso.";
	} else {
		return "Erro ao criar a tabela.";
	}
}

/**
 * Used to create a token used that allows people to register
 *
 * @param $mysqli_connect
 * @param $canBeUsed
 * @param $expires
 * @return string
 */
function createToken($mysqli_connect, $canBeUsed, $expires)
{
	date_default_timezone_set("Europe/Lisbon");
	$token = md5(date("d/m/Y h/i/s") . round(microtime(true) * 1000));

	if (mysqli_query($mysqli_connect, "INSERT INTO `tokens` (`ID`, `token`, `canBeUsed`, `timesUsed`, `created`, `expires`) VALUES (NULL, \"$token\", \"$canBeUsed\", \"0\", CURRENT_TIMESTAMP, \"$expires\")")) {
		return "$token";
	} else {
		return "Erro a criar o token!";
	}
}

/**
 * Used to check if a token is valid to use
 *
 * @param $mysqli_connect
 * @param $token
 * @return string
 */
function isTokenValid($mysqli_connect, $token)
{
	//Check if the token exists
	if (mysqli_num_rows(mysqli_query($mysqli_connect, "SELECT * FROM `tokens` WHERE `token` = \"$token\"")) == 1) {
		//Token exists
		//Try to get information from the token
		$getInformation = mysqli_fetch_array(mysqli_query($mysqli_connect, "SELECT * FROM `tokens` WHERE `token` = \"$token\""));

		if ($getInformation) {
			//Can get information
			$canBeUsed = $getInformation[2];
			$timesUsed = $getInformation[3];
			$expirationDate = $getInformation[5];
			$timeDifference = (strtotime($expirationDate) - strtotime(date("Y-m-d H:i:s", time())));
			$timesDifference = ($canBeUsed - $timesUsed);

			//Check if the token isn't expired
			if ($timeDifference >= 0) {
				//The token is valid
				//Ckeck if the token can be used, based on times used
				if ($timesDifference != 0) {
					//The token is valid
					return "O token submetido � v�lido!";
				} else {
					//The token can't be used
					return "O token submetido j� foi usado muitas vezes!";
				}
			} else {
				//The token has expired
				return "O token submetido expirou!";
			}
		} else {
			//Can't get information
			return "Ocorreu um erro a tentar obter informa��es sobre o token submetido.";
		}
	} else {
		//Token doesn't exist
		return "O token submetido n�o existe!";
	}
}

/**
 * Used to redirect users if they shouldn't be in the member area
 */
function isLogged_members()
{
	session_start();
	if (!$_SESSION["isLogged"]) {
		echo "<script type\"Javascript\">window.location = \"login.php?needLogin=true\";</script>";
		die();
	}
}

/**
 * Used to redirect users if they are authenticated
 */
function isLogged_login()
{
	session_start();
	if ($_SESSION["isLogged"]) {
		echo "<script type\"Javascript\">window.location = \"index.php\";</script>";
		die();
	}
}

/**
 * Used to get the user's username
 * @return username
 */
function getUsername()
{
	session_start();
	return $_SESSION["username"];
}

/**
 * Used to get the user's email
 * @return email
 */
function getEmail()
{
	session_start();
	return $_SESSION["email"];
}

/**
 * Used to get the user's "isMojang"
 * @return isMojang
 */
function getIsMojang()
{
	session_start();
	return $_SESSION["isMojang"];
}

/**
 * Used to create an alert
 * @param $type
 * @param $message
 */
function createAlert($type, $message)
{
	echo "<div class=\"alert alert-" . $type . " alert-dismissable fade in\">";
	echo "<a type=\"button\" class=\"close\" data-animation=\"true\"data-dismiss=\"alert\" aria-hidden=\"true\">&times;</a>";
	echo $message;
	echo "</div>";
}

/**
 * Used to check if a user is admin
 * @param $mysqli_connect
 * @param $username
 * @return bool
 */
function isAdmin($mysqli_connect, $username)
{
	if (mysqli_num_rows(mysqli_query($mysqli_connect, "SELECT * FROM `members` WHERE `username` = \"$username\" AND `isAdmin` = \"true\"")) == 1)
		return true;
	else
		return false;
}

/**
 * Converts the fields from "ES_frequencies" to human readable text
 * @param $text
 * @return string
 */
function ESFrequenciesHuman($text)
{
	if ($text == "enderchest")
		return "Ender Chest";
	if ($text == "endertank")
		return "Ender Tank";
	if ($text == "white")
		return "Branco";
	if ($text == "orange")
		return "Laranja";
	if ($text == "magenta")
		return "Magenta";
	if ($text == "lightBlue")
		return "Azul Claro";
	if ($text == "yellow")
		return "Amarelo";
	if ($text == "lime")
		return "Lima";
	if ($text == "pink")
		return "Rosa";
	if ($text == "gray")
		return "Cinzento";
	if ($text == "lightGray")
		return "Cinzento Claro";
	if ($text == "cyan")
		return "Ciano";
	if ($text == "purple")
		return "Roxo";
	if ($text == "blue")
		return "Azul";
	if ($text == "brown")
		return "Castanho";
	if ($text == "green")
		return "Verde";
	if ($text == "red")
		return "Vermelho";
	if ($text == "black")
		return "Preto";
}