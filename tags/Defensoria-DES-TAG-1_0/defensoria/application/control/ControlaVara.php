<?php

require_once ('ControlGeral.php');

class ControlaVara extends ControlGeral {
	/**
	 * @param array $GET
	 */
	public function get($GET) {
		header("Location:../public/vara.php");
	}

	/**
	 * @param array $POST
	 */
	public function post($POST) {
		$vara = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$vara = new Vara();
				if($POST['funcao'] == "cadastrar")
				{
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					$codVara = (isset($POST['codVara']))?$POST['codVara']:null;
					$idComarca = (isset($POST['idComarca']))?$POST['idComarca']:null;
					if(!ProjetoUtil::verificaBrancoNulo($nome) && !ProjetoUtil::verificaBrancoNulo($codVara) && !ProjetoUtil::verificaBrancoNulo($idComarca))
					{
						$vara->setNomevara($nome);
						$vara->setCodvara($codVara);
						$vara->setIdcomarca($idComarca);
						$this->cadastrar($vara);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/vara.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idVara = (isset($POST['idVara']))?$POST['idVara']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idVara))
					{
						$vara->setIdvara($idVara);
						$this->deletar($vara);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/vara.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idVara = (isset($POST['idVara']))?$POST['idVara']:null;
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					$codVara = (isset($POST['codVara']))?$POST['codVara']:null;
					$idComarca = (isset($POST['idComarca']))?$POST['idComarca']:null; 
					if(!ProjetoUtil::verificaBrancoNulo($idVara) && !ProjetoUtil::verificaBrancoNulo($nome) && !ProjetoUtil::verificaBrancoNulo($idComarca))
					{
						$vara->setIdvara($idVara);
						$vara->setCodvara($codVara);
						$vara->setNomevara($nome);
						$vara->setIdcomarca($idComarca);
						$this->alterar($vara);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/vara.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/vara.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}

	/**
	 * @param  int $grupo
	 */
	public function permiteAcesso($grupo) {
	if($grupo == GruposUsuarios::$GRUPO_ADMIN)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function cadastrar(Vara $vara)
	{
		try {
			if($vara->getNomevara()!=null)
			{
				$vara->save();
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
	
	public function deletar(Vara $vara)
	{
		try{
			if($vara->getIdvara()!= null)
			{
				$vara->delete();
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
	
	public function alterar(Vara $vara)
	{
		try {
			if($vara->getIdvara()!= null && $vara->getNomevara()!=null)
			{
				$vara->update();
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
	

}

?>