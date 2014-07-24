<?php
//Set the page's title and set this page as active
$title = "Iniciar Sessão";
$requireAuth = false;
$showNavbar = false;
include("includes/header.php");

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
	<div class="panel panel-default" id="login">
		<div class="panel-body">
			<h1 style="margin-top: 0px; text-align: center; font-weight: bold; margin-bottom: 15px;">TugaPower</h1>
			<?php
			if ($unknownUsername)
				createAlert("danger", "<b>Erro! </b>O username não existe!");
			if ($dontMatch)
				createAlert("danger", "<b>Erro! </b>O username e a password não combinam!");
			if ($empty)
				createAlert("danger", "<b>Erro! </b>Por favor preenche todos os campos.");
			if ($needLogin)
				createAlert("danger", "<b>Erro! </b>Tens de iniciar sessão!");
			if ($register)
				createAlert("success", "<b>Sucesso! </b>Foste corretamente registado. Deverás agora iniciar sessão.");
			if ($uponChanges)
				createAlert("success", "<b>Sucesso! </b>As informações da tua conta foram alteradas! Deverás agora iniciar sessão.");
			?>
			<div class="input-group">
				<form action="do/login.php" method="post">
					<div class="input-group input-group">
						<input type="text" class="form-control" placeholder="Username" name="username" required
						       autofocus autocomplete/>
						<input type="password" class="form-control" placeholder="Password" name="password"
						       pattern=".{6,99}" required autocomplete/>
						<input type="submit" class="btn btn-primary" id="button" value="Iniciar Sessão"
						       data-loading-text="A iniciar sessão..."/>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php include("includes/footer.php"); ?>