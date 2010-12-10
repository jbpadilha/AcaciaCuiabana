<?php

require_once ('ControlGeral.php');

class ControlaPessoa extends ControlGeral {
	
	public function permiteAcesso($grupo) {
		return true;
	}
	
	public function get($GET) {
		try
		{
			if(isset($GET['pesquisa']))
			{
				$pessoa = new Pessoa();
				if(isset($GET['cpfpesquisa']) && $GET['cpfpesquisa'] != "")
					$pessoa->setCpfpessoa(trim($GET['cpfpesquisa']));
				if(isset($GET['nomePesquisa']) && $GET['nomePesquisa'] != "")
					$pessoa->setNomepessoa(trim($GET['nomePesquisa']));
				
				if($pessoa->find(true))
				{
					session_start();
					$_SESSION['pessoaPesquisa'] = $pessoa->getIdpessoa(); 
				}
				else
				{
					$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("PESSOA_NAO_ENCONTRADA");
					
				}
			}
			if(count($this->MENSAGEM_ERRO)>0)
			{
				if(isset($GET['paramentrosPessoa']))
				{
					header("Location:../public/pessoa.php?cadastro=1&paramentrosPessoa={$GET['paramentrosPessoa']}
					&comarca={$GET['comarca']}&tipoAcao={$GET['tipoAcao']}
					&naturezaAcao={$GET['naturezaAcao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assunto={$GET['assunto']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}
					&nomeDefensor={$GET['nomeDefensor']}&idDefensor={$GET['idDefensor']}&tipoParte={$GET['tipoParte']}
					&MensagemErro=".urlencode(serialize(Mensagens::getMensagem("PESSOA_NAO_ENCONTRADA"))));
				}
				elseif(isset($GET['paramentrosPessoaHipo']))
				{
					header("Location:../public/hipossuficiencia.php?paramentrosPessoaHipo={$GET['paramentrosPessoaHipo']}
					&profHipo={$GET['profHipo']}&salarioHipo={$GET['salarioHipo']}
					&empresaHipo={$GET['empresaHipo']}&rendaHipo={$GET['rendaHipo']}
					&observacoesHipo={$GET['observacoesHipo']}");
				}
				else
				{
					header("Location:../public/pessoa.php?cadastro=1&MensagemErro=".urlencode(serialize(Mensagens::getMensagem("PESSOA_NAO_ENCONTRADA"))));
				}
			}
			else
			{
				if(isset($GET['paramentrosPessoa']))
				{
					header("Location:../public/pessoa.php?paramentrosPessoa={$GET['paramentrosPessoa']}
					&comarca={$GET['comarca']}&tipoAcao={$GET['tipoAcao']}
					&naturezaAcao={$GET['naturezaAcao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assunto={$GET['assunto']}&nomePromovente={$_GET['nomePromovente']}&tipoParte={$GET['tipoParte']}
					&nomeDefensor={$GET['nomeDefensor']}&idDefensor={$GET['idDefensor']}&nomePromovido={$_GET['nomePromovido']}");	
				}
				elseif(isset($GET['paramentrosPessoaHipo']))
				{
					header("Location:../public/pessoa.php?paramentrosPessoaHipo={$GET['paramentrosPessoaHipo']}
					&profHipo={$GET['profHipo']}&salarioHipo={$GET['salarioHipo']}
					&empresaHipo={$GET['empresaHipo']}&rendaHipo={$GET['rendaHipo']}
					&observacoesHipo={$GET['observacoesHipo']}");
				}
				else
				{
					header("Location:../public/pessoa.php");
				}
			}
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
			header("Location:../public/pessoa.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function post($POST) {
		$pessoa = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$pessoa = new Pessoa();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($pessoa, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($pessoa);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO");
						if(isset($POST['paramentrosPessoa']))
						{
							session_start();
							$_SESSION['pessoaPesquisa'] = $pessoa->getIdpessoa(); 
							header("Location:../public/pessoa.php?paramentrosPessoa={$POST['paramentrosPessoa']}
							&comarca={$POST['comarca']}&tipoAcao={$POST['tipoAcao']}
							&naturezaAcao={$POST['naturezaAcao']}&juizo={$POST['juizo']}
							&idpessoaPromovente={$POST['idpessoaPromovente']}&idpessoaPromovido={$POST['idpessoaPromovido']}
							&assunto={$POST['assunto']}&nomePromovente={$POST['nomePromovente']}&tipoParte={$POST['tipoParte']}
							&nomeDefensor={$POST['nomeDefensor']}&idDefensor={$POST['idDefensor']}&nomePromovido={$POST['nomePromovido']}");
						}
						else
						{
							header("Location:../public/pessoa.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
						}
					}
					else
					{
						if(isset($POST['paramentrosPessoa']))
						{
							header("Location:../public/pessoa.php?paramentrosPessoa={$POST['paramentrosPessoa']}
							&comarca={$POST['comarca']}&tipoAcao={$POST['tipoAcao']}
							&naturezaAcao={$POST['naturezaAcao']}&juizo={$POST['juizo']}
							&idpessoaPromovente={$POST['idpessoaPromovente']}&idpessoaPromovido={$POST['idpessoaPromovido']}
							&assunto={$POST['assunto']}&nomeDefensor={$$POST['nomeDefensor']}&idDefensor={$POST['idDefensor']}
							&nomePromovente={$POST['nomePromovente']}&nomePromovido={$POST['nomePromovido']}&tipoParte={$POST['tipoParte']}");
						}
						else
						{
							throw new Exception();
						}
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idPessoa = (isset($POST['idPessoa']))?$POST['idPessoa']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa))
					{
						$pessoa->setIdpessoa($idPessoa);
						$this->deletar($pessoa);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/pessoa.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idPessoa = (isset($POST['idPessoa']))?$POST['idPessoa']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa))
						$pessoa->setIdpessoa($POST['idPessoa']);
					$this->preencheObjeto($pessoa, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($pessoa);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/pessoa.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/pessoa.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function preencheObjeto(Pessoa $pessoa, $POST)
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
			
	}
	
	public function cadastrar(Pessoa $pessoa)
	{
		try {
			if($pessoa->getNomepessoa()!=null && $pessoa->getSexopessoa()!=null && $pessoa->getCpfpessoa()!=null
			&& $pessoa->getEstadocivilpessoa()!=null && $pessoa->getDatanascimentopessoa()!=null)
			{
				$pessoa->setDatacadastropessoa(date("Y-m-d H:i:s"));
				$pessoa->save();
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
	
	public function deletar(Pessoa $pessoa)
	{
		try {
			if($pessoa->getIdpessoa()!= null)
			{
				$pessoa->delete();
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
	
	public function alterar(Pessoa $pessoa)
	{
		try
		{
			if($pessoa->getNomepessoa()!=null && $pessoa->getSexopessoa()!=null && $pessoa->getCpfpessoa()!=null
			&& $pessoa->getEstadocivilpessoa()!=null && $pessoa->getDatanascimentopessoa()!=null)
			{
				$pessoa->update();
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