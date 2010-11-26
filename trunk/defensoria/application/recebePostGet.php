<?php
/**
 * Arquivo de controle de recebimento de requisições. 
 * Muito bom para controlar requisições e direcioná-las para a classe de controle correspondente 
 * @var $_GET e $_POST
 * @author João Batista Padilha e Silva --- joao.padilha@globo.com
 * @since 23/11/2010
 */
require_once 'ProjetoUtil.php';
require_once 'Mensagens.php';
new ProjetoUtil();
$MENSAGEM_SUCESSO = Array();
$MENSAGEM_ERRO = Array();
$grupo = (isset($_SESSION['grupo'])) ?$_SESSION['grupo'] : null;

try {
	switch($_SERVER['REQUEST_METHOD'])
	{
		case 'GET': 
			{
				if(isset($_GET['control']))				
				{
					$control = $_GET['control']; //Classe Control
					require 'control/'.$control.".php";
					$controla = new $control($_GET);
					if($controla->permiteAcesso($grupo)){
						$controla->get($_GET);
					}
					else
					{
						$MENSAGEM_ERRO[] = Mensagens::$arrayMensagens["ACESSO_NEGADO"];		
					}
				}
				else
				{
					header("Location: ../public/index.php");
				}
				break;	
			}
		case 'POST': 
			{
				if(isset($_POST['control']))
				{
					$control = $_POST['control']; //Classe Control
					require 'control/'.$control.".php";
					$controla = new $control($_POST);
					if($controla->permiteAcesso($grupo)){
						$controla->post($_POST);
					}
					else
					{
						$MENSAGEM_ERRO[] = Mensagens::$arrayMensagens["ACESSO_NEGADO"];		
					}
				}
				else
				{
					header("Location: ../public/index.php");
				}
				break;
			}
		default:
			{
				header("Location: ../public/index.php");
			}
	}
}
catch (Exception $e)
{
	$MENSAGEM_ERRO[] = Mensagens::$arrayMensagens["ERRO"].$e->getMessage();
	header("Location:../public/index.php?mensagemErro=".urlencode(serialize($MENSAGEM_ERRO))); 
}
