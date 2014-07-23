<?php
error_reporting(0);

//Import useful files
require_once("utils/info.php");
require_once("utils/functions.php");

isLogged_members();

//Set the page's title and set this page as active
$title = "Informa��es";
$active_info = true;
require_once("utils/header.php");
?>
	<div class="page-header">
		<h1 id="youtubers">Youtubers</h1>
	</div>
	<p><b>Nome do servidor:</b> Modded TugaPower</p>
	<p><b>Temporada do servidor:</b> Temporada 1</p>
	<p><b>Modpack do servidor:</b> Monster 1.1.0</p>
	<p><b>Mods a ativar:</b> Opis</p>
	<p><b>Mods a desativar:</b> Biomes o' Plenty</p><br>
	<p><b>Se �s um Youtuber e planeias gravar no servidor, dever�s incluir o seguinte na descri��o do v�deo:</b></p>
	<div class="well well-sm">
		O TugaPower � um servidor de Minecraft privado, no qual s� entram pessoas convidadas pelo dono (joaopms).<br>
		Caso queiras jogar com o mesmo modpack que usamos no servidor, vai ao site do Feed The Beast, faz download do
		launcher e escolhe o modpack "Monster" (Minecraft 1.6.4).
	</div>

	<div class="page-header">
		<h1 id="servers">Informa��es dos servidores</h1>
	</div>
	<h3>TeamSpeak 3</h3>
	Antes de puderes entrar na sala principal, � necess�rio que um administrador te d� permiss�o. Enquanto isso n�o acontecer, espera no Lobby do TugaPower e avisa um administrador.
	<br>
	<b>IP do servidor:</b> teamspeak.feed-the-beast.com<br>
	<b>Password do servidor:</b> mcepoch1<br>
	<b>Sala em que estamos:</b> Server Rooms -> TugaPower<br>
	<b>DICA - Acesso r�pido (colocar no campo "Default Channel"):</b> Server Rooms/TugaPower/Server Chat<br>
	<h3>Minecraft</h3>
	<b>IP do servidor:</b> 88.150.162.115
<?php require_once("utils/footer.php"); ?>