<?php

require_once ('ControlGeral.php');

class ControlaTipoAcao extends ControlGeral {
	
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
		header("Location:../public/tipoacao.php");
	}
	
	public function post($POST) {
		$tipoAcao = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$tipoAcao = new TipoAcao();
				if($POST['funcao'] == "cadastrar")
				{
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					if(!ProjetoUtil::verificaBrancoNulo($nome))
					{
						$tipoAcao->setTipoacao($POST['nome']);
						$this->cadastrar($tipoAcao);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/tipoacao.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idTipoAcao = (isset($POST['idTipoAcao']))?$POST['idTipoAcao']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idTipoAcao))
					{
						$tipoAcao->setIdtipoacao($idTipoAcao);
						$this->deletar($tipoAcao);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/tipoacao.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idTipoAcao = (isset($POST['idTipoAcao']))?$POST['idTipoAcao']:null;
					$nome = (isset($POST['nome']))?$POST['nome']:null; 
					if(!ProjetoUtil::verificaBrancoNulo($idTipoAcao) && !ProjetoUtil::verificaBrancoNulo($nome))
					{
						$tipoAcao->setIdtipoacao($idTipoAcao);
						$tipoAcao->setTipoacao($nome);
						$this->alterar($tipoAcao);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/tipoacao.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/tipoacao.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	
	public function cadastrar(TipoAcao $tipoAcao)
	{
		try {
			if($tipoAcao->getTipoacao() != null)
			{
				$tipoAcao->save();
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
	
	public function deletar(TipoAcao $tipoAcao)
	{
		try {
			if($tipoAcao->getIdtipoacao() != null)
			{
				$tipoAcao->delete();
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
	
	public function alterar(TipoAcao $tipoAcao)
	{
		try
		{
			if($tipoAcao->getIdtipoacao()!= null && $tipoAcao->getTipoacao() != null)
			{
				$tipoAcao->update();
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