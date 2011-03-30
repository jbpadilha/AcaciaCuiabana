<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: index.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 23/06/2008
//####################################
/**
 * P�gina Inicial do Sistema. Se o usu�rio estiver logado, carrega a p�gina em si. 
   Caso o usu�rio n�o estiver logado, carregaa p�gina de login.
 */
include_once("cabecalhoHTML.php");
?>
<body>
	<div id="topoAtendimento">
	<?php
		if (isset($_SESSION['nome_Usuario'])) {
			echo "Ol�, ".$_SESSION['nome_Usuario']." - ".ucfirst(gmstrftime('%A')).", ".date("d")." de ".gmstrftime('%B')." de ".date("Y");
		}
	?>
	</div>
	<div id="container">
		<div id="topo"></div>
		<div id="conteudo">
		</div>
	</div>
	<?php
	if(!isset($_SESSION["usuario_Logado"]))
	{
		if(isset($_GET['msg']))
			echo "<script type='text/javascript'>carregaPagina('login.php?msg={$_GET['msg']}','conteudo')</script>";
		else 
			echo "<script type='text/javascript'>carregaPagina('login.php','conteudo')</script>";
	}
	else
	{
		if(isset($_GET['funcionalidade']))
		{
			echo (isset($_GET['msg'])) ? "<script type='text/javascript'>carregaPagina('interna.php?msg={$_GET['msg']}&funcionalidade={$_GET['funcionalidade']}','conteudo')</script>" : "<script type='text/javascript'>carregaPagina('interna.php?funcionalidade={$_GET['funcionalidade']}','conteudo')</script>";
		}
		else
		{ 
			echo (isset($_GET['msg'])) ? "<script type='text/javascript'>carregaPagina('interna.php?msg={$_GET['msg']}','conteudo')</script>" : "<script type='text/javascript'>carregaPagina('interna.php','conteudo')</script>";
		}
	}
	?>
	<div id="rodape"></div>
</body>
</html>