<?php
/**
 * Classe Controladora Geral - Abstract pois todos os m�todos propriet�rios devem estar aqui.
 * @author Joao Padilha joao.padilha@globo.com
 *
 */
require_once 'Mensagens.php';
abstract class ControlGeral
{
	public static $PAGINA_INICIO_LOGADO = "../public/admin/inicio.php";
	public static $PAGINA_INICIO = "../public/index.php";
	
	public $MENSAGEM_SUCESSO;
	public $MENSAGEM_ERRO;
	
	public abstract function get($GET);
	public abstract function post($POST);
	public abstract function permiteAcesso($grupo);
}

?>
