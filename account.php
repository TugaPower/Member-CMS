<?php
error_reporting(0);

//Import useful files
require_once("utils/info.php");
require_once("utils/functions.php");

isLogged_members();

//Set the page's title and set this page as active
$title = "Conta";
require_once("utils/header.php");

//GET arguments
$error = $_GET["error"];
$dontMatch = $_GET["dontMatch"];
$wrongPassword = $_GET["wrongPassword"];
$nothingChanged = $_GET["nothingChanged"];
?>
	<div class="page-header">
		<h1>Alterar informa�oes da conta</h1>
	</div>

<?php
if ($error)
	createAlert("danger", "Ocorreu um erro ao efetuar as altera��es.");
if ($dontMatch)
	createAlert("danger", "<b>Erro! </b>As passwords n�o combinam!");
if ($wrongPassword)
	createAlert("danger", "<b>Erro! </b>A password atual est� errada!");
if ($nothingChanged)
	createAlert("warning", "N�o foi efetuada qualquer altera��o � tua conta.");
?>

	<form class="form-horizontal" action="do/changeInfo.php" method="post">
		<div class="form-group">
			<label for="username" class="col-sm-2 control-label">Username</label>

			<div class="col-sm-10">
				<input type="text" class="form-control" placeholder="Username" name="username"
				       value="<?php echo getUsername() ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email</label>

			<div class="col-sm-10">
				<input type="email" class="form-control" placeholder="Email" name="email"
				       value="<?php echo getEmail() ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label for="mojang" class="col-sm-2 control-label">Conta Mojang</label>

			<div class="col-sm-10">
				<select class="form-control" name="mojang"
				        value="<?php echo(getIsMojang() == "true" ? "Sim" : "N�o") ?>" required>
					<option value="true">Sim</option>
					<option value="false" <?php if (getIsMojang() == "false") echo selected; ?>>N�o</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">Password</label>

			<div class="col-sm-10">
				<input type="password" class="form-control" placeholder="Nova password" name="password"
				       pattern=".{6,99}"/>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="password" class="form-control" placeholder="Reescreve a nova password"
				       name="passwordVerify" pattern=".{6,99}"/>
			</div>
		</div>

		<br>

		<div class="form-group">
			<label for="currentPassword" class="col-sm-2 control-label">Confirmar</label>

			<div class="col-sm-10">
				<div class="input-group">
					<input type="password" class="form-control" placeholder="Password atual" name="currentPassword"
					       pattern=".{6,99}" required>
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit">Alterar informa��es</button>
                    </span>
				</div>
			</div>
		</div>
	</form>

<?php require_once("utils/footer.php"); ?>