<?php
	/*
	 * Utility functions
	 */
	function redirect($url) {
		if(headers_sent())
			echo "<script type=\"application/javascript\">window.location = ". $url ."</script>";
		else
			header("Location: ". $url);
	}

	function showPopup($type, $description) {
		switch($type) {
			case "success":	echo "<div class=\"popup bg-success\" onClick=\"closePopups()\"><i class=\"fa fa-check\"></i> $description<i></i></div>"; break;
			case "info":	echo "<div class=\"popup bg-info\" onClick=\"closePopups()\"><i class=\"fa fa-info\"></i> $description</div>"; break;
			case "warning":	echo "<div class=\"popup bg-warning\" onClick=\"closePopups()\"><i class=\"fa fa-exclamation-triangle\"></i> $description</div>"; break;
			case "error":	echo "<div class=\"popup bg-danger\" onClick=\"closePopups()\"><i class=\"fa fa-frown-o\"></i> $description</div>"; break;
		}
	}

	/*
	 * Authentication checks
	 */
	session_start();
	if(!isset($_SESSION["isAdmin"])) $_SESSION["isAdmin"] = false;
	if(!isset($_SESSION["isAuthenticated"])) $_SESSION["isAuthenticated"] = false;
	if(!$_SESSION["isAuthenticated"] && (!(basename($_SERVER['PHP_SELF']) == "login.php") && !(basename($_SERVER['PHP_SELF']) == "register.php") && !(basename($_SERVER['PHP_SELF']) == "register_user.php"))) { // If the user is not authenticated and we're not in the login our register pages, redirect the user to the login page
		redirect('login.php');
		die();
	}

	if(isset($_GET["popup"])) showPopup($_GET["popup"], $_GET["popup_desc"]);

	/*
	 * Constants
	 */
	define("WEBSITE_TITLE", "TugaPower");
	define("WEBSITE_VERSION", "0.1");

	/*
	 * Database information and utility functions.
	 */
	$db_host = "localhost";
	$db_username = "tugapower";
	$db_password = "biscoitos123";
	$db_database = "tugapower";

	/**
	 * Starts a new connection with the database server.
	 * If there is already an open connection, return it instead.
	 *
	 * @return mysqli   The database connection
	 */
	function startConnection() {
		global $db_host, $db_username, $db_password, $db_database;
		$db_con = mysqli_connect($db_host, $db_username, $db_password, $db_database);
		if(mysqli_connect_errno())
			die("Ocorreu um erro ao conectar à base de dados (". mysqli_connect_errno(). " - ". mysqli_connect_error() .")");

		mysqli_query($db_con, "SET NAMES 'utf8'");
		return $db_con;
	}

	function usernameExists($username) {
		global $db_database;
		$query = "SELECT id FROM $db_database.members WHERE username='". $username ."'";
		return mysqli_num_rows(mysqli_query(startConnection(), $query)) > 0;
	}