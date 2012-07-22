<?php

require_once ('ControlGeral.php');

class ControlaTabelaPrincipal extends ControlGeral {

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
		$tabelaPrincipal = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$tabelaPrincipal = new TabelaPrincipal();
				if($POST['funcao'] == "alterar")
				{
					$idTabelaPrincipal = (isset($POST['idTabelaPrincipal']))?$POST['idTabelaPrincipal']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idTabelaPrincipal))
					{
						$tabelaPrincipal->setIdTabelaPrincipal($idTabelaPrincipal);
					}
					$this->preencheObjeto($tabelaPrincipal, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($tabelaPrincipal);
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
	
	private function preencheObjeto(TabelaPrincipal $tabelaPrincipal, $POST)
	{
		$tabelaPrincipal->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $tabelaPrincipal->validate());
	}
	
	public function cadastrar(TabelaPrincipal $tabelaPrincipal)
	{
		try {
			$tabelaPrincipal->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(TabelaPrincipal $tabelaPrincipal)
	{
		try {
			if($tabelaPrincipal->getIdTabelaPrincipal() != null)
			{
				$tabelaPrincipal->delete();
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
	
	public function alterar(TabelaPrincipal $tabelaPrincipal)
	{
		try
		{
			$tabelaPrincipal->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
}

?>