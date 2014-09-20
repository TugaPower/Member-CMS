<?php include("./utils.php") ?>
	<meta charset="utf-8">
	<meta http-equiv="Content-Language" content="pt">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo WEBSITE_TITLE ?></title>
	<link href="favicon.ico" rel="shortcut icon">

	<!-- Main CSS file -->
	<link href="css/style.css" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery (need to be loaded before the end of the page because some pages use it's functionality earlier) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<?php if(!(basename($_SERVER['PHP_SELF']) == "login.php")) echo "<script src=\"js/util.js\"></script>" ?> <!-- Import our utility script; and import it only when we're not on the login page! -->