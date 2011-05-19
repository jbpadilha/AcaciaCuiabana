<?php
define("PATH_PROJETO", $_SERVER['DOCUMENT_ROOT']."aggemt/");
define("PATH_PROJETO_APPLICATION", $_SERVER['DOCUMENT_ROOT']."aggemt/application/");
define("PATH_PROJETO_IMAGEM_UPLOAD", "/home/joaopadilha/aggemt.joaopadilha.com/public/images/");
define("PROJETO_CONTEXT", "http://aggemt.joaopadilha.com/");

require_once PATH_PROJETO_APPLICATION.'ProjetoUtil.php';
new ProjetoUtil();
session_start();
header("Content-Type: text/html; charset=UTF-8",true);
?>
