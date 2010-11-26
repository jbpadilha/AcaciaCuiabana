<?php
/**
 * Classe Controladora Geral - Abstract pois todos os métodos proprietários devem estar aqui.
 * @author Joao Padilha joao.padilha@globo.com
 *
 */
require_once ('ProjetoUtil.php');
abstract class ControlGeral
{
	public static $PAGINA_INICIAL;
	public static $PAGINA_INICIAL_LOGADO;
	public static $MENSAGEM_SUCESSO = Array();
	public static $MENSAGEM_ERRO = Array();
	
	public function __construct()
	{
		$PAGINA_INICIAL = dirname(dirname(__FILE__))."/index.php";
		$PAGINA_INICIAL = dirname(dirname(__FILE__))."/index_logado.php";
	}
	
	public abstract function get($GET);
	public abstract function post($POST);
	public abstract function permiteAcesso($grupo);	

}

?>
