<?php
	include("utils.php");

	session_start();
	session_destroy();
	redirect("login.php?exited");