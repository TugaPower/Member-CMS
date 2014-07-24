<nav id="nav" class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><i id="avatar" class="fa fa-power-off"></i> <?php echo WEBSITE_TITLE ?></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-user" data-toggle="dropdown"><?php echo $_SESSION["username"] ?> <span class="caret"></span><img src="https://minotar.net/helm/<?php echo $_SESSION["username"] ?>/30.png"></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a onClick="changePage('Perfil', 'profile.php')">Configurações</a></li>
                    <li class="divider"></li>
                    <li><a href="exit.php">Sair</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>