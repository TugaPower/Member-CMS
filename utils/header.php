<?php
/**
 * Class that contains the header on the website for easy use
 */
?>
<html>
<head>
	<title><?php echo $title; ?> &raquo; TugaPower - �rea Restrita</title>
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
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">TugaPower</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-navbar-collapse">
			<ul class="nav navbar-nav">
				<li <?php if ($active_index) {
					echo "class=\"active\"";
				} ?>><a href="index.php">P�gina Inicial</a></li>
				<li <?php if ($active_rules) {
					echo "class=\"active\"";
				} ?>><a href="rules.php">Regras</a></li>
				<li <?php if ($active_info) {
					echo "class=\"active\"";
				} ?>><a href="info.php">Informa��es</a></li>
				<li <?php if ($active_freq) {
					echo "class=\"active\"";
				} ?>><a href="freqs.php">Frequ�ncias</a></li>

				<?php if (isAdmin(connectToDatabase($db_host, $db_username, $db_password, $db_database), getUsername())) {
					echo "<li ";
					if ($active_admin) {
						echo "class=\"active\"";
					}
					echo "><a href=\"admin.php\">Administra��o</a></li>";
				} ?>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo getUsername(); ?> <b
							class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="account.php">Conta</a></li>
						<li class="divider"></li>
						<li><a href="do/logout.php">Terminar sess�o</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

