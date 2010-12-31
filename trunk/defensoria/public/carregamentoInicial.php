<?php
require_once '../application/ProjetoUtil.php';
new ProjetoUtil();
if(!isset($_SESSION['loginusuario']))
{
	header("Location: index.php");
}
header("Content-Type: text/html; charset=ISO-8859-1",true);
include 'mensagensErroSucesso.php';
?>
