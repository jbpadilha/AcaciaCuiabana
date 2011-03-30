<?php
//####################################
// * João Batista Padilha e Silva Analista/Desenvolvedor (Ábaco Tecnologia)
// * Arquivo: cabecalhoHTML.php
// * Criação: João Batista Padilha e Silva
// * Revisão:
// * Data de criação: 23/06/2008
//####################################
/*
   Página geral de Cabeçalho do Sistema.
*/
include_once("config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
	<head>
		<title><?=TITULO?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="resource-type" content="document" />
		<meta name="classification" content="Internet" />
		<meta name="description" content="www.abaco.com.br - Suporte Online da Abaco Tecnologia de Informacao LTDA" />
		<meta name="keywords" content="suporte, abaco, tecnologia, informacao, cuiaba, mt, brasil" />
		<meta name="robots" content="ALL" />
		<meta name="author" content="Abaco Tecnologia de Informacao LTDA" />
		<meta name="language" content="pt-br" />
		<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/default.css" />
		<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/jquery-calendar.css" />
		<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/thickbox.css" />
		<link rel="stylesheet" type="text/css" media="print, handheld" href="<?=PATH?>/css/print.css" />
		<script type="text/javascript" src="<?=PATH?>/js/jquery.js"></script>
		<script type="text/javascript" src="<?=PATH?>/js/jquery.livequery.js"></script>
		<script type="text/javascript" src="<?=PATH?>/js/jquery.maskedinput.js"></script>
		<script type="text/javascript" src="<?=PATH?>/js/thickbox.js"></script>
		<script type="text/javascript" src="<?=PATH?>/js/jquery.blockui.js"></script>
		<script type="text/javascript" src="<?=PATH?>/js/jquery-calendar.js"></script>
		<script type="text/javascript" src="<?=PATH?>/js/ajaxfileupload.js"></script>
		
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/iehacks.css" />
		<![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" type="text/css" media="screen,projection" href="<?=PATH?>/css/default_ie7.css" />
		<![endif]-->
		<script language="JavaScript" type="text/javascript">		
			
			function carregaPagina(url,id) 
			{
			    $("div#"+id).html("<div aligh='center'><font color=\"#FF0000\">Carregando ...</font>  <img src='imagens/loading.gif' align='top' alt='aguarde' /></div>");
			            $.post(url,{ },function(retorno){
			            	$("#"+id).empty().html(retorno);
			            });
			}
		</script>
	</head>