<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: Login.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 24/06/2008
//####################################
/**
 * P�gina de Login do Usu�rio. Informe o Login e a senha para acesso ao sistema
 */

require("config.php");

if(!isset($_SESSION["usuario_Logado"]))
{
	header("Location:index.php");
}

//Teste de Funcionalidade
if(isset($_GET['funcionalidade']))
{
	echo (isset($_GET['msg'])) ? "<script>carregaPagina('{$_GET['funcionalidade']}&msg={$_GET['msg']}','formulario');</script>" : "<script>carregaPagina('{$_GET['funcionalidade']}','formulario');</script>";
}

?>
<div id="menu">
<script>carregaPagina('viewMenu.php','menu');</script>
<script>carregaPagina('viewPrincipal.php','formulario');</script>
</div>
<div id="formulario">
</div>
