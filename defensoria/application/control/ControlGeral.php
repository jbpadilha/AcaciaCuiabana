<?php
/**
 * Classe Controladora Geral - Abstract pois todos os métodos proprietários devem estar aqui.
 * @author Joao Padilha joao.padilha@globo.com
 *
 */
require_once 'Mensagens.php';
abstract class ControlGeral
{
	public static $PAGINA_INICIO_LOGADO = "../public/inicio.php";
	public static $PAGINA_INICIO = "../public/index.php";
	
	public static $MENSAGEM_SUCESSO = Array();
	public static $MENSAGEM_ERRO = Array();
	
	public abstract function get($GET);
	public abstract function post($POST);
	public abstract function permiteAcesso($grupo);	

}

?>
