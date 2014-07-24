<?php
	include_once("utils.php");

	if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
		echo "<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> You don't have permissions to be in this page.</h3>";
		die();
	}

	$con = startDBConnection();

	$query = "SELECT * FROM $db_database.members ORDER BY id ASC";
	$result = mysqli_query($con, $query) or die('Error: '. $con->error);

	$members = array();
	while($row = mysqli_fetch_array($result)) {
		$entry = array();
		$entry["id"] = $row["id"];
		$entry["username"] = $row["username"];
		$entry["password"] = $row["password"];
		$entry["last_activity"] = $row["last_activity"];

		$members[] = $entry;
	}
	mysqli_free_result($result);
	closeDBConnection();

	echo "<h2>Membros</h2><h3>Lista de membros</h3>";
	echo "<table class=\"table table-hover table-striped\"><thead><td>ID</td><td>Username</td><td>Última Atividade</td></thead><tbody>";
	foreach($members as $current)
		echo "<tr><td>". $current["id"] ."</td><td>". $current["username"] ."</td><td>". $current["last_activity"] ."</td></tr>";
	echo "</tbody></table>";

	if(sizeof($members) < 1) echo "There are no members in the database.";
?>
<h3>Adicionar membro</h3>
<form name="register" action="util/register.php" method="post">
	<div class="form-group">
		<input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo $_SESSION["username"] ?>" required>
	</div>

	<div class="form-group">
		<div class="input-group">
			<input name="password" type="text" class="form-control" placeholder="Senha" pattern=".{5,99}" required>
			<span class="input-group-btn"><button type="button" class="btn btn-info" onClick="generatePassword()">Gerar senha</button></span>
		</div>
	</div>

	<div class="form-group">
		<input class="btn btn-success center-block" type="submit" value="Adicionar">
	</div>
</form>
<script type="application/javascript">
	function generatePassword() {
		var length = 10;
		var charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		var pass = "";
		for(var i = 0, n = charset.length; i < length; ++i)
			pass += charset.charAt(Math.floor(Math.random() * n));
		document.register.password.value = pass;
	}
</script>