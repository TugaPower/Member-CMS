<?php
	include("utils.php");

	$con = startDBConnection();

	// Check if there is already a application for this IP
	$query = "SELECT id FROM $db_database.members WHERE ip_address='" . $_SERVER["REMOTE_ADDR"] . "' LIMIT 1";
	$result = mysqli_query($con, $query) or die('Error: ' . $con->error);

	if (mysqli_num_rows($result) >= 1) { // Check if got any result
		$data = mysqli_fetch_array($result);
		mysqli_free_result($result);

		echo "Já enviaste uma aplicação!<br><a href=\"register.php?id=". $data["id"] ."\" target=\"_self\">Aqui</a> podes ver o estado da tua apliação.";
	} else {
		// ip_address, username, youtube_account, email, text
		?>
		<form action="util/register_user.php" method="post">
			<input name="username" type="text" placeholder="Username">
			<br>
			<input name="email" type="text" placeholder="E-mail">
			<br>
			<textarea name="text" rows="3"></textarea>
			<br>
			<button type="submit">Enviar</button>
		</form>
<?php
	}
	closeDBConnection();