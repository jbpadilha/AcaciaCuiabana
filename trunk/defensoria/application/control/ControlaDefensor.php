<?php

require_once ('ControlGeral.php');

class ControlaDefensor extends ControlGeral {
	
	public function permiteAcesso($grupo) {
		return true;
	}
	
	public function get($GET) {
		try
		{
			if(isset($GET['pesquisa']))
			{
				$defensor = new Defensor();
				$pessoa = new Pessoa();
				if(isset($GET['cpfpesquisa']) && $GET['cpfpesquisa'] != "")
					$pessoa->setCpfpessoa(trim($GET['cpfpesquisa']));
				if(isset($GET['nomePesquisa']) && $GET['nomePesquisa'] != "")
					$pessoa->setNomepessoa(trim($GET['nomePesquisa']));
				if(isset($GET['oabpesquisa']) && $GET['oabpesquisa'] != "")
					$defensor->setOabdefensor(trim($GET['oabpesquisa']));
				if(isset($GET['complementoOAB']) && $GET['complementoOAB'] != "")
					$defensor->setCompoabdefensor(trim($GET['complementoOAB']));
				if(isset($GET['estadoOAB']) && $GET['estadoOAB'] != "")
					$defensor->setEstadooabdefensor(trim($GET['estadoOAB']));	
					
				if($pessoa->find(true) && $defensor->find(true))
				{
					session_start();
					$_SESSION['pessoaPesquisa'] = $pessoa->getIdpessoa(); 
					$_SESSION['defensorPesquisa'] = $defensor->getIddefensor();
				}
				else
				{
					$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("DEFENSOR_NAO_ENCONTRADA");
				}
			}
			if(count($this->MENSAGEM_ERRO)>0)
			{
				header("Location:../public/defensor.php?cadastro=1&MensagemErro=".Mensagens::getMensagem("DEFENSOR_NAO_ENCONTRADA"));
			}
			else
			{
				header("Location:../public/defensor.php");
			}
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
			header("Location:../public/defensor.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function post($POST) {
		$pessoa = null;
		$defensor = null;
		try {
			$function = (isset($POST['function']))?$POST['function']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$pessoa = new Pessoa();
				$defensor = new Defensor();
				if($POST['function'] == "cadastrar")
				{
					$this->preencheObjeto($pessoa,$defensor, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($pessoa,$defensor);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/inicio.php?page=defensor&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception();
					}
				}
				elseif($POST['function'] == "deletar")
				{
					$idPessoa = (isset($POST['idPessoa']))?$POST['idPessoa']:null;
					$idDefensor = (isset($POST['idDefensor']))?$POST['idDefensor']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa) && !ProjetoUtil::verificaBrancoNulo($idDefensor))
					{
						$pessoa->setIdpessoa($idPessoa);
						$defensor->setIddefensor($idDefensor);
						$this->deletar($pessoa,$defensor);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/inicio.php?page=defensor&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['function'] == "alterar")
				{
					$idPessoa = (isset($POST['idPessoa']))?$POST['idPessoa']:null;
					$idDefensor = (isset($POST['idDefensor']))?$POST['idDefensor']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa) && !ProjetoUtil::verificaBrancoNulo($idDefensor))
					{
						$pessoa->setIdpessoa($idPessoa);
						$defensor->setIddefensor($idDefensor);
					}
					$this->preencheObjeto($pessoa, $defensor, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($pessoa,$defensor);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/inicio.php?page=defensor&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/inicio.php?page=defensor&mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function preencheObjeto(Pessoa $pessoa, Defensor $defensor, $POST)
	{
		$pessoa->setRgpessoa((isset($POST['rg']))?$POST['rg']:null);
		$pessoa->setEmissorpessoa((isset($POST['emissor']))?$POST['emissor']:null);
		$pessoa->setApelidopessoa((isset($POST['apelido']))?$POST['apelido']:null);
		$pessoa->setNaturalidadepessoa((isset($POST['naturalidade']))?$POST['naturalidade']:null);

		$nome = (isset($POST['nomeCadastro']))?$POST['nomeCadastro']:null;
		$sexo = (isset($POST['sexo']))?$POST['sexo']:null;
		$cpf = (isset($POST['cpfCadastro']))?$POST['cpfCadastro']:null;
		$estadocivil = (isset($POST['estadocivil']))?$POST['estadocivil']:null;
		$dataNascimento = (isset($POST['datanascimento']))?$POST['datanascimento']:null;
		$oab = (isset($POST['oabCadastro']))?$POST['oabCadastro']:null;
		$complementoOab = (isset($POST['complementoOABCadastro']))?$POST['complementoOABCadastro']:null;
		$estadoOab = (isset($POST['estadoOABCadastro']))?$POST['estadoOABCadastro']:null;
		if(ProjetoUtil::verificaBrancoNulo($nome))
			$this->MENSAGEM_ERRO[] = "O nome deve ser preenchido.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$pessoa->setNomepessoa(trim($nome));
			
		if(ProjetoUtil::verificaBrancoNulo($sexo))
			$this->MENSAGEM_ERRO[] = "O sexo deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$pessoa->setSexopessoa($sexo);
		
		if(ProjetoUtil::verificaBrancoNulo($cpf))
			$this->MENSAGEM_ERRO[] = "O CPF deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$pessoa->setCpfpessoa(trim($cpf));
			
		if(ProjetoUtil::verificaBrancoNulo($estadocivil))
			$this->MENSAGEM_ERRO[] = "O Estado civil deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$pessoa->setEstadocivilpessoa($estadocivil);
		
		if(ProjetoUtil::verificaBrancoNulo($dataNascimento))
		{
			$this->MENSAGEM_ERRO[] = "A data de nascimento deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		}
		else {
			$pessoa->setDatanascimentopessoa($dataNascimento);
			$pessoa->setDatanascimentopessoa($pessoa->toDataNascimentoDB());
		}
		if (ProjetoUtil::verificaBrancoNulo($oab))
			$this->MENSAGEM_ERRO[] = "A oab deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$defensor->setOabdefensor($oab);
			
		if(ProjetoUtil::verificaBrancoNulo($complementoOab))
			$this->MENSAGEM_ERRO[] = "O complemento da oab deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$defensor->setCompoabdefensor($complementoOab);
			
		if(ProjetoUtil::verificaBrancoNulo($estadoOab))
			$this->MENSAGEM_ERRO[] = "O estado da oab deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$defensor->setEstadooabdefensor($estadoOab);
			
	}

	public function cadastrar(Pessoa $pessoa, Defensor $defensor)
	{
		try {
			if($pessoa->getNomepessoa()!=null && $pessoa->getSexopessoa()!=null && $pessoa->getCpfpessoa()!=null
			&& $pessoa->getEstadocivilpessoa()!=null && $pessoa->getDatanascimentopessoa()!=null)
			{
				$pessoa->setDatacadastropessoa(date("Y-m-d H:i:s"));
				$pessoa->save();
				
				if($defensor->getOabdefensor() != null && $defensor->getCompoabdefensor() != null
				&& $defensor->getEstadooabdefensor()!=null)
				{
					$defensor->setIdpessoa($pessoa->getIdpessoa());
					$defensor->save();
				}
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
	
	public function deletar(Pessoa $pessoa, Defensor $defensor)
	{
		try {
			if($pessoa->getIdpessoa()!= null && $defensor->getIddefensor())
			{
				$pessoa->delete();
				$defensor->delete();
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
	
	public function alterar(Pessoa $pessoa, Defensor $defensor)
	{
		try
		{
			if($pessoa->getNomepessoa()!=null && $pessoa->getSexopessoa()!=null && $pessoa->getCpfpessoa()!=null
			&& $pessoa->getEstadocivilpessoa()!=null && $pessoa->getDatanascimentopessoa()!=null)
			{
				$pessoa->update();
				if($defensor->getOabdefensor() != null && $defensor->getCompoabdefensor() != null
				&& $defensor->getEstadooabdefensor()!=null)
				{
					$defensor->update();
				}
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