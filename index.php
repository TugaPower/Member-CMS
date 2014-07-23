<?php
error_reporting(0);
session_start();

//Check if the user has permissions
if (!$_SESSION["isLogged"]) {
	echo "<script type\"Javascript\">window.location = \"login.php?needLogin=true\";</script>";
	die();
}

//Import useful files
require_once("utils/info.php");
require_once("utils/functions.php");

//Set the page's title and set this page as active
$title = "P�gina Principal";
$active_index = true;
require_once("utils/header.php");
?>

	<div class="page-header">
		<h1 id="news">Not�cias</h1>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>25/03/2014 &raquo; </b>Hello World</h3>
		</div>
		<div class="panel-body">
			Bem-vindos caros jogadores a mais uma temporada do <b>TugaPower</b>!<br>
			Como devem ter ouvido falar, estamos a planear em abrir um servidor de <a
				href="http://www.feed-the-beast.com/">Feed The Beast</a> nas f�rias da p�scoa, no entanto falta-nos uma
			coisa: <b>dinheiro</b>. Relembro que n�o � obrigat�rio ajudar a pagar o servidor, no entanto, fica sempre
			bem e sempre garantem mais uns dias a jogar no servidor.<br>
			Outra coisa que devem ter reparado � o uso deste website <strike>que parece um nojo e est� MUITO mal
				programado</strike>, que como alguns se devem relembrar, j� foi usado anteriormente. Como sempre, ele
			ir� ser usado como forma de comunica��o de not�cias mais importantes e longas que precisam de ser gravadas
			permanentemente. Al�m disso, � aqui que se ir�o registar as frequ�ncias do mod <b>Ender Storage</b> e onde
			se podem encontrar as regras e outras informa��es.<br>
			Antes de acabar, relembro que o servidor/comunidade agora chama-se <b>TugaPower</b>, substituindo o antigo
			<b>Portuguese Craft (com Mods)</b>.<br><br>

			Caso encontrem algum erro neste website, avisem-me pelo Skype.<br>
			- joaopms
		</div>
	</div>
<?php require_once("utils/footer.php"); ?>