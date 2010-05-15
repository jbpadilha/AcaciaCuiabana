<?php

/**
 * P�gina inicial do Sistema.
 * @author Jo�o Batista Padilha e Silva
 * @link config.php
 * @copyright Jo�o Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / joao.padilha@globo.com
 * @version 1.0
 */
error_reporting(E_ALL);
date_default_timezone_set('America/Cuiaba');

// Inclui a Classe Controladora
require_once("ControlaFuncionalidades.php");
session_start();
// Declara��o de Constantes e vari�veis:
$dominio = new Dominio();
$formataData = new FormataData();
$controla = new ControlaFuncionalidades();

define ("DB_HOST", $dominio->DB_HOST);
define ("DB_USER", $dominio->DB_USER);
define ("DB_PASSWD", $dominio->DB_PASSWD);
define ("DB_DATA", $dominio->DB_DATA);

date_default_timezone_set('America/Cuiaba');

define ("TITULO", "..~`SMC - Manuten��o como deve ser feita.`~..");
define ("LOGS_PATH", "./");
define ("SELECIONE","Selecione");

header("Content-Type: text/html; charset=ISO-8859-1");
	
	
?>