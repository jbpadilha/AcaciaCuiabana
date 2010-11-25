<?php
/**
 * Arquivo de controle de recebimento de requisi��es. 
 * Muito bom para controlar requisi��es e direcion�-las para a classe de controle correspondente 
 * @var $_GET e $_POST
 * @author Jo�o Batista Padilha e Silva --- joao.padilha@globo.com
 * @since 23/11/2010
 */
require_once 'ProjetoUtil.php';
$MENSAGEM_SUCESSO = Array();
$MENSAGEM_ERRO = Array();
$grupo = (isset($_SESSION['grupo'])) ?$_SESSION['grupo'] : null;
try {
	switch($_SERVER['REQUEST_METHOD'])
	{
		case 'GET': 
			{
				$control = $_GET['control']; //Classe Control
				require 'control/'.$control.".php";
				$controla = new $control($_GET);
				if($controla->permiteAcesso($grupo)){
					$controla->get($_GET);
				}
				else
				{
					$MENSAGEM_ERRO[] = "Acesso n�o autorizado.";		
				}
				break;	
			}
		case 'POST': 
			{
				$control = $_POST['control']; //Classe Control
				require 'control/'.$control.".php";
				$controla = new $control($_POST);
				if($controla->permiteAcesso($grupo)){
					$controla->post($_POST);
				}
				else
				{
					$MENSAGEM_ERRO[] = "Acesso n�o autorizado.";		
				}
				break;
			}
		default:
			{
				header(dirname(dirname(__FILE__))."index.php");
			}
	}
}
catch (Exception $e)
{
	$MENSAGEM_ERRO[] = "Erro ao tentar carregar o menu. {$e->getMessage()}";
	header(DefensoriaUtil::$PAGINA_INICIAL);
	echo "erro"; 
}
