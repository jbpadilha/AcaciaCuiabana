<?php
require_once ('ControlGeral.php');
class ControlaLogin extends ControlGeral {
	/**
	 * @param Array $GET
	 */
	public function get($GET) {
		header("Location:".ControlGeral::$PAGINA_INICIO);
	}

	/**
	 * @param Array $POST
	 */
	public function post($POST) {
		
		$usuarios = null;
		$user = (isset($POST['usuario']))?$POST['usuario']:null;
		$senha = (isset($POST['senha']))?$POST['senha']:null;
		if(!ProjetoUtil::verificaBrancoNulo($user) && !ProjetoUtil::verificaBrancoNulo($senha))
		{
			try {				
				$usuarios = new Usuarios();
				$usuarios->setUsuario(trim($POST['usuario']));
				$usuarios->setSenha(sha1(trim($POST['senha'])));
				if($usuarios->find(true) > 0)
				{
					$usuarios->registraUsuarioSessao();
					header("Location:".ControlGeral::$PAGINA_INICIO_LOGADO);
				}
				else
				{
					$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("USUARIO_SENHA_INCORRETO");
					header("Location:".ControlGeral::$PAGINA_INICIO."?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
				}
			}
			catch (Exception $e)
			{
				throw new Exception(Mensagens::getMensagem("ACESSAR_BANCO_DADOS").$e->getMessage());
			}
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
