<?php
	include("includes/header.php");
	date_default_timezone_set("UTC"); // The database stores its timestamps in UTC

	if(!isset($_GET["token"])) { // Mostra o pedido para inserir um token
		?>
		<form name="token" class="form-horizontal form-size" action="register.php" method="get">
			<div class="form-group">
				<label for="token" class="col-sm-2 control-label">Token</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Token" name="token" required>
				</div>
			</div>

			<div class="form-group">
				<span class="input-group-btn"><button class="btn btn-success" type="submit">Continuar</button></span>
			</div>
		</form>
		<?php
		die();
	}

	$con = startConnection();

	// Check if the token is valid
	$query = "SELECT expire_date FROM $db_database.tokens WHERE token='" . $_GET["token"] . "' AND used=0 LIMIT 1";
	$result = mysqli_query($con, $query) or die('Error: ' . $con->error);

	if(mysqli_num_rows($result) >= 1) { // The specified token exists and is unsed!
		$data = mysqli_fetch_array($result);
		mysqli_free_result($result);

		if($data["expire_date"] < date("Y-m-d H:i:s", time())) {
			redirect("login.php?popup=error&popup_desc=O token <b>". $_GET["token"] ."</b> expirou.");
			die();
		}

		?>
		<form name="register" class="form-horizontal form-size" action="util/register_user.php" method="post" onSubmit="return checkForm()">
			<input type="text" name="token" value="<?php echo $_GET["token"] ?>" hidden>

			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">Username</label>

				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Username" name="username" required>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>

				<div class="col-sm-10">
					<input name="email" type="email" class="form-control" placeholder="Email">
				</div>
			</div>

			<div class="form-group">
				<label for="mojang" class="col-sm-2 control-label">Conta Mojang</label>

				<div class="col-sm-10">
					<select name="mojang" class="form-control">
						<option value="true">Sim</option>
						<option value="false">Não</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Password</label>

				<div class="col-sm-10">
					<input name="password" type="password" class="form-control" placeholder="Password" pattern=".{5,99}"/>
				</div>

				<div class="col-sm-10" style="margin-left: 150px; margin-top: 5px">
					<input id="password-verify" type="password" class="form-control" placeholder="Re-escreve a password" pattern=".{5,99}"/>
				</div>
			</div>

			<br>

			<div class="form-group">
				<span class="input-group-btn"><button class="btn btn-success" type="submit">Registar</button></span>
			</div>
		</form>
		<?php
	} else {
		// Token inválido
		redirect("login.php?popup=error&popup_desc=O token <b>". $_GET["token"] ."</b> é inválido ou já foi usado.");
		die();
	}
?>
<script>
	function checkForm() {
		if (document.profile.password.value !== "" && document.profile.password.value !== document.getElementById("password-verify").value) {
			$(document).append("<div class=\"popup bg-warning\" onClick=\"closePopups()\"><i class=\"fa fa-exclamation-triangle\"></i> As senhas não coincídem!</div>");
			return false;
		}

		return true;
	}
</script>
<?php include("includes/footer.php");