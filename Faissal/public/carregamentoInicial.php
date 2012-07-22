<?php
ini_set('error_reporting',E_ALL);
error_reporting(E_ALL);
define("PATH_PROJETO", $_SERVER['DOCUMENT_ROOT']."Faissal/");
define("PATH_PROJETO_APPLICATION", $_SERVER['DOCUMENT_ROOT']."Faissal/application/");
define("PATH_PROJETO_IMAGEM_UPLOAD", "/images/");
define("PROJETO_CONTEXT", "http://faissal.joaopadilha.com");
define("PATH_PROJETO_IMAGEM", "http://faissal.joaopadilha.com/images/");
require_once  PATH_PROJETO_APPLICATION.'ProjetoUtil.php';
new ProjetoUtil();
session_start();
$configuracoes = new TabelaPrincipal();
$configuracoes->reset();
$configuracoes->limit(1);
$configuracoes->find(true);
header("Content-Type: text/html; charset=UTF-8",true);
?>
