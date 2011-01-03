	<?php

require_once ('ControlGeral.php');

class ControlaDefensor extends ControlGeral {
	
	private $arrayDefensor = array();
	
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
		try
		{
			if(isset($GET['pesquisa']))
			{
				$defensor = new Defensor();
				$pessoa = new Pessoa();
				
				if(isset($GET['cpfPesquisa']) && $GET['cpfPesquisa'] != "")
					$pessoa->setCpfpessoa(trim($GET['cpfPesquisa']));
				if(isset($GET['nomePesquisa']) && $GET['nomePesquisa'] != "")
				{
					$pessoa->where("nomepessoa like '%".trim($GET['nomePesquisa'])."%'");
					$pessoa->setNomepessoa(trim($GET['nomePesquisa']));
				}
				if(isset($GET['oabpesquisa']) && $GET['oabpesquisa'] != "")
					$defensor->setOabdefensor(trim($GET['oabpesquisa']));
				if(isset($GET['complementoOAB']) && $GET['complementoOAB'] != "")
					$defensor->setCompoabdefensor(trim($GET['complementoOAB']));
				if(isset($GET['estadoOAB']) && $GET['estadoOAB'] != "")
					$defensor->setEstadooabdefensor(trim($GET['estadoOAB']));
				$this->pesquisaDefensor($pessoa,$defensor);
			}
			if(count($this->MENSAGEM_ERRO)>0)
			{
				if(isset($GET['paramentrosDefensor']))
				{
					header("Location:../public/defensor.php?paramentrosDefensor={$GET['paramentrosDefensor']}
					&idcomarca={$GET['idcomarca']}&idtipoacao={$GET['idtipoacao']}
					&idnaturezaacao={$GET['idnaturezaacao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assuntoentrevista={$GET['assuntoentrevista']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}&MensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
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
					&idcomarca={$GET['idcomarca']}&idtipoacao={$GET['idtipoacao']}
					&idnaturezaacao={$GET['idnaturezaacao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assuntoentrevista={$GET['assuntoentrevista']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}");
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
					&idcomarca={$GET['idcomarca']}&idtipoacao={$GET['idtipoacao']}
					&idnaturezaacao={$GET['idnaturezaacao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assuntoentrevista={$GET['assuntoentrevista']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}&mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
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
				$endereco = new Endereco();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($pessoa,$defensor, $usuarios, $endereco, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($pessoa,$defensor, $usuarios, $endereco);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/defensor.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idPessoa = (isset($POST['idpessoa']))?$POST['idpessoa']:null;
					$idDefensor = (isset($POST['iddefensor']))?$POST['iddefensor']:null;
					$idUsuario = (isset($POST['idusuario']))?$POST['idusuario']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa) && !ProjetoUtil::verificaBrancoNulo($idDefensor) && !ProjetoUtil::verificaBrancoNulo($idUsuario))
					{
						$pessoa->setIdpessoa($idPessoa);
						$defensor->setIddefensor($idDefensor);
						$usuarios->setIdusuario($idUsuario);
						$endereco->setIdpessoa($idPessoa);
						$endereco->find(true);
						$this->deletar($pessoa,$defensor, $usuarios, $endereco);
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
					$idPessoa = (isset($POST['idpessoa']))?$POST['idpessoa']:null;
					$idDefensor = (isset($POST['iddefensor']))?$POST['iddefensor']:null;
					$idUsuario = (isset($POST['idusuario']))?$POST['idusuario']:null;
					$idEndereco = (isset($POST['idendereco'])?$POST['idendereco']:null);
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa) && !ProjetoUtil::verificaBrancoNulo($idDefensor) && !ProjetoUtil::verificaBrancoNulo($idUsuario) && !ProjetoUtil::verificaBrancoNulo($idEndereco))
					{
						$pessoa->setIdpessoa($idPessoa);
						$defensor->setIddefensor($idDefensor);
						$usuarios->setIdusuario($idUsuario);
						$endereco->setIdendereco($idEndereco);
					}
					$this->preencheObjeto($pessoa, $defensor, $usuarios, $endereco, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($pessoa,$defensor, $usuarios, $endereco);
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
	
	private function preencheObjeto(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios, Endereco $endereco, $POST)
	{
		$pessoa->_setFrom($POST);
		$endereco->_setFrom($POST);
		$defensor->_setFrom($POST);
		$usuarios->setGrupousuario(GruposUsuarios::$GRUPO_DEFENSOR);
		$usuarios->_setFrom($POST);
		
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO,$pessoa->validate(),$defensor->validate(),$usuarios->validate(), $endereco->validate());
	}

	public function cadastrar(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios, Endereco $endereco)
	{
		try {
				$pessoaPesquisa = new Pessoa();
				$usuarioPesquisa = new Usuarios();
				$pessoaPesquisa->setCpfpessoa($pessoa->getCpfpessoa());
				$usuarioPesquisa->setUsuario($usuarios->getUsuario());
				if(!$pessoaPesquisa->find() && !$usuarioPesquisa->find())
				{
					$pessoa->setDatanascimentopessoa($pessoa->toDataNascimentoDB());
					$pessoa->setDatacadastropessoa(date("Y-m-d H:i:s"));
					$pessoa->save();
					$defensor->setIdpessoa($pessoa->getIdpessoa());
					$defensor->save();
					$usuarios->setIdpessoa($pessoa->getIdpessoa());
					$usuarios->save();
					$endereco->setIdpessoa($pessoa->getIdpessoa());
					$endereco->save();
				}
				else
				{
					throw new Exception(Mensagens::getMensagem("ERRO_USUARIO_EXISTENTE"));
				}
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios, Endereco $endereco)
	{
		try {
			if($pessoa->getIdpessoa()!= null && $defensor->getIddefensor() && $usuarios->getIdusuario())
			{
				$usuarios->delete();
				$defensor->delete();
				$endereco->delete();
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
	
	public function alterar(Pessoa $pessoa, Defensor $defensor, Usuarios $usuarios, Endereco $endereco)
	{
		try
		{
			$pessoaPesquisa = new Pessoa();
			$pessoaPesquisa->setCpfpessoa($pessoa->getCpfpessoa());
			$pessoaPesquisa->find(true);
			if($pessoaPesquisa->getIdpessoa() == $pessoa->getIdpessoa())
			{
				$usuarioPesquisa = new Usuarios();
				$usuarioPesquisa->setUsuario($usuarios->getUsuario());
				$usuarioPesquisa->find(true);
				if($usuarioPesquisa->getIdpessoa() == $usuarios->getIdpessoa())
				{
					if($usuarios->getUsuario() != $usuarioPesquisa->getUsuario() 
						|| $usuarios->getSenha() != $usuarioPesquisa->getSenha())
					{
						$pessoa->update();
						$endereco->update();
						$defensor->update();
						$usuarios->update();
					}
				}
				else
				{
					throw new Exception(Mensagens::getMensagem("ERRO_USUARIO_EXISTENTE"));
				}
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("ERRO_USUARIO_EXISTENTE"));
			}
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	private function pesquisaDefensor(Pessoa $pessoa, Defensor $defensor)
	{
		$usuarios = new Usuarios();
		try
		{
			if($pessoa->getCpfpessoa()!=null || $pessoa->getNomepessoa()!=null)
			{
				$pessoa->setNomepessoa(null);
				if($pessoa->find())
				{
					while($pessoa->fetch())
					{
						$defensor->setIdpessoa($pessoa->getIdpessoa());
						$usuarios->setIdpessoa($pessoa->getIdpessoa());
						if($defensor->find(true) && $usuarios->find(true))
						{
							$this->arrayDefensor[]=$defensor->getIddefensor();
						}
					}
				}
			}else if($defensor->getOabdefensor() != null ||	$defensor->getCompoabdefensor() != null ||
				$defensor->getEstadooabdefensor() != null){
					
				if($defensor->find())
				{
					while($defensor->fetch())
					{
						$pessoa->setIdpessoa($defensor->getIdpessoa());
						$usuarios->setIdpessoa($pessoa->getIdpessoa());
						if($pessoa->find(true) && $usuarios->find(true))
						{
							$this->arrayDefensor[]=$defensor->getIddefensor();
						}
					}
				}
			}
			
			if( count($this->arrayDefensor) > 0)
			{
				session_start();
				$_SESSION['defensorPesquisa'] = $this->arrayDefensor;
			}
			else
			{
				$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("DEFENSOR_NAO_ENCONTRADO");
			}
			
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
		}
		
	}
	
}

?>