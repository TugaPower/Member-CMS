<iframe width="1280" height="720" src="//www.youtube.com/embed/P_MJbgO7SF0?rel=0" frameborder="0" allowfullscreen></iframe>
<?php
    $news = array(array("title" => "Título 1", "message" => "Text. More Text, blabla", "author" => "SandroHc", "date" => "idk"),
                  array("title" => "Título 2", "message" => "Text 2. More Text 2, blabla", "author" => "joaopms", "date" => "idk"));

    foreach($news as $current) {
        echo "<div class=\"news\"><h1>". $current["title"] ."</h1>". $current["message"] ."<br><span class=\"author\">by ". $current["author"] ." on ". $current["date"] ."</span></div>";
    }
