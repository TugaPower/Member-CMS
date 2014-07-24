<?php
	include_once("utils.php");

	// If already logged in, redirect to the main page
	if(isset($_SESSION["isAuthenticated"]) && $_SESSION["isAuthenticated"]) {
		header("Location: index.php");
		die();
	}

	// If received a POST, check login!
	if(isset($_POST["username"]) && isset($_POST["password"])) {
		$encryptedPassword = md5(sha1(md5($_POST["password"])) . $_POST["password"]);

		$con = startDBConnection();
		$query = "SELECT is_admin,is_mojang_account,email FROM $db_database.members WHERE username='". $_POST["username"] ."' AND password='$encryptedPassword' LIMIT 1";
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

			redirect("index.php");
			die();
		} else {
			showPopup("error", "Username e/ou senha incorretos!<br>");
		}
	}

	if(isset($_GET["exited"])) showPopup("success", "Foste deslogado com sucesso!");;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Language" content="pt">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo WEBSITE_TITLE ?></title>
	<link href="favicon.ico" rel="shortcut icon">

	<!-- Main CSS file -->
	<link href="css/style.css" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body style="background: url('img/bg.png') repeat; display: table;">
<div class="login">
	<form name="login" action="login.php" method="post" class="form-inline">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-user"></i></div>
				<input name="username" class="form-control" type="text" placeholder="Username">
			</div>
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-lock"></i></div>
				<input name="password" class="form-control" type="password" placeholder="Senha">
			</div>
		</div>
		<button type="submit" class="btn btn-default center-block">Login</button>
	</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="application/javascript">
	function closePopups() {
		$('.popup').each(function(index, element) {
			$(element).css("display", "none");
		});
	}
</script>
</body>
</html>