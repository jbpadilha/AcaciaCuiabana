<?php
echo '<script type="text/javascript">';
if(isset($_GET['mensagemErro']) || isset($_SESSION['mensagemErro']))
{   
	$MENSAGEM_ERRO = new ArrayIterator(unserialize(urldecode($_GET['mensagemErro'])));
	echo "$( '#erros' ).html( '";
	foreach ($MENSAGEM_ERRO as $mensagem)
	{
		echo $mensagem."<br/>";
	}
	echo "' );";
	echo "alert('{$mensagem}')";
}
if(isset($_GET['mensagemSucesso']) || isset($_SESSION['mensagemSucesso']))
{   
	$MENSAGEM_SUCESSO = new ArrayIterator(unserialize(urldecode($_GET['mensagemSucesso'])));
	echo "$( '#sucesso' ).html( '";
	foreach ($MENSAGEM_SUCESSO as $mensagem)
	{
		echo $mensagem."<br/>";
	}
	echo "' );";
	echo "alert('{$mensagem}')";
}
echo '</script>';