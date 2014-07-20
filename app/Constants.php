<?php
    session_start();
    if(!isset($_SESSION["isAdmin"])) $_SESSION["isAdmin"] = false;
    if(!isset($_SESSION["isAuthenticated"])) $_SESSION["isAuthenticated"] = false;
    if(!$_SESSION["isAuthenticated"]) {
        header('Location: login.php');
        die();
    }

    // Website Title
    define("WEBSITE_TITLE", "TugaPower");