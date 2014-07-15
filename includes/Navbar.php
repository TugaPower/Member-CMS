<?php $user = "joaopms" // Temporary ?>
<nav id="nav" class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><i id="avatar" class="fa fa-power-off"></i> <?php echo WEBSITE_TITLE ?></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="nav-avatar" src="https://minotar.net/helm/<?php echo $user ?>/32.png"><?php echo $user ?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Configurações</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sair</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>