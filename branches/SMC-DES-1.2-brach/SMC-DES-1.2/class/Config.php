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

header("Content-Type: text/html; charset=ISO-8859-1");//

$estados = array(
	'AC' => 'Acre', 'AL' => 'Alagoas', 'AM' => 'Amazonas', 'AP' => 'Amap�',
	'BA' => 'Bahia', 'CE' => 'Cear�', 'DF' => 'Distrito Federal', 'ES' => 'Esp�rito Santo',
	'GO' => 'Goi�s', 'MA' => 'Maranh�o', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
	'MG' => 'Minas Gerais', 'PA' => 'Par�', 'PB' => 'Para�ba', 'PR' => 'Paran�',
	'PE' => 'Pernambuco', 'PI' => 'Piau�', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
	'RO' => 'Rond�nia', 'RS' => 'Rio Grande do Sul', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
	'SE' => 'Sergipe', 'SP' => 'S�o Paulo', 'TO' => 'Tocantins'
);

$estadoCivil = array(
	'Solteiro(a)', 'Casado(a)', 'Divorciado(a)', 'Uni�o est�vel'
);

$sexo = array(
	'M' => 'Masculino', 
	'F' => 'Feminino'
);

?>