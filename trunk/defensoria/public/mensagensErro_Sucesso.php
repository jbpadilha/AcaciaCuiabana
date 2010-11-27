<?php

if(isset($_GET['mensagemErro']) || isset($_SESSION['mensagemErro']))
{   
	$MENSAGEM_ERRO = new ArrayIterator(unserialize(urldecode($_GET['mensagemErro'])));
	echo "<div class=\"erro\">";
	foreach ($MENSAGEM_ERRO as $mensagem)
	{
		echo $mensagem."<br/>";
	}
	echo "</div>";
}
elseif(isset($_GET['mensagemSucesso']) || isset($_SESSION['mensagemSucesso']))
{   
	$MENSAGEM_SUCESSO = new ArrayIterator(unserialize(urldecode($_GET['mensagemSucesso'])));
	echo "<div class=\"sucesso\">";
	foreach ($MENSAGEM_SUCESSO as $mensagem)
	{
		echo $mensagem."<br/>";
	}
	echo "</div>";
}