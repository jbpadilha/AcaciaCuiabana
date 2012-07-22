<?php

require_once ('ControlGeral.php');

class ControlaSubMenu extends ControlGeral {
	
	public function post($POST) {
		$submenu = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$submenu = new Submenus();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($submenu, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($submenu);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO");
						header("Location:".PROJETO_CONTEXT."public/admin/conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception();
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idsubmenu = (isset($POST['idsubmenu']))?$POST['idsubmenu']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idsubmenu))
					{
						$submenu->setIdsubmenu($idsubmenu);
						$this->deletar($submenu);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:".PROJETO_CONTEXT."public/admin/conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idsubmenu = (isset($POST['idsubmenu']))?$POST['idsubmenu']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idsubmenu))
					{
						$submenu->setIdsubmenu($idsubmenu);
					}
					$this->preencheObjeto($submenu, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($submenu);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:".PROJETO_CONTEXT."public/admin/conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			echo $e->getMessage();
			//header("Location:".PROJETO_CONTEXT."public/admin/conteudoInicial.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function get($GET) {
	
	}
	
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
	
	private function preencheObjeto(Submenus $submenu, $POST)
	{
		$submenu->_setFrom($POST);
		if($submenu->getIdPagina() == "")
			$submenu->setIdPagina(null);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $submenu->validate());
	}
	
	public function cadastrar(Submenus $submenu)
	{
		try {
			$submenu->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Submenus $submenu)
	{
		try {
			if($submenu->getIdsubmenu() != null)
			{
				$submenu->delete();
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
	
	public function alterar(Submenus $submenu)
	{
		try
		{
			$submenu->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
}

?>