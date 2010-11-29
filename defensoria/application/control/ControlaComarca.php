<?php
require_once ('ControlGeral.php');
class ControlaComarca extends ControlGeral{
	
	public function cadastrar(Comarca $comarca)
	{
		try {
			if($comarca->getNomecomarca()!=null)
			{
				$comarca->save();
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
			}
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	public function deletar(Comarca $comarca)
	{
		try {
			if($comarca->getIdcomarca()!= null)
			{
				$comarca->delete();
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));	
			}
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	public function alterar(Comarca $comarca)
	{
		try
		{
			if($comarca->getIdcomarca()!= null && $comarca->getNomecomarca()!=null)
			{
				$comarca->update();
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
			}
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	/**
	 * @param array $GET
	 */
	public function get($GET) {
		header("Location:../public/comarca.php");
	}

	/**
	 * @param array $POST
	 */
	public function post($POST) {
		$comarca = null;
		try {
			$function = (isset($POST['function']))?$POST['function']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$comarca = new Comarca();
				if($POST['function'] == "cadastrar")
				{
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					if(!ProjetoUtil::verificaBrancoNulo($nome))
					{
						$comarca->setNomecomarca($nome);
						$this->cadastrar($comarca);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/inicio.php?page=comarca&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
				}
				elseif($POST['function'] == "deletar")
				{
					$idComarca = (isset($POST['idComarca']))?$POST['idComarca']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idComarca))
					{
						$comarca->setIdcomarca($idComarca);
						$this->deletar($comarca);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/inicio.php?page=comarca&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['function'] == "alterar")
				{
					$idComarca = (isset($POST['idComarca']))?$POST['idComarca']:null;
					$nome = (isset($POST['nome']))?$POST['nome']:null; 
					if(!ProjetoUtil::verificaBrancoNulo($idComarca) && !ProjetoUtil::verificaBrancoNulo($nome))
					{
						$comarca->setIdcomarca($idComarca);
						$comarca->setNomecomarca($nome);
						$this->alterar($comarca);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/inicio.php?page=comarca&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
				}
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE"));
			}
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
			header("Location:../public/inicio.php?page=comarca&mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}

	/**
	 * @param unknown_type unknown_type $grupo
	 */
	public function permiteAcesso($grupo) {
		return true;	
	}


	
}

?>