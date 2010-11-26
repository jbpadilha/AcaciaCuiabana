<?php
require_once ('ControlGeral.php');
class ControlaLogin extends ControlGeral {
	/**
	 * @param Array $GET
	 */
	public function get($GET) {
		//header("Location:".ControlGeral::$PAGINA_INICIAL);
	}

	/**
	 * @param Array $POST
	 */
	public function post($POST) {
		
		$usuarios = null;
		try 
		{
			if(!ProjetoUtil::verificaBrancoNulo($POST['usuario']) && !ProjetoUtil::verificaBrancoNulo($POST['senha']))
			{
				$usuarios = new Usuarios();
				$usuarios->setUsuario(trim($POST['usuario']));
				$usuarios->setSenha(trim($POST['senha']));
				if($usuarios->find() > 0)
				{
					$usuarios->registraUsuarioSessao();
					header("Location:".ControlGeral::$PAGINA_INICIO_LOGADO);
				}
				else
				{
					$this->MENSAGEM_ERRO[] = Mensagens::$arrayMensagens["USUARIO_SENHA_INCORRETO"];
				}
			}	
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::$arrayMensagens["ACESSAR_BANCO_DADOS"].$e->getMessage());
		}
	}

	/**
	 * @param int $grupo
	 */
	public function permiteAcesso($grupo) {
		return true;
	}
	
}

?>
