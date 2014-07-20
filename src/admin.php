<?php
    include("./app/Constants.php");

    if(!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
        echo "<h3 style=\"text-align: center\"><i class=\"fa fa-exclamation-triangle\"></i> You don't have permissions to be in this page.</h3>";
        die();
    }

    echo "Welcome, my Lord ". $_SESSION["username"] ."!";