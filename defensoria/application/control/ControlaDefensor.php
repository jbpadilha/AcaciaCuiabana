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
				$this->gravaUsuarioSessao($pessoa,$defensor);
			}
			if(count($this->MENSAGEM_ERRO)>0)
			{
				if(isset($GET['paramentrosDefensor']))
				{
					header("Location:../public/defensor.php?paramentrosDefensor={$GET['paramentrosDefensor']}
					&comarca={$GET['comarca']}&tipoAcao={$GET['tipoAcao']}
					&naturezaAcao={$GET['naturezaAcao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assunto={$GET['assunto']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}&MensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
				}
				else{
					header("Location:../public/defensor.php?cadastro=1&MensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
				}
			}
			else
			{
				if(isset($GET['paramentrosDefensor']))
				{
					header("Location:../public/defensor.php?paramentrosDefensor={$GET['paramentrosDefensor']}
					&comarca={$GET['comarca']}&tipoAcao={$GET['tipoAcao']}
					&naturezaAcao={$GET['naturezaAcao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assunto={$GET['assunto']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}");
				}
				else
				{
					header("Location:../public/defensor.php");
				}
			}
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
			if(isset($GET['paramentrosDefensor']))
			{
				header("Location:../public/defensor.php?paramentrosDefensor={$GET['paramentrosDefensor']}
					&comarca={$GET['comarca']}&tipoAcao={$GET['tipoAcao']}
					&naturezaAcao={$GET['naturezaAcao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assunto={$GET['assunto']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}&mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
			}
			else {
				header("Location:../public/defensor.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
			}
		}
	}
	
	public function post($POST) {
		$pessoa = null;
		$defensor = null;
		$usuario = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$pessoa = new Pessoa();
				$defensor = new Defensor();
				$usuarios = new Usuarios();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($pessoa,$defensor, $usuarios, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($pessoa,$defensor, $usuarios);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/defensor.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idPessoa = (isset($POST['idPessoa']))?$POST['idPessoa']:null;
					$idDefensor = (isset($POST['idDefensor']))?$POST['idDefensor']:null;
					$idUsuario = (isset($POST['idUsuario']))?$POST['idUsuario']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa) && !ProjetoUtil::verificaBrancoNulo($idDefensor) && !ProjetoUtil::verificaBrancoNulo($idUsuario))
					{
						$pessoa->setIdpessoa($idPessoa);
						$defensor->setIddefensor($idDefensor);
						$usuarios->setIdusuario($idUsuario);
						$this->deletar($pessoa,$defensor, $usuarios);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/defensor.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("CAMPO_OBRIGATORIO");
					}
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idPessoa = (isset($POST['idPessoa']))?$POST['idPessoa']:null;
					$idDefensor = (isset($POST['idDefensor']))?$POST['idDefensor']:null;
					$idUsuario = (isset($POST['idUsuario']))?$POST['idUsuario']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa) && !ProjetoUtil::verificaBrancoNulo($idDefensor) && !ProjetoUtil::verificaBrancoNulo($idUsuario))
					{
						$pessoa->setIdpessoa($idPessoa);
						$defensor->setIddefensor($idDefensor);
						$usuarios->setIdusuario($idUsuario);
					}
					$this->preencheObjeto($pessoa, $defensor, $usuarios, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($pessoa,$defensor, $usuarios);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/defensor.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
				}
				
				if(count($this->MENSAGEM_ERRO)>0)
				{
					header("Location:../public/defensor.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
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
			header("Location:../public/defensor.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function preencheObjeto(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios, $POST)
	{
		$pessoa->setRgpessoa((isset($POST['rg']))?$POST['rg']:null);
		$pessoa->setEmissorpessoa((isset($POST['emissor']))?$POST['emissor']:null);
		$pessoa->setApelidopessoa((isset($POST['apelido']))?$POST['apelido']:null);
		$pessoa->setNaturalidadepessoa((isset($POST['naturalidade']))?$POST['naturalidade']:null);
		
		$usuarios->setSenha((isset($POST['senha']) && $POST['senha'] != null)?$POST['senha']:null);
		
		$nome = (isset($POST['nomeCadastro']))?$POST['nomeCadastro']:null;
		$sexo = (isset($POST['sexo']))?$POST['sexo']:null;
		$cpf = (isset($POST['cpfCadastro']))?$POST['cpfCadastro']:null;
		$estadocivil = (isset($POST['estadocivil']))?$POST['estadocivil']:null;
		$dataNascimento = (isset($POST['datanascimento']))?$POST['datanascimento']:null;
		$oab = (isset($POST['oabCadastro']))?$POST['oabCadastro']:null;
		$complementoOab = (isset($POST['complementoOABCadastro']))?$POST['complementoOABCadastro']:null;
		$estadoOab = (isset($POST['estadoOABCadastro']))?$POST['estadoOABCadastro']:null;
		
		$usuario = (isset($POST['usuario']))?$POST['usuario']:null;
		$senha = (isset($POST['senha']))?$POST['senha']:null;
		
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

		if(ProjetoUtil::verificaBrancoNulo($usuario))
			$this->MENSAGEM_ERRO[] = "O usuário deve ser informado.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$usuarios->setUsuario($usuario);
		
	}

	public function cadastrar(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios)
	{
		try {
			if($pessoa->getNomepessoa()!=null && $pessoa->getSexopessoa()!=null && $pessoa->getCpfpessoa()!=null
			&& $pessoa->getEstadocivilpessoa()!=null && $pessoa->getDatanascimentopessoa()!=null)
			{
				$pessoaPesquisa = new Pessoa();
				$pessoaPesquisa->setCpfpessoa($pessoa->getCpfpessoa());
				if(!$pessoaPesquisa->find(true))
				{
					$pessoa->setDatacadastropessoa(date("Y-m-d H:i:s"));
					$pessoa->save();
					
					if($defensor->getOabdefensor() != null && $defensor->getCompoabdefensor() != null
					&& $defensor->getEstadooabdefensor()!=null)
					{
						$defensor->setIdpessoa($pessoa->getIdpessoa());
						$defensor->save();
						
						if($usuarios->getUsuario() != null && $usuarios->getSenha() != null)
						{
							$usuarioPesquisa = new Usuarios();
							$usuarioPesquisa->setUsuario($usuarios->getUsuario());
							if(!$usuarioPesquisa->find(true))
							{
								$usuarios->save();
							}
							else
							{
								throw new Exception(Mensagens::getMensagem("ERRO_USUARIO_EXISTENTE"));
							}
						}
					}
				}
				else
				{
					throw new Exception(Mensagens::getMensagem("ERRO_USUARIO_EXISTENTE"));
				}
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
	
	public function deletar(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios)
	{
		try {
			if($pessoa->getIdpessoa()!= null && $defensor->getIddefensor() && $usuarios->getIdusuario())
			{
				$pessoa->delete();
				$defensor->delete();
				$usuarios->delete();
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
	
	public function alterar(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios)
	{
		try
		{
			if($pessoa->getNomepessoa()!=null && $pessoa->getSexopessoa()!=null && $pessoa->getCpfpessoa()!=null
			&& $pessoa->getEstadocivilpessoa()!=null && $pessoa->getDatanascimentopessoa()!=null)
			{
				$pessoaPesquisa = new Pessoa();
				$pessoaPesquisa->setCpfpessoa($pessoa->getCpfpessoa());
				$pessoaPesquisa->find(true);
				if($pessoaPesquisa->getIdpessoa() == $pessoa->getIdpessoa())
				{
					$pessoa->update();
					if($defensor->getOabdefensor() != null && $defensor->getCompoabdefensor() != null
					&& $defensor->getEstadooabdefensor()!=null)
					{
						$defensor->update();
						$usuarioPesquisa = new Usuarios();
						$usuarioPesquisa->setUsuario($usuarios->getUsuario());
						$usuarioPesquisa->find(true);
						if($usuarioPesquisa->getIdpessoa() == $usuarios->getIdpessoa())
						{
							if($usuarios->getUsuario() != $usuarioPesquisa->getUsuario() 
								|| $usuarios->getSenha() != $usuarioPesquisa->getSenha())
							{
								$usuarios->update();
							}
						}
						else
						{
							throw new Exception(Mensagens::getMensagem("ERRO_USUARIO_EXISTENTE"));
						}
					}
				}
				else
				{
					throw new Exception(Mensagens::getMensagem("ERRO_USUARIO_EXISTENTE"));
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
	
	private function gravaUsuarioSessao(Pessoa $pessoa, Defensor $defensor)
	{
		$gravaSessao = false;
		$usuarios = new Usuarios();
		try
		{
			if($pessoa->getCpfpessoa()!=null || $pessoa->getNomepessoa()!=null)
			{
				if($pessoa->find(true))
				{
					$defensor->setIdpessoa($pessoa->getIdpessoa());
					$usuarios->setIdpessoa($pessoa->getIdpessoa());
					if($defensor->find(true) && $usuarios->find(true))
					{
						$gravaSessao = true;
					}
				}
			}else if($defensor->getOabdefensor() != null ||	$defensor->getCompoabdefensor() != null ||
				$defensor->getEstadooabdefensor() != null){
					
				if($defensor->find(true))
				{
					$pessoa->setIdpessoa($defensor->getIdpessoa());
					$usuarios->setIdpessoa($pessoa->getIdpessoa());
					if($pessoa->find(true) && $usuarios->find(true))
					{
						$gravaSessao = true;
					}
				}
			}
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
		}
		if($gravaSessao)
		{
			session_start();
			$_SESSION['pessoaPesquisa'] = $pessoa->getIdpessoa(); 
			$_SESSION['defensorPesquisa'] = $defensor->getIddefensor();
			$_SESSION['usuarioPesquisa'] = $usuarios->getIdusuario();
		}
		else
		{
			$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("DEFENSOR_NAO_ENCONTRADO");
		}
	}
	
}

?>