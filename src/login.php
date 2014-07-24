<?php
include("includes/header.php");

// If already logged in, redirect to the main page
if (isset($_SESSION["isAuthenticated"]) && $_SESSION["isAuthenticated"]) {
	redirect("index.php");
	die();
}

// If received a POST, check login!
if (isset($_POST["username"]) && isset($_POST["password"])) {
	$encryptedPassword = md5(sha1(md5($_POST["password"])) . $_POST["password"]);

	$con = startDBConnection();
	$query = "SELECT is_admin,is_mojang_account,email FROM $db_database.members WHERE username='" . $_POST["username"] . "' AND password='$encryptedPassword' LIMIT 1";
	$result = mysqli_query($con, $query) or die('Error: ' . $con->error);

	if (mysqli_num_rows($result) >= 1) { // Check if got any result
		$data = mysqli_fetch_array($result);
		mysqli_free_result($result);
		closeDBConnection();

		$_SESSION["username"] = $_POST["username"];
		$_SESSION["isAuthenticated"] = true;
		$_SESSION["isAdmin"] = $data["is_admin"];
		$_SESSION["isMojang"] = $data["is_mojang_account"];
		$_SESSION["email"] = $data["email"];

		redirect("index.php");
		die();
	} else {
		showPopup("error", "Username e/ou senha incorretos!<br>");
	}
}

if (isset($_GET["exited"])) showPopup("success", "Foste deslogado com sucesso!");
?>
	<div class="login">
		<div class="panel panel-default">
			<div class="panel-body">
				<h1><i id="avatar" class="fa fa-power-off"></i> <?php echo WEBSITE_TITLE ?></h1>

				<form name="login" action="login.php" method="post" class="form-inline">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-user"></i></div>
							<input name="username" class="form-control" type="text" placeholder="Username">
						</div>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock"></i></div>
							<input name="password" class="form-control" type="password" placeholder="Password">
						</div>
					</div>
					<span class="center-block text-center">
						<button type="submit" class="btn btn-success btn-lg">Iniciar Sessão</button>
						<a href="register.php" target="_self" class="btn btn-info" role="button">Registar</a>
					</span>
				</form>
			</div>
		</div>
	</div>
	<script type="application/javascript">
		function closePopups() {
			$('.popup').each(function (index, element) {
				$(element).css("display", "none");
			});
		}
	</script>
<?php include("includes/footer.php"); ?>