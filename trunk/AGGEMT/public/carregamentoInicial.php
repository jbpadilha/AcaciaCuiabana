<?php
define("PATH_PROJETO", $_SERVER['DOCUMENT_ROOT']."/AGGEMT/");
define("PATH_PROJETO_APPLICATION", $_SERVER['DOCUMENT_ROOT']."/AGGEMT/application/");
define("PATH_PROJETO_IMAGEM_UPLOAD", "C:/Paginas_Sistemas/AGGEMT/public/images/");
define("PROJETO_CONTEXT", "http://AGGEMT/");
 
require_once PATH_PROJETO_APPLICATION.'ProjetoUtil.php';
new ProjetoUtil();
session_start();
/*if(!isset($_SESSION['loginusuario']))
{
	header("Location: conteudoInicial.php");
}*/
header("Content-Type: text/html; charset=UTF-8",true);
include 'admin/mensagensErroSucesso.php';
?>
