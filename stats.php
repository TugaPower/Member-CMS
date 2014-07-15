<?php
    $users = ["SandroHc", "joaopms", "death_the_king2000", "Zyroshi_Zyron"];

    echo "<div class=\"selector\">";
    for($i = 0; $i < sizeof($users); $i++) {
        echo "<div class=\"avatar\"><img src=\"https://minotar.net/helm/". $users[$i] ."/150.png\"><span>". $users[$i] ."</span></div>";
    }
    echo "</div>";