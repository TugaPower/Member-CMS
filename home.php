<?php
    include("utils.php");

    $con = startDBConnection();
    mysqli_select_db($con, "news");

    $query = "SELECT * FROM $db_database.news ORDER BY date DESC";
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
    closeDBConnection();

    foreach($news as $current)
        echo "<div class=\"news\"><h1>". $current["title"] ."</h1>". $current["body"] ."<br><span class=\"author\">by ". $current["author"] ." on ". $current["date"] ."</span></div>";

    if(sizeof($news) < 1) echo "No available news.";
