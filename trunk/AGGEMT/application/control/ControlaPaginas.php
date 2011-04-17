<?php
require_once ('ControlGeral.php');
class ControlaPaginas extends ControlGeral {
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
		
	}
	
	public function post($POST) {
		$paginas = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$paginas = new Paginas();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($paginas, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($paginas);						
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
					$idpagina = (isset($POST['idpagina']))?$POST['idpagina']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idpagina))
					{
						$paginas->setIdpagina($idpagina);
						$this->deletar($paginas);
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
					$idpagina = (isset($POST['idpagina']))?$POST['idpagina']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idpagina))
					{
						$paginas->setIdpagina($idpagina);
					}
					$this->preencheObjeto($paginas, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($paginas);
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
			header("Location:../../public/admin/conteudoInicial.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function preencheObjeto(Paginas $paginas, $POST, $FILES)
	{
		$paginas->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $paginas->validate());
	}
	
	public function cadastrar(Paginas $paginas)
	{
		try {
			$paginas->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Paginas $paginas)
	{
		try {
			if($paginas->getIdpagina() != null)
			{
				$paginas->delete();
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
	
	public function alterar(Paginas $paginas)
	{
		try
		{
			$paginas->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
}

?>