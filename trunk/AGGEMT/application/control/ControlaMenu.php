<?php

require_once ('ControlGeral.php');

class ControlaMenu extends ControlGeral {
	
	public function post($POST) {
		$menu = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$menu = new Menu();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($menu, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($menu);						
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
					$idmenu = (isset($POST['idmenu']))?$POST['idmenu']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idmenu))
					{
						$menu->setIdmenu($idmenu);
						$this->deletar($agenda);
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
					$idmenu = (isset($POST['idmenu']))?$POST['idmenu']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idmenu))
					{
						$menu->setIdmenu($idmenu);
					}
					$this->preencheObjeto($menu, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($menu);
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
		if($grupo == GruposUsuarios::$GRUPO_ADMIN)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function preencheObjeto(Menu $menu, $POST)
	{
		$menu->_setFrom($POST);
		if($menu->getIdpagina()=="")
			$menu->setIdpagina(null);	
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $menu->validate());
	}
	
	public function cadastrar(Menu $menu)
	{
		try {
			$menu->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Menu $menu)
	{
		try {
			if($menu->getIdmenu() != null)
			{
				$menu->delete();
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
	
	public function alterar(Menu $menu)
	{
		try
		{
			$menu->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
}

?>