<?php
require_once '../application/ProjetoUtil.php';
new ProjetoUtil();
session_start();
if(!isset($_SESSION['loginusuario']))
{
	header("Location: conteudoInicial.php");
}
header("Content-Type: text/html; charset=UTF-8",true);
include 'mensagensErroSucesso.php';
?>
