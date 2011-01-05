<?php

require_once ('control\ControlGeral.php');

class ControlaProcessos extends ControlGeral {
	
	private $arrayProcesso = array();
	
	public function permiteAcesso($grupo) {
		if($grupo == GruposUsuarios::$GRUPO_ADMIN || $grupo == GruposUsuarios::$GRUPO_DEFENSOR)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function get($GET) {
		if(isset($GET['pesquisa']))
		{
			$pessoa = new Pessoa();
			$processo = new Processo();
			if(isset($GET['nomePesquisa']))
				$pessoa->where("nomepessoa like '%".trim($GET['nomePesquisa'])."%'");
			if(isset($GET['cpfpesquisa']))
				$pessoa->setCpfpessoa($GET['cpfpesquisa']);
			if(isset($GET['numeroprocessoPesquisa']))
				$processo->setNumeroprocesso($GET['numeroprocessoPesquisa']);
			if($pessoa->getCpfpessoa() != null || isset($GET['nomePesquisa']))
			{
				if($pessoa->find())
				{
					while($pessoa->fetch())
					{
						if(!$pessoa->isUsuario() && !$pessoa->isDefensor())
						{	
							$parteProcesso = new ParteProcesso();
							$parteProcesso->setIdpessoa($pessoa->getIdpessoa());
							$parteProcesso->whereAdd("iddefensor is not null");
							if($parteProcesso->find(true))
								$arrayProcesso[] =  $parteProcesso->getIdprocesso();
						}
					}
				}
			}
			elseif($processo->getNumeroprocesso() != null)
			{
				if($processo->find())
				{
					while($processo->fetch())
					{
						$arrayProcesso[] = $processo->getIdprocesso(); 
					}
				}
			}

			if(count($arrayProcesso)>0)
			{
				session_start();
				$_SESSION['processoPesquisa'] = $arrayProcesso;
			}
			else
			{
				$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("PROCESSO_NAO_ENCONTRADO");
			}
		}
		$complemento = "";
		if(count($this->MENSAGEM_ERRO)>0)
		{
			$complemento = "?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO));
		}
		header("Location:../public/processos.php".$complemento);	
		
	}
	
	public function post($POST) {
		$processo = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$processo = new Processo();
				if($POST['funcao'] == "Analisar")
				{
					$this->preencheObjeto($processo,$POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($processo);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ANALISAR_PROCESSO"); 
						header("Location:../public/processos.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception();
					}
				}
				elseif ($POST['funcao'] == "Alterar")
				{
					$this->preencheObjeto($processo,$POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($processo);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/processos.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/entrevista.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function preencheObjeto(Processo $processo, $POST)
	{
		$processo->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $processo->validate());
		if($processo->getNumeroprocesso()==null)
			$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("NUMERO_PROCESSO_OBRIGATORIO");
	}
	
	private function alterar(Processo $processo)
	{
		try
		{
			$processo->update();
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
		}
	}
}

?>