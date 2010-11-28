<?php

if(isset($_GET['mensagemErro']) || isset($_SESSION['mensagemErro']))
{   
	$MENSAGEM_ERRO = new ArrayIterator(unserialize(urldecode($_GET['mensagemErro'])));
	echo "<div id=\"erros\" class=\"erros\">";
	foreach ($MENSAGEM_ERRO as $mensagem)
	{
		echo $mensagem."<br/>";
	}
	echo "</div>";
}
elseif(isset($_GET['mensagemSucesso']) || isset($_SESSION['mensagemSucesso']))
{   
	$MENSAGEM_SUCESSO = new ArrayIterator(unserialize(urldecode($_GET['mensagemSucesso'])));
	echo "<div id=\"sucesso\" class=\"sucesso\">";
	foreach ($MENSAGEM_SUCESSO as $mensagem)
	{
		echo $mensagem."<br/>";
	}
	echo "</div>";
}