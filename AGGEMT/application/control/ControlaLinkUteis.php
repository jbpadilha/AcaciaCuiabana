<?php

require_once ('ControlGeral.php');

class ControlaLinkUteis extends ControlGeral {
	
	public function post($POST) {
		$linksUteis = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$linksUteis = new Linksuteis();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($linksUteis, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($linksUteis);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO");
						header("Location:../public/admin/conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception();
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idlinksuteis = (isset($POST['idlinksuteis']))?$POST['idlinksuteis']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idlinksuteis))
					{
						$linksUteis->setIdlinksuteis($idlinksuteis);
						$this->deletar($linksUteis);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/admin/conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idlinksuteis = (isset($POST['idlinksuteis']))?$POST['idlinksuteis']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idagenda))
					{
						$linksUteis->setIdlinksuteis($idlinksuteis);
					}
					$this->preencheObjeto($linksUteis, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($linksUteis);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/admin/conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception();
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
			header("Location:".PROJETO_CONTEXT."public/admin/conteudoInicial.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function get($GET) {
	
	}
	
	public function permiteAcesso($grupo) {
		return true;
	}
	
	private function preencheObjeto(Linksuteis $linksUteis, $POST)
	{
		$linksUteis->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $linksUteis->validate());
	}
	
	public function cadastrar(Linksuteis $linksUteis)
	{
		try {
			$linksUteis->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Linksuteis $linksUteis)
	{
		try {
			if($linksUteis->getIdlinksuteis() != null)
			{
				$linksUteis->delete();
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));	
			}
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function alterar(Linksuteis $linksUteis)
	{
		try
		{
			$linksUteis->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
}

?>