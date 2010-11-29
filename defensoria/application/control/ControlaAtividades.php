<?php

require_once ('ControlGeral.php');

class ControlaAtividades extends ControlGeral {
	
	public function permiteAcesso($grupo) {
		return true;
	}
	
	public function get($GET) {
		header("Location:../public/atividades.php");
	}
	
	public function post($POST) {
		$atividades = null;
		try {
			$function = (isset($POST['function']))?$POST['function']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$atividades = new Atividades();
				if($POST['function'] == "cadastrar")
				{
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					if(!ProjetoUtil::verificaBrancoNulo($nome))
					{
						$atividades->setAtividades($nome);
						$this->cadastrar($atividades);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/inicio.php?page=atividades&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
				}
				elseif($POST['function'] == "deletar")
				{
					$idAtividades = (isset($POST['idAtividades']))?$POST['idAtividades']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idAtividades))
					{
						$atividades->setIdatividades($idAtividades);
						$this->deletar($atividades);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/inicio.php?page=atividades&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['function'] == "alterar")
				{
					$idAtividades = (isset($POST['idAtividades']))?$POST['idAtividades']:null;
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idAtividades) && !ProjetoUtil::verificaBrancoNulo($nome))
					{
						$atividades->setIdatividades($idAtividades);
						$atividades->setAtividades($nome);
						$this->alterar($atividades);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/inicio.php?page=atividades&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/inicio.php?page=atividades&mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}

	public function cadastrar(Atividades  $atividades)
	{
		try {
			if($atividades->getAtividades()!=null)
			{
				$atividades->save();
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
	
	public function deletar(Atividades  $atividades)
	{
		try {
			if($atividades->getIdatividades()!= null)
			{
				$atividades->delete();
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
	
	public function alterar(Atividades  $atividades)
	{
		try{
			if($atividades->getIdatividades()!= null && $atividades->getAtividades()!=null)
			{
				$atividades->update();
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