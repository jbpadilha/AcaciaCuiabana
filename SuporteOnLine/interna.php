<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: Login.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 24/06/2008
//####################################
/**
 * Página de Login do Usuário. Informe o Login e a senha para acesso ao sistema
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
