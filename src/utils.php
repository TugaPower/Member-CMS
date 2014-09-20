<?php
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); // Debug report
	error_reporting(0); // Disable report in production code

	/*
	 * Constants
	 */
	define("WEBSITE_TITLE", "TugaPower");
	define("WEBSITE_VERSION", "1.0");

	define("DB_HOST", "localhost");
	define("DB_USERNAME", "tugapower");
	define("DB_PASSWORD", "biscoitos123");
	define("DB_NAME", "tugapower");

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

	/**
	 * Starts a new connection with the database server.
	 * If there is already an open connection, return it instead.
	 *
	 * @return mysqli   The database connection
	 */
	function startConnection() {
		if(!($db_con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME)))
			die("Erro ". mysqli_connect_errno(). ": ". mysqli_connect_error());

		mysqli_query($db_con, "SET NAMES 'utf8'");
		return $db_con;
	}

	function usernameExists($username) {
		$query = "SELECT id FROM ". DB_NAME .".members WHERE username='". $username ."'";
		return mysqli_num_rows(mysqli_query(startConnection(), $query)) > 0;
	}