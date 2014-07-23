<?php
/**
 * Class user to authenticate users so they can access the member area
 */
error_reporting(0);

//Import useful files
require_once("utils/functions.php");

//Check if the user is logged
isLogged_login();

//GET arguments
$unknownUsername = $_GET["unknownUsername"];
$dontMatch = $_GET["dontMatch"];
$empty = $_GET["empty"];
$needLogin = $_GET["needLogin"];
$success = $_GET["success"];
$register = $_GET["register"];
$uponChanges = $_GET["uponChanges"];
?>
<html>
	<head>
		<title>Login &raquo; TugaPower - �rea Restrita</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="css/custom.css"/>
	</head>
<body>
<div class="container" id="content">
	<div class="panel panel-default" id="login">
		<div class="panel-body">
			<h1 style="margin-top: 0px; text-align: center; font-weight: bold; margin-bottom: 15px;">TugaPower</h1>
			<?php
			if ($unknownUsername)
				createAlert("danger", "<b>Erro! </b>O username n�o existe!");
			if ($dontMatch)
				createAlert("danger", "<b>Erro! </b>O username e a password n�o combinam!");
			if ($empty)
				createAlert("danger", "<b>Erro! </b>Por favor preenche todos os campos.");
			if ($needLogin)
				createAlert("danger", "<b>Erro! </b>Tens de iniciar sess�o!");
			if ($register)
				createAlert("success", "<b>Sucesso! </b>Foste corretamente registado. Dever�s agora iniciar sess�o.");
			if ($uponChanges)
				createAlert("success", "<b>Sucesso! </b>As informa��es da tua conta foram alteradas! Dever�s agora iniciar sess�o.");
			?>
			<div class="input-group">
				<form action="do/login.php" method="post">
					<div class="input-group input-group">
						<input type="text" class="form-control" placeholder="Username" name="username" required
						       autofocus autocomplete/>
						<input type="password" class="form-control" placeholder="Password" name="password"
						       pattern=".{6,99}" required autocomplete/>
						<input type="submit" class="btn btn-primary" id="button" value="Iniciar Sess�o"
						       data-loading-text="A iniciar sess�o..."/>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php require_once("utils/footer.php"); ?>