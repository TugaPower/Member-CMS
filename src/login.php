<?php
	include_once("utils.php");

	// If already logged in, redirect to the main page
	if(isset($_SESSION["isAuthenticated"]) && $_SESSION["isAuthenticated"]) {
		header("Location: index.php");
		die();
	}

	// If received a POST, check login!
	if(isset($_POST["username"]) && isset($_POST["password"])) {
		$con = startDBConnection();
		$query = "SELECT is_admin,is_mojang_account,email FROM $db_database.members WHERE username='". $_POST["username"] ."' AND password='". $_POST["password"] ."' LIMIT 1";
		$result = mysqli_query($con, $query) or die('Error: '. $con->error);

		if(mysqli_num_rows($result) >= 1) { // Check if got any result
			$data = mysqli_fetch_array($result);
			mysqli_free_result($result);
			closeDBConnection();

			$_SESSION["username"] = $_POST["username"];
			$_SESSION["isAuthenticated"] = true;
			$_SESSION["isAdmin"] = $data["is_admin"];
			$_SESSION["isMojang"] = $data["is_mojang_account"];
			$_SESSION["email"] = $data["email"];

			header("Location: index.php");
			die();
		} else {
			echo "Wrong username and/or password!<br>";
		}
	}

	if(isset($_GET["exited"]))
		echo "Congratulations! You logged yourself out!";
	else
		echo "Here you go! Now log yourself in!";
?>
<form name="login" action="login.php" method="post" onSubmit="document.login.password.value = $.md5(document.login.password.value)">
	<input name="username" type="text" placeholder="Username">
	<input name="password" type="password" placeholder="Password" pattern=".{5,99}">
	<input type="submit" value="Login">
</form>
<script async src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script async src="js/jquery.md5.js"></script>