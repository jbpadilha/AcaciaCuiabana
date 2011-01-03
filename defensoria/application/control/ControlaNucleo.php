<?php

require_once ('control\ControlGeral.php');

class ControlaNucleo extends ControlGeral {
	
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
	
	public function get($GET) {
		header("Location:../public/nucleo.php");
	}	
	
	public function post($POST) {
		$nucleo = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$nucleo = new Nucleo();
				if($POST['funcao'] == "cadastrar")
				{
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					$idComarca = (isset($POST['idComarca']))?$POST['idComarca']:null;
					if(!ProjetoUtil::verificaBrancoNulo($nome) && !ProjetoUtil::verificaBrancoNulo($idComarca))
					{
						$nucleo->setNomenucleo($nome);
						$nucleo->setIdcomarca($idComarca);
						$this->cadastrar($nucleo);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/nucleo.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idNucleo = (isset($POST['idNucleo']))?$POST['idNucleo']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idNucleo))
					{
						$nucleo->setIdnucleo($idNucleo);
						$this->deletar($nucleo);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/nucleo.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idNucleo = (isset($POST['idNucleo']))?$POST['idNucleo']:null;
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					$idComarca = (isset($POST['idComarca']))?$POST['idComarca']:null; 
					if(!ProjetoUtil::verificaBrancoNulo($idNucleo) && !ProjetoUtil::verificaBrancoNulo($nome) && !ProjetoUtil::verificaBrancoNulo($idComarca))
					{
						$nucleo->setIdnucleo($idNucleo);
						$nucleo->setNomenucleo($nome);
						$nucleo->setIdcomarca($idComarca);
						$this->alterar($nucleo);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/nucleo.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/nucleo.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}

	public function cadastrar(Nucleo $nucleo)
	{
		try {
			if($nucleo->getNomenucleo()!=null && $nucleo->getIdcomarca())
			{
				$nucleo->save();
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
	
	public function deletar(Nucleo $nucleo)
	{
		try{
			if($nucleo->getIdnucleo()!= null)
			{
				$nucleo->delete();
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
	
	public function alterar(Nucleo $nucleo)
	{
		try {
			if($nucleo->getIdnucleo()!= null && $nucleo->getIdcomarca()!=null)
			{
				$nucleo->update();
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