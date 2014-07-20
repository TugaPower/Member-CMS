<?php
    session_start();

    // If already logged in, redirect to the main page
    if(isset($_SESSION["isAuthenticated"]) && $_SESSION["isAuthenticated"]) {
        header("Location: index.php");
        die();
    }

    // If received a POST, log us in!
    if(isset($_POST["nick"])) {
        $_SESSION["isAdmin"] = true;
        $_SESSION["isAuthenticated"] = true;
        $_SESSION["username"] = $_POST["nick"];

        header("Location: index.php");
        die();
    }

    if(isset($_GET["exited"]))
        echo "Congratulations! You logged yourself out!";
    else
        echo "Here you go! Now log yourself in!";
?>
<form action="login.php" method="post">
    <input name="nick" type="text" placeholder="Nick">
    <input type="submit" value="Entrar">
</form>