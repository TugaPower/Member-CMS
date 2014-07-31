<?php
	include("utils.php");

	if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> You don't have permissions to be in this page.</h3>";
		die();
	}

	/*
	 * MEMBERS
	 */
	$con = startDBConnection();
	$query = "SELECT * FROM $db_database.members ORDER BY id ASC";
	$result = mysqli_query($con, $query) or die('Error: '. $con->error);

	$memberList = array();
	while($row = mysqli_fetch_array($result)) {
		$entry = array();
		$entry["id"] = $row["id"];
		$entry["username"] = $row["username"];
		$entry["email"] = $row["email"];
		$entry["password"] = $row["password"];
		$entry["last_activity"] = $row["last_activity"];

		$memberList[] = $entry;
	}
	mysqli_free_result($result);

	echo "<h2>Membros</h2><h3>Lista de membros</h3>";
	if(sizeof($memberList) >0) {
		echo "<table class=\"table table-hover table-striped\"><thead><td>ID</td><td>Username</td><td>E-mail</td><td>Última Atividade</td><td>Opções</td></thead><tbody>";
		foreach($memberList as $current)
			echo "<tr><td>". $current["id"] ."</td><td>". $current["username"] ."</td><td><a href=\"mailto:". $current["email"] ."\">". $current["email"] ."</a></td><td>". $current["last_activity"] ."</td><td>Tornar Administrador / Remover</td></tr>";
		echo "</tbody></table>";
	} else
		echo "Não existem membros registados.";


	/*
	 * TOKENS
	 */
	$query = "SELECT * FROM $db_database.tokens ORDER BY id ASC";
	$result = mysqli_query($con, $query) or die('Error: '. $con->error);

	$tokenList = array();
	while($row = mysqli_fetch_array($result))
		$tokenList[] = $row;

	mysqli_free_result($result);
	closeDBConnection();

	echo "<h2>Tokens</h2><h3>Lista de tokens</h3>";
	if(sizeof($tokenList) >0) {
		echo "<table class=\"table table-hover table-striped\"><thead><td>ID</td><td>Token</td><td>Gerado em...</td><td>Expira em...</td><td>Opções</td></thead><tbody>";
		foreach($tokenList as $current)
			echo "<tr". ($current["used"] ? " class=\"token_used\"" : "") ."><td>". $current["id"] ."</td><td>". $current["token"] ."</td><td>". $current["generate_date"] ."</td><td>". $current["expire_date"] ."</td><td>Remover</td></tr>";
		echo "</tbody></table>";
	} else
		echo "Não existem tokens registados.";
?>
<h3>Adicionar token</h3>
<form name="registerToken" action="util/register_token.php" method="post" class="form-size" onSubmit="generateExpireDate()">
	<div class="form-group">
		<div class="input-group">
			<input name="token" type="text" class="form-control" placeholder="Token" required>
			<span class="input-group-btn"><button type="button" class="btn btn-info" onClick="generateToken()">Gerar token</button></span>
		</div>
	</div>

	<div class="form-group">
		<div class="input-group">
			<input name="expire_time" type="text" class="form-control" style="width: 50%" value="1" required>
			<select name="expire_type" class="form-control" style="width: 50%">
				<option value="h">Horas</option>
				<option value="d" selected>Dias</option>
				<option value="s">Semanas</option>
				<option value="m">Meses</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<input class="btn btn-success" type="submit" value="Adicionar">
	</div>

	<input name="expire_date" type="text" hidden>
</form>
<script type="application/javascript">
	function generateExpireDate() {
		var date = new Date();

		var time = parseInt(document.registerToken.expire_time.value);
		var type = document.registerToken.expire_type.value;
		switch(type) {
			case "h": date.setHours(date.getHours() + time); break;
			case "d": date.setDate(date.getDate() + time); break;
			case "s": date.setDate(date.getDate() + time * 7); break;
			case "m": date.setMonth(date.getMonth() + time); break;
		}

		document.registerToken.expire_date.value = date.toMysqlFormat();
	}

	function generateToken() {
		document.registerToken.token.value = randomStr(5) + "-" + randomStr(5) + "-" + randomStr(5) + "-" + randomStr(5) + "-" + randomStr(5);
	}

	function randomStr(length) {
		//var charsetWithLowercase = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		var pass = "";
		for(var i = 0, n = charset.length; i < length; ++i)
			pass += charset.charAt(Math.floor(Math.random() * n));
		return pass;
	}
</script>