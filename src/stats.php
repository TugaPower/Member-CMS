<?php
	include("utils.php");

	$con = startDBConnection();

	$query = "SELECT username FROM $db_database.members ORDER BY id ASC";
	$result = mysqli_query($con, $query) or die('Error: '. $con->error);

	$members = array();
	while($row = mysqli_fetch_array($result))
		$members[] = $row["username"];

	mysqli_free_result($result);
	closeDBConnection();

	echo "<div class=\"selector\">";
	foreach($members as $current)
		echo "<div class=\"avatar\" onClick=\"loadPlayer('$current')\"><img src=\"https://minotar.net/helm/$current/96.png\"><span>$current</span></div>";
	echo "</div>";
?>
<div class="stats" onLoad="loadStatElements(); load('<?php echo $members[0] ?>') /* Loads the first player on the array list */">
	<div class="player"><img id="player-skin"><span id="player-name"></span></div>
	<div class="info">
		<div class="time-played">Tempo Jogado: <span id="time-played-info"></span></div>
		<div class="distance-traveled">Distância Viajada: <span id="distance-traveled-info"></span></div>
		<div class="damage-dealt">Dano Realizado: <span id="damage-dealt-info"></span></div>
		<div class="damage-taken">Dano Sofrido: <span id="damage-taken-info"></span></div>
		<div class="deaths">Mortes: <span id="deaths-info"></span> (morreu pela última vez em <span id="last-death-info"></span>)</div>
		<div class="kills">Abates: <span id="kills-info"></span> (<span id="kills-mobs-info"></span> mobs e <span id="kills-players-info"></span> jogadores)</div>
	</div>
</div>
<script type="application/javascript">
	function loadPlayer(nickname) {
		console.log("Loading " + nickname + " stats");
		skin.src = "https://minotar.net/helm/" + nickname + "/96.png";
		name.innerHTML = nickname;
		timePlayed.innerHTML = "0";
		distanceTraveled.innerHTML = "0";
		damageDealt.innerHTML = "0";
		damageTaken.innerHTML = "0";
		deaths.innerHTML = "0";
		lastDeath.innerHTML = "0";
		kills.innerHTML = "0";
		killsMobs.innerHTML = "0";
		killsPlayers.innerHTML = "0";
	}

	// Store every element of the stats page for later use
	skin = document.getElementById("player-skin");
	name = document.getElementById("player-name");
	timePlayed = document.getElementById("time-played-info");
	distanceTraveled = document.getElementById("distance-traveled-info");
	damageDealt = document.getElementById("damage-dealt-info");
	damageTaken = document.getElementById("damage-taken-info");
	deaths = document.getElementById("deaths-info");
	lastDeath = document.getElementById("last-death-info");
	kills = document.getElementById("kills-info");
	killsMobs = document.getElementById("kills-mobs-info");
	killsPlayers = document.getElementById("kills-players-info");

	loadPlayer("<?php echo $members ?>"); // Load the first player on the array
</script>