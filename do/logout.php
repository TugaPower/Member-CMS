<?php
/**
 * Class used to logout users
 */
session_start();
session_destroy();

//GET arguments
$uponChanges = $_GET["uponChanges"];

if ($uponChanges)
	echo "<script type\"Javascript\">window.location = \"../login.php?uponChanges=true\";</script>";
else
	echo "<script type\"Javascript\">window.location = \"../login.php?success=true\";</script>";