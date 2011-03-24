<?php

require_once ('application/control/ControlGeral.php');

class ControlaNoticia extends ControlGeral {

private $arrayPessoa = array();
	
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
		$noticia = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$noticia = new Noticias();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($noticia, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($noticia);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO");
						header("Location:../public/noticiaAdm.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idnoticia = (isset($POST['idnoticia']))?$POST['idnoticia']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idnoticia))
					{
						$noticia->setIdnoticia($idnoticia);
						$this->deletar($noticia);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/noticiaAdm.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idnoticia = (isset($POST['idnoticia']))?$POST['idnoticia']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idnoticia))
					{
						$noticia->setIdnoticia($idnoticia);
					}
					$this->preencheObjeto($noticia, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($noticia);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/noticiaAdm.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/noticiaAdm.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function preencheObjeto(Noticias $noticias, $POST)
	{
		$noticias->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $noticias->validate());
	}
	
	public function cadastrar(Noticias $noticias)
	{
		try {
			$noticias->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	public function deletar(Noticias $noticias)
	{
		try {
			if($noticias->getIdnoticia() != null)
			{
				$noticias->delete();
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
	
	public function alterar(Noticias $noticias)
	{
		try
		{
			$noticias->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}

}

?>