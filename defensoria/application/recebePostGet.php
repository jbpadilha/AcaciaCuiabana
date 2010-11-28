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
header("Content-Type: text/html; charset=ISO-8859-1",true);
try {
	switch($_SERVER['REQUEST_METHOD'])
	{
		case 'GET': 
			{
				if(isset($_GET['control']))				
				{
					$control = "Controla".$_GET['control']; //Classe Control
					require 'control/'.$control.".php";
					$controla = new $control($_GET);
					if($controla->permiteAcesso($grupo)){
						$controla->get($_GET);
					}
					else
					{
						$MENSAGEM_ERRO[] = Mensagens::getMensagem("ACESSO_NEGADO");		
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
					$control = "Controla".$_POST['control']; //Classe Control
					require 'control/'.$control.".php";
					$controla = new $control($_POST);
					if($controla->permiteAcesso($grupo)){
						$controla->post($_POST);
					}
					else
					{
						$MENSAGEM_ERRO[] = Mensagens::getMensagem("ACESSO_NEGADO");		
					}
				}
				else
				{
					echo 'Erro ao tentar carregar a funcionalidade.';
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
	$MENSAGEM_ERRO[] = Mensagens::getMensagem("ERRO").$e->getMessage();
	header("Location:../public/index.php?mensagemErro=".urlencode(serialize($MENSAGEM_ERRO))); 
}
