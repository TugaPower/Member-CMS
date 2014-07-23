<?php
error_reporting(0);

//Import useful files
require_once("utils/info.php");
require_once("utils/functions.php");

isLogged_members();

//Set the page's title and set this page as active
$title = "Regras";
$active_rules = true;
require_once("utils/header.php");
?>
	<div class="alert alert-danger" style="margin-bottom: -25px;">
		O incumprimento das regras d� direito a penaliza��es, sendo elas tempor�rias ou permanentes.
	</div>

	<div class="page-header">
		<h1>Regras Gerais
			<small>Aplicadas em todo o lado</small>
		</h1>
	</div>
	<ul>
		<li>N�o fazer spam e/ou publicidade;</li>
		<li>N�o publicar links ilegais;</li>
		<li>N�o falar de assuntos pol�micos, como pol�tica e religi�es;</li>
		<li>N�o agir como uma crian�a;</li>
		<li>N�o ser chato/a;</li>
		<li>N�o amea�ar;</li>
		<li>N�o desrespeitar as pessoas, especialmente os administradores e moderadores;</li>
		<li>N�o pedir informa��es pessoais a qualquer pessoa;</li>
		<li>N�o partilhar qualquer tipo de informa��o sobre o servidor e os seus membros (exceto se ela for fornecida
			por um administrador ou moderador para divulga��o);
		</li>
		<li>Nada de racismo e/ou sexismo;</li>
		<li>Tentar n�o insultar (mesmo que seja na brincadeira);</li>
		<li>Caso tenhas alguma pergunta, exp�e-a e aguarda pacientemente pela resposta;</li>
		<li>Caso possas e queiras ajudar a pagar o servidor, dever�s faz�-lo, no entanto n�o ir�s receber nenhum
			previl�gio extra;
		</li>
		<li>Dever�s frequentar o grupo do <b>Skype</b>, a sala do <b>TeamSpeak</b> e o servidor de <b>Minecraft</b>;
		</li>
		<li>Dever�s seguir as ordens dos administradores.</li>
	</ul>

	<div class="page-header">
		<h1>Regras de Comunica��o
			<small>Aplicadas no TeamSpeak e Skype</small>
		</h1>
	</div>
	<ul>
		<li>Caso precises de divulgar ou falar de assuntos mais confid�nciais, dever�s usar o Skype;</li>
		<li><b>No caso do TeamSpeak:</b> n�o dever�s sair e entrar de canais constantemente e entrar ao berros em
			quaquer canal;
		</li>
		<li><b>No caso do TeamSpeak:</b> uma vez que o servidor que usamos � baseado na l�ngua inglesa, dever�s escrever
			a tua descri��o, estado do nickname e falar com outras pessoas que n�o pertencem ao TugaPower usando a
			l�ngua inglesa (exceto se essa pessoa n�o utilizar a l�ngua inglesa como meio de conversa��o contigo);
		</li>
		<li><b>No caso do TeamSpeak:</b> caso estejas a gravar e estejas a incluir o som do TeamSpeak no v�deo, dever�s
			ir para a sala reservada para gravar no servidor e colocar uma tag no teu nickname (em ingl�s) - exemplo:
			<b>joaopms [Recording]</b>;
		</li>
		<li><b>No caso do Skype:</b> n�o dever�s adicionar qualquer pessoa � conversa sem autoriza��o de um
			administrador;
		</li>
		<li><b>No caso do Skype:</b> n�o ligar para a chamada e/ou alterar o seu t�pico;</li>
	</ul>

	<div class="page-header">
		<h1>Regras do Servidor
			<small>Aplicadas ao servidor de Minecraft</small>
		</h1>
	</div>
	<ul>
		<li>N�o abusar de PVP;</li>
		<li>N�o abusar de Chunk Loaders;</li>
		<li>N�o abusar de mob farms;</li>
		<li>N�o fazer pranks;</li>
		<li>N�o fazer uso de bugs/exploits de forma a te favorecer;</li>
		<li>N�o construir lag machines;</li>
		<li>N�o destruir a paisagem (especialmente com Quarrys - coloca-as debaixo de terra ou tapa o seu buraco);</li>
		<li>N�o roubar e/ou griefar;</li>
		<li>N�o construir bases a mais de 2000 blocos do spawn e/ou a menos de 100 blocos do spawn;</li>
		<li>N�o se afastar mais de 3000 blocos do spawn (aplicado a todos os mundos);</li>
		<li>N�o usar as frequ�ncias de terceiros;</li>
		<li>Caso queiras vender alguma coisa, dever�s criar uma loja no spawn;</li>
		<li>Quando a tua quarry acabar o seu trabalho, dever�s remov�-la e, caso tenhas colocado �gua dentro da �rea
			minada, n�o retirar a �gua existente;
		</li>
		<li>Quando achares ou criares uma Portal Gun, dever�s convert�-la para uma Bacon/Potato Gun - desse modo, todos
			os portais que criares ser�o s� teus;
		</li>
		<li>Quando fores colocar a tua quarry no mundo, coloca-a a mais de 2200 blocos do spawn;</li>
		<li>Tentar manter o mundo o mais agrad�vel poss�vel, como por exemplo, plantando �rvores e cobrindo as explos�es
			que possas provocar e/ou encontrar;
		</li>
		<li>Embora seja permitida a cria��o de ages, dever�s saber o que est�s a fazer antes de criares uma;</li>
		<li>Apenas � permitida o m�ximo de 1 age por jogador;</li>
		<li>Respeitar tudo e todos.</li>
	</ul>

	<div class="alert alert-warning">
		As regras poder�o ser atualizadas a qualquer momento, sem qualquer aviso. � tua obriga��o as consultares
		regularmente.<br>
		<b>�ltima atualiza��o:</b> 25 de mar�o de 2014
	</div>

<?php require_once("utils/footer.php"); ?>