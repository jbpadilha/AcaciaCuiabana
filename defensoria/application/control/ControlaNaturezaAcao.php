<?php

require_once ('control\ControlGeral.php');

class ControlaNaturezaAcao extends ControlGeral {
	
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
		header("Location:../public/naturezaAcao.php");
	}
	
	public function post($POST) {
		$naturezaAcao = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$naturezaAcao = new NaturezaAcao();
				if($POST['funcao'] == "cadastrar")
				{
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					if(!ProjetoUtil::verificaBrancoNulo($nome))
					{
						$naturezaAcao->setNaturezaacao($nome);
						$this->cadastrar($naturezaAcao);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/naturezaAcao.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idNaturezaAcao = (isset($POST['idNaturezaAcao']))?$POST['idNaturezaAcao']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idNaturezaAcao))
					{
						$naturezaAcao->setIdnaturezaacao($idNaturezaAcao);
						$this->deletar($naturezaAcao);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/naturezaAcao.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idNaturezaAcao = (isset($POST['idNaturezaAcao']))?$POST['idNaturezaAcao']:null;
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idNaturezaAcao) && !ProjetoUtil::verificaBrancoNulo($nome))
					{
						$naturezaAcao->setIdnaturezaacao($idNaturezaAcao);
						$naturezaAcao->setNaturezaacao($nome);
						$this->alterar($naturezaAcao);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/naturezaAcao.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/naturezaAcao.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function cadastrar(NaturezaAcao $naturezaAcao)
	{
		try {
			if($naturezaAcao->getNaturezaacao()!=null)
			{
				$naturezaAcao->save();
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
	
	public function deletar(NaturezaAcao $naturezaAcao)
	{
		try{
			if($naturezaAcao->getIdnaturezaacao()!= null)
			{
				$naturezaAcao->delete();
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
	
	public function alterar(NaturezaAcao $naturezaAcao)
	{
		try{
			if($naturezaAcao->getIdnaturezaacao()!= null && $naturezaAcao->getNaturezaacao()!=null)
			{
				$naturezaAcao->update();
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