<?php

require_once ('ControlGeral.php');

class ControlaAgenda extends ControlGeral {
	
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
				$agenda = new Agenda();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($agenda, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($agenda);						
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
					$idagenda = (isset($POST['idagenda']))?$POST['idagenda']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idagenda))
					{
						$agenda->setIdagenda($idagenda);
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
					$idagenda = (isset($POST['idagenda']))?$POST['idagenda']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idagenda))
					{
						$agenda->setIdagenda($idagenda);
					}
					$this->preencheObjeto($agenda, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($agenda);
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
	
	private function preencheObjeto(Agenda $agenda, $POST)
	{
		$agenda->_setFrom($POST);
		$agenda->setDataagenda($agenda->toDataAgendaDB());
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $agenda->validate());
	}
	
	public function cadastrar(Agenda $agenda)
	{
		try {
			$agenda->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Agenda $agenda)
	{
		try {
			if($agenda->getIdagenda() != null)
			{
				$agenda->delete();
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
	
	public function alterar(Agenda $agenda)
	{
		try
		{
			$agenda->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
}

?>