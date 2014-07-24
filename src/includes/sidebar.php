<ul id="sidebar" class="nav nav-stacked">
	<?php
		$elements = array();
		$elements[] = array("name" => "Home", "url" => "home.php");
		$elements[] = array("name" => "Perfil", "url" => "account.php");
		$elements[] = array("name" => "Estatísticas", "url" => "stats.php");

		if($_SESSION["isAdmin"])
			$elements[] = array("name" => "Administração", "url" => "admin.php");

		foreach($elements as $current)
			echo "<li ". ($_COOKIE["current_page"] === $current["name"] ? " class=\"active\"" : "") ."><a onClick=\"changePage('". $current["name"] ."','". $current["url"] ."')\">". $current["name"] ."</a></li>";
?>
</ul>
<div id="links"><a href="https://github.com/TugaPower" target="new"><i class="fa fa-github"></i></a></div>