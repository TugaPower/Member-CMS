<ul id="sidebar" class="nav nav-stacked">
	<?php
	$elements = array();
	$elements[] = array("name" => "Home", "url" => "home.php");
	$elements[] = array("name" => "Perfil", "url" => "account.php");
	$elements[] = array("name" => "Estatísticas", "url" => "stats.php");

	if ($_SESSION["isAdmin"])
		$elements[] = array("name" => "Administração", "url" => "admin.php");

	foreach ($elements as $current)
		echo "<li " . ($_COOKIE["current_page"] === $current["name"] ? " class=\"active\"" : "") . "><a onClick=\"changePage('" . $current["name"] . "','" . $current["url"] . "')\">" . $current["name"] . "</a></li>";
	?>

	<div class="player-head">
		<?php
			if(isset($_SESSION["email"]) && !empty(isset($_SESSION["email"])))
				echo "<img src=\"https://www.gravatar.com/avatar/". md5(strToLower(trim($_SESSION["email"]))) ."?size=120?d=". urlEncode("https://minotar.net/helm/". $_SESSION["username"] ."/120.png") ."\" class=\"img-circle\">";
			else
				echo "<img src=\"https://minotar.net/helm/". $_SESSION["username"] ."/120.png\" class=\"img-circle\">";
		?>
		<p>Bem-vindo, <span class="bold"><?php echo $_SESSION["username"] ?></span></p>
	</div>
</ul>
<div id="version"></div>
<div id="info">
	<a href="https://www.youtube.com/user/ZonaPMS" target="new"><i class="fa fa-youtube"></i></a>
	<a href="https://www.facebook.com/ZonaPMS" target="new"><i class="fa fa-facebook"></i></a>
	<a href="https://twitter.com/ZonaPMS" target="new"><i class="fa fa-twitter"></i></a>
	<a href="https://tugapower.slack.com/" target="new"><i class="fa fa-slack"></i></a>
	<a href="https://github.com/TugaPower" target="new"><i class="fa fa-github"></i></a>
	<br>
	<strong>Versão <?php echo WEBSITE_VERSION ?></strong>
</div>