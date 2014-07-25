<?php
	include("utils.php");

	$con = startDBConnection();

	if(isset($_GET["id"])) {
		$query = "SELECT username,youtube_account,email,status,text FROM $db_database.applications WHERE id='" . $_GET["id"] . "' AND ip_address='". $_SERVER["REMOTE_ADDR"] ."' LIMIT 1";
		$result = mysqli_query($con, $query) or die('Error: ' . $con->error);
		if (mysqli_num_rows($result) >= 1) { // Check if got any result
			$data = mysqli_fetch_array($result);
			mysqli_free_result($result);

			echo "Mostrando informação do ID ". $_GET["id"];
			echo "<br>Username: ". $data["username"];
			echo "<br>Conta do YouTube: ". $data["youtube_account"];
			echo "<br>E-mail: ". $data["email"];
			echo "<br>Text: ". $data["text"];
			echo "<br>Status: ". $data["status"];

			closeDBConnection();
			die();
		} else {
			closeDBConnection();
			showPopup("error", "ID inválido <strong>ou</strong> este pedido não te pertence!<br>");
		}
	}

	// Check if there is already a application for this IP
	$query = "SELECT id FROM $db_database.applications WHERE ip_address='" . $_SERVER["REMOTE_ADDR"] . "' LIMIT 1";
	$result = mysqli_query($con, $query) or die('Error: ' . $con->error);

	if (mysqli_num_rows($result) >= 1) { // Check if got any result
		$data = mysqli_fetch_array($result);
		mysqli_free_result($result);

		echo "Já enviaste uma aplicação!<br><a href=\"register.php?id=". $data["id"] ."\" target=\"_self\">Aqui</a> podes ver o estado da tua apliação.";
	} else {
		// ip_address, username, youtube_account, email, text
		?>
		<form action="util/register_application.php" method="post">
			<input name="ip_address" type="text" hidden value="<?php echo $_SERVER["REMOTE_ADDR"] ?>">
			<input name="username" type="text" placeholder="Username">
			<br>
			<input name="youtube_account" type="text" placeholder="Conta do YouTube">
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