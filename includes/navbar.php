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
			<li><a href="index.php">P�gina Inicial</a></li>
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