<?php
error_reporting(0);

//Import useful files
require_once("utils/info.php");
require_once("utils/functions.php");

isLogged_members();

//URL arguments
$empty = $_GET["empty"];
$exists = $_GET["exists"];
$error = $_GET["error"];
$success = $_GET["success"];

//Set the page's title and set this page as active
$title = "Frequ�ncias";
$active_freqs = true;
require_once("utils/header.php");
?>
	<div class="page-header">
		<h1 id="enderstorage">Ender Storage
			<small>Ender Chests e Ender Tanks</small>
		</h1>
	</div>
	<p>De modo a mantermos as frequ�ncias organizadas, dever�s registar todas as frequ�ncias que usas no servidor.
		Lembra-te que dever�s identificar as tuas frequ�ncias sempre iguais (por exemplo, o <b>Bl0ckMaster</b> usa o
		azul-azul).</p>
	<p>Caso estejas a usar frequ�ncias privadas (cadeado do Ender Chest de diamante), n�o � necess�rio registares essas
		frequ�ncias.</p>
	<div class="page-header" style="padding-bottom: 0px; margin-top: 20px;">
		<h4>Registar Frequ�ncia</h4>
	</div>
<?php
if ($empty)
	createAlert("danger", "<b>Erro! </b> Por favor preenche todos os campos.");
if ($exists)
	createAlert("danger", "<b>Erro! </b> A frequ�ncia j� existe!");
if ($error)
	createAlert("danger", "Ocorreu um erro ao registar a frequ�ncia.");
if ($success)
	createAlert("success", "<b>Sucesso!</b> A frequ�ncia foi registada com sucesso!");
?>
	<form class="form-horizontal" action="do/registerFreq.php" method="post">
		<div class="form-group">
			<label for="description" class="col-sm-1 control-label">Descri��o</label>

			<div class="col-sm-11">
				<input type="text" class="form-control" name="description" placeholder="Para que usas a frequ�ncia"
				       required/>
			</div>
		</div>
		<div class="form-group">
			<label for="type" class="col-sm-1 control-label">Tipo</label>

			<div class="col-sm-11">
				<select class="form-control" name="type" required>
					<option value="enderchest">Ender Chest</option>
					<option value="endertank">Ender Tank</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="colors" class="col-sm-1 control-label">Cores</label>

			<div class="form-inline" id="colors">
				<div class="col-sm-2">
					<select class="form-control" name="color1" required>
						<option value="white">Branco</option>
						<option value="orange">Laranja</option>
						<option value="magenta">Magenta</option>
						<option value="lightBlue">Azul Claro</option>
						<option value="yellow">Amarelo</option>
						<option value="lime">Lima</option>
						<option value="pink">Rosa</option>
						<option value="gray">Cinzento</option>
						<option value="lightGray">Cinzento Claro</option>
						<option value="cyan">Ciano</option>
						<option value="purple">Roxo</option>
						<option value="blue">Azul</option>
						<option value="brown">Castanho</option>
						<option value="green">Verde</option>
						<option value="red">Vermelho</option>
						<option value="black">Preto</option>
					</select>
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="color2" required>
						<option value="white">Branco</option>
						<option value="orange">Laranja</option>
						<option value="magenta">Magenta</option>
						<option value="lightBlue">Azul Claro</option>
						<option value="yellow">Amarelo</option>
						<option value="lime">Lima</option>
						<option value="pink">Rosa</option>
						<option value="gray">Cinzento</option>
						<option value="lightGray">Cinzento Claro</option>
						<option value="cyan">Ciano</option>
						<option value="purple">Roxo</option>
						<option value="blue">Azul</option>
						<option value="brown">Castanho</option>
						<option value="green">Verde</option>
						<option value="red">Vermelho</option>
						<option value="black">Preto</option>
					</select>
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="color3" required>
						<option value="white">Branco</option>
						<option value="orange">Laranja</option>
						<option value="magenta">Magenta</option>
						<option value="lightBlue">Azul Claro</option>
						<option value="yellow">Amarelo</option>
						<option value="lime">Lima</option>
						<option value="pink">Rosa</option>
						<option value="gray">Cinzento</option>
						<option value="lightGray">Cinzento Claro</option>
						<option value="cyan">Ciano</option>
						<option value="purple">Roxo</option>
						<option value="blue">Azul</option>
						<option value="brown">Castanho</option>
						<option value="green">Verde</option>
						<option value="red">Vermelho</option>
						<option value="black">Preto</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-11">
				<input type="submit" class="btn btn-success" value="Registar frequ�ncia">
			</div>
		</div>
	</form>
	<div class="page-header" style="padding-bottom: 0px; margin-bottom: 5px;">
		<h4>Frequ�ncias Registadas</h4>
	</div>
<?php
$query = mysqli_query(connectToDatabase($db_host, $db_username, $db_password, $db_database), "SELECT * FROM `ES_frequencies`");
echo "<div class=\"table-responsive\">";
echo "<table class=\"table table-hover table-responsive\">";
echo "<thead><tr><th>Tipo</th><th>Dono</th><th>Frequ�ncia</th><th>Descri��o</th></tr></thead>";
echo "<tbody>";
while ($row = mysqli_fetch_array($query)) {
	for ($i = 0; $i < count($row[0]); $i++) {
		echo "<tr>";
		echo "<td>" . ESFrequenciesHuman($row[1]) . "</td>";
		echo "<td>" . $row[6] . "</td>";
		echo "<td>" . ESFrequenciesHuman($row[2]) . " / " . ESFrequenciesHuman($row[3]) . " / " . ESFrequenciesHuman($row[4]) . "</td>";
		echo "<td>" . $row[5] . "</td>";
		echo "</tr>";
	}
}
echo "</tbody>";
echo "</table>";
echo "</div>";

require_once("utils/footer.php"); ?>