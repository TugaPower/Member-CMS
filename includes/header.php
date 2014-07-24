<?php
error_reporting(0);
session_start();

// Import useful files
include("./utils/info.php");
include("./utils/functions.php");

// Set some variables if they aren't defined
if ($requireAuth == null)
	$requireAuth = true;

if ($showNavbar == null)
	$showNavbar = true;

// Check if the user has permissions
if ($needsAuth && !$_SESSION["isLogged"])
	die("<script type\"Javascript\">window.location = \"login.php?needLogin=true\";</script>");?>
<html>
<head>
	<title><?php echo $title; ?> &raquo; TugaPower</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/custom.css"/>

	<!-- Javascript -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" id="content">
	<?php if ($showNavbar) include("navbar.php"); ?>

