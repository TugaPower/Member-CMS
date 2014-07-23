<?php
/**
 * Class used to redirect users based on their session
 */
error_reporting(0);

//Import useful files
require_once("utils/info.php");
require_once("utils/functions.php");

isLogged_members();

if (!isAdmin(connectToDatabase($db_host, $db_username, $db_password, $db_database), getUsername())) {
	echo "<script type\"Javascript\">window.location = \"index.php\";</script>";
	die();
}

//Set the page's title and set this page as active
$title = "Administra��o";
$active_admin = true;
require_once("utils/header.php");
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>Controlo do Servidor</b></h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<button type="button" class="btn btn-success" style="width: 100%" id="start"
					        onclick="return startServer();"><span>Ligar</span>
					</button>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-danger" style="width: 100%" id="stop"
					        onclick="return stopServer();"><span>Parar</span>
					</button>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-warning" style="width: 100%" id="restart"
					        onclick="return restartServer();"><span>Reiniciar</span>
					</button>
				</div>
			</div>
			<h3>Consola do servidor
				<small>Vers�o reduzida</small>
			</h3>
			<iframe src="do/creeperAPI.php?console=true" style="width: 100%;"></iframe>
		</div>
	</div>


	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>Tokens</b></h3>
		</div>
		<div class="panel-body">
			<?php
			$query = mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), "SELECT * FROM `tokens`");
			echo "<div class=\"table-responsive\">";
			echo "<table class=\"table table-hover table-responsive\">";
			echo "<thead><tr><th>#</th><th>Token</th><th>Vezes que pode ser usado</th><th>Vezes que foi usado</th><th>Data de cria��o</th><th>Data de expira��o</th></tr></thead>";
			echo "<tbody>";
			while ($row = mysqli_fetch_array($query)) {
				for ($i = 0; $i < count($row[0]); $i++) {
					if (isTokenValid(connectToDatabase($db_host, $db_username, $db_password, $db_database), $row[1]) == "O token submetido � v�lido!") {
						echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td></tr>";
					}
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			?>

			<div class="page-header" style="padding-bottom: 0px; margin-top: 0px;">
				<h4>Gerar tokens</h4>
			</div>
			<form class="form-horizontal" role="form" id="createToken" onsubmit="return createToken()">
				<div class="form-group">
					<label for="canBeUsed" class="col-sm-2 control-label">Usos m�ximos</label>

					<div class="col-sm-10">
						<input type="number" class="form-control" id="canBeUsed" min="1" max="10" value="1" required/>
					</div>
				</div>
				<div class="form-group">
					<label for="expires" class="col-sm-2 control-label">Data de expira��o</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="expires" placeholder="YYYY-MM-DD HH:MM:SS"
						       required/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" class="btn btn-success" data-loading-text="A criar token..."
						       value="Criar novo token"/>
					</div>
				</div>
			</form>
			<form class="form-horizontal" role="form" style="display: none;" id="generatedToken">
				<div class="form-group">
					<label for="canBeUsed" class="col-sm-2 control-label">Token gerado:</label>

					<div class="col-sm-10">
						<input type="text" class="form-control" id="token" value="" readonly autofocus/>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script type="application/javascript">
		function createToken() {
			var canBeUsed = document.getElementById("canBeUsed").value;
			var expires = document.getElementById("expires").value;
			console.log("A criar token...");

			$.post("do/createToken.php", {canBeUsed: canBeUsed, expires: expires})
				.done(function (data) {
					console.log("Token: " + data);

					$("#token").val(data);
					$("#createToken").hide("slow");
					$("#generatedToken").show("slow");
				});
			return false;
		}

		function startServer() {
			console.log("A ligar o servidor...");

			$("#start span").text("A ligar...");
			$("#start").addClass("disabled");
			$.post("do/creeperAPI.php", {start: true})
				.done(function (data) {
					console.log(data);
					$("#start span").text("Ligar");
					$("#start").removeClass("disabled");
				});
			return false;
		}

		function stopServer() {
			console.log("A parar o servidor...");

			$("#stop span").text("A parar...");
			$("#stop").addClass("disabled");
			$.post("do/creeperAPI.php", {stop: true})
				.done(function (data) {
					console.log(data);
					$("#stop span").text("Parar");
					$("#stop").removeClass("disabled");
				});
			return false;
		}

		function restartServer() {
			console.log("A reiniciar o servidor...");

			$("#restart span").text("A reiniciar...");
			$("#restart").addClass("disabled");
			$.post("do/creeperAPI.php", {restart: true})
				.done(function (data) {
					console.log(data);
					$("#restart span").text("Reiniciar");
					$("#restart").removeClass("disabled");
				});
			return false;
		}
	</script>
<?php require_once("utils/footer.php"); ?>