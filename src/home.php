<?php
	include("utils.php");

	$con = startConnection();

	$query = "SELECT * FROM ". DB_NAME .".news ORDER BY date DESC LIMIT 5";
	$result = mysqli_query($con, $query) or die('Error: '. $con->error);

	$news = array();
	while($row = mysqli_fetch_array($result)) {
		$entry = array();
		$entry["title"] = $row["title"];
		$entry["body"] = $row["body"];
		$entry["date"] = $row["date"];
		$entry["author"] = $row["author"];

		$news[] = $entry;
	}
	mysqli_free_result($result);

	foreach($news as $current)
		echo "<div class=\"news\"><h1>". $current["title"] ."</h1>". $current["body"] ."<br><span class=\"author\">por ". $current["author"] ." em ". $current["date"] ."</span></div>";

	if(sizeof($news) < 1) echo "Nenhuma notícia disponível.";
