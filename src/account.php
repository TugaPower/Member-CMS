<?php include_once("utils.php") ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-user"></i> Perfil</h3>
	</div>
	<div class="panel-body">
		<div class="player-info">
			<img src="https://minotar.net/helm/<?php echo $_SESSION["username"]; ?>/120.png">
			<h2><?php echo $_SESSION["username"]; ?></h2>
		</div>
	</div>
</div>
<form name="profile" class="form-horizontal" action="util/update_profile.php" method="post"
      onSubmit="return checkForm()">
	<input type="hidden" name="username_old" value="<?php echo $_SESSION["username"] ?>"/>

	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Username</label>

		<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Username" name="username"
			       value="<?php echo $_SESSION["username"] ?>" required>
		</div>
	</div>

	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>

		<div class="col-sm-10">
			<input name="email" type="email" class="form-control" placeholder="Email"
			       value="<?php echo $_SESSION["email"] ?>"/>
		</div>
	</div>

	<div class="form-group">
		<label for="mojang" class="col-sm-2 control-label">Conta Mojang</label>

		<div class="col-sm-10">
			<select name="mojang" class="form-control">
				<option value="true">Sim</option>
				<option value="false" <?php if (!$_SESSION["isMojang"]) echo "selected" ?>>Não</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password</label>

		<div class="col-sm-10">
			<input name="password" type="password" class="form-control" placeholder="Nova password" pattern=".{5,99}"/>
		</div>

		<div class="col-sm-offset-2 col-sm-10" style="margin-top: 5px">
			<input id="password-verify" type="password" class="form-control" placeholder="Re-escreve a nova password"
			       pattern=".{5,99}"/>
		</div>
	</div>

	<br>

	<div class="form-group">
		<label for="current_password" class="col-sm-2 control-label">Confirmar</label>

		<div class="col-sm-10">
			<div class="input-group">
				<input name="current_password" type="password" class="form-control" placeholder="Password atual"
				       pattern=".{5,99}" required>
				<span class="input-group-btn"><button class="btn btn-success" type="submit">Alterar informações</button></span>
			</div>
		</div>
	</div>
</form>
<script>
	function checkForm() {
		if (document.profile.password.value !== "" && document.profile.password.value !== document.getElementById("password-verify").value) {
			return false;
		}

		return true;
	}
</script>