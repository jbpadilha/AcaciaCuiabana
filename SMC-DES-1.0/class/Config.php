<?php

/**
 * Pбgina inicial do Sistema.
 * @author Joгo Batista Padilha e Silva
 * @link config.php
 * @copyright Joгo Batista Padilha e Silva Especialista em TI (http://www.joaopadilha.eti.br) / joao.padilha@globo.com
 * @version 1.0
 */
error_reporting(E_ALL);
date_default_timezone_set('America/Cuiaba');

// Inclui a Classe Controladora
require_once("ControlaFuncionalidades.php");
session_start();
// Declaraзгo de Constantes e variбveis:
$dominio = new Dominio();
$formataData = new FormataData();
$controla = new ControlaFuncionalidades();

define ("DB_HOST", $dominio->DB_HOST);
define ("DB_USER", $dominio->DB_USER);
define ("DB_PASSWD", $dominio->DB_PASSWD);
define ("DB_DATA", $dominio->DB_DATA);

date_default_timezone_set('America/Cuiaba');

define ("TITULO", "..~`SMC - Manutenзгo como deve ser feita.`~..");
define ("LOGS_PATH", "./");
define ("SELECIONE","Selecione");

header("Content-Type: text/html; charset=ISO-8859-1");//

$estados = array(
	'AC' => 'Acre', 'AL' => 'Alagoas', 'AM' => 'Amazonas', 'AP' => 'Amapб',
	'BA' => 'Bahia', 'CE' => 'Cearб', 'DF' => 'Distrito Federal', 'ES' => 'Espнrito Santo',
	'GO' => 'Goiбs', 'MA' => 'Maranhгo', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
	'MG' => 'Minas Gerais', 'PA' => 'Parб', 'PB' => 'Paraнba', 'PR' => 'Paranб',
	'PE' => 'Pernambuco', 'PI' => 'Piauн', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
	'RO' => 'Rondфnia', 'RS' => 'Rio Grande do Sul', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
	'SE' => 'Sergipe', 'SP' => 'Sгo Paulo', 'TO' => 'Tocantins'
);

$estadoCivil = array(
	'Solteiro(a)', 'Casado(a)', 'Divorciado(a)', 'Uniгo estбvel'
);

$sexo = array(
	'M' => 'Masculino', 
	'F' => 'Feminino'
);

?>