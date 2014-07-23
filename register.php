<?php
/**
 * Class used to register an user on the website
 */
error_reporting(0);

//Import useful files
require_once("utils/functions.php");

//Check if the user is logged
isLogged_login();

//GET arguments
$token = $_GET["token"];
$usernameExists = $_GET["usernameExists"];
$emailExists = $_GET["emailExists"];
$success = $_GET["success"];
$error = $_GET["error"];
$empty = $_GET["empty"];
?>
<html>
<head>
	<title>Registar &raquo; TugaPower - �rea Restrita</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css/custom.css"/>
</head>
<body>
<div class="container" id="content">
	<div class="panel panel-default" id="register">
		<div class="panel-body">
			<h1 style="margin-top: 0px; text-align: center; font-weight: bold; margin-bottom: 15px;">TugaPower</h1>
			<?php
			if ($usernameExists)
				createAlert("danger", "<b>Erro! </b>O username j� existe!");
			if ($emailExists)
				createAlert("danger", "<b>Erro! </b>O email j� existe!");
			if ($empty)
				createAlert("danger", "<b>Erro! </b>Por favor preenche todos os campos.");
			if ($error) {
				if ($error == "true") {
					createAlert("danger", "<b>Erro! </b>Tens de iniciar sess�o!");
				} else {
					createAlert("danger", "<b>Erro! </b> " . $error);
				}
			}

			?>
			<div class="input-group">
				<form action="do/register.php" method="post">
					<div class="input-group input-group">
						<input type="text" class="form-control" placeholder="Username do Minecraft" name="username"
						       required autofocus autocomplete/>
						<input type="password" class="form-control" placeholder="Password" name="password"
						       pattern=".{6,99}" required autocomplete/>
						<input type="email" class="form-control" placeholder="Email" name="email" required
						       autocomplete/>
						<input type="text" class="form-control" placeholder="Token" name="token"
						       value="<?php echo $token ?>" required autocomplete/>
						<input type="button" class="btn btn-danger" id="smallButton" name="mojangButton"
						       value="Conta Mojang? N�o!" onclick="changeMojangAccount();" data-toggle="button"/>
						<button type="button" class="btn btn-info" id="info" onclick="mojangHelp();"><span
								class="glyphicon glyphicon-info-sign"></span></button>
						<input type="text" style="display: none;" id="mojangSelector" name="isMojangAccount"
						       value="false"/>
						<input type="submit" class="btn btn-primary" id="button" value="Registar"
						       data-loading-text="A registar..."/>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="application/javascript">
		var state = false;

		function changeMojangAccount() {
			if (state != true) {
				document.getElementById("mojangSelector").value = "true";
				document.getElementById("smallButton").value = "Conta Mojang? Sim!";
				document.getElementById("smallButton").setAttribute("class", "btn btn-success");
				state = true;
			} else {
				document.getElementById("mojangSelector").value = "false";
				document.getElementById("smallButton").value = "Conta Mojang? N�o!";
				document.getElementById("smallButton").setAttribute("class", "btn btn-danger");
				state = false;
			}
		}

		function mojangHelp() {
			alert("Se usas uma conta Mojang (inicias sess�o no Minecraft com o teu email), dever�s selecionar esta op��o e o email submetido dever� ser igual ao email da tua conta Mojang.");
		}
	</script>
	<?php require_once("utils/footer.php"); ?>
