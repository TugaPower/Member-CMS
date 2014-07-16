<?php
    $stats = [
        "SandroHc",
        "joaopms",
        "death_the_king2000",
        "Zyroshi_Zyron"
    ];

    echo "<div class=\"selector\">";
    for($i = 0; $i < sizeof($stats); $i++)
        echo "<div class=\"avatar\" onClick=\"load('". $stats[$i] ."')\"><img src=\"https://minotar.net/helm/". $stats[$i] ."/96.png\"><span>". $stats[$i] ."</span></div>";
    echo "</div>";
?>
<div class="stats" onLoad="loadStatElements(); load('<?php echo $stats[0] ?>') /* Loads the first player on the array list */">
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