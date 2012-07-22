<?php

require_once ('ControlGeral.php');

class ControlaCuriosidades extends ControlGeral {

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
		$agenda = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$curiosidades = new Curiosidades();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($curiosidades, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($curiosidades);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO");
						header("Location:conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception();
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idCursiosidades = (isset($POST['idCursiosidades']))?$POST['idCursiosidades']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idCursiosidades))
					{
						$curiosidades->setIdCuriosidades($idCursiosidades);
						$this->deletar($idCursiosidades);
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
					$idagenda = (isset($POST['idCursiosidades']))?$POST['idCursiosidades']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idCursiosidades))
					{
						$curiosidades->setIdCuriosidades($idCursiosidades);
					}
					$this->preencheObjeto($curiosidades, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($curiosidades);
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
	
	private function preencheObjeto(Curiosidades $curiosidades, $POST)
	{
		$curiosidades->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $curiosidades->validate());
	}
	
	public function cadastrar(Curiosidades $curiosidades)
	{
		try {
			$curiosidades->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Curiosidades $curiosidades)
	{
		try {
			if($curiosidades->getIdCuriosidades() != null)
			{
				$curiosidades->delete();
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
	
	public function alterar(Curiosidades $curiosidades)
	{
		try
		{
			$curiosidades->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
}

?>