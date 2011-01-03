<?php

require_once ('ControlGeral.php');

class ControlaPessoa extends ControlGeral {
	
	private $arrayPessoa = array();
	
	public function permiteAcesso($grupo) {
		if($grupo == GruposUsuarios::$GRUPO_ADMIN || $grupo == GruposUsuarios::$GRUPO_ATENDENTE
		|| $grupo == GruposUsuarios::$GRUPO_DEFENSOR || $grupo == GruposUsuarios::$GRUPO_ESTAGIARIO)
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
				$pessoa = new Pessoa();
				if(isset($GET['cpfPesquisa']) && $GET['cpfPesquisa'] != "")
					$pessoa->setCpfpessoa(trim($GET['cpfPesquisa']));
				if(isset($GET['nomePesquisa']) && $GET['nomePesquisa'] != "")
				{
					$pessoa->where("nomepessoa like '%".trim($GET['nomePesquisa'])."%'");
				}
				if($pessoa->find())
				{
					while($pessoa->fetch())
					{
						if(!$pessoa->isUsuario() && !$pessoa->isDefensor())
							$arrayPessoa[] =  $pessoa->getIdpessoa();
					}
					if(count($arrayPessoa)>0)
					{
						session_start();
						$_SESSION['pessoaPesquisa'] = $arrayPessoa;
					}
					else
					{
						$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("PESSOA_NAO_ENCONTRADA");
					}
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
					&idcomarca={$GET['idcomarca']}&idtipoacao={$GET['idtipoacao']}
					&idnaturezaacao={$GET['idnaturezaacao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assuntoentrevista={$GET['assuntoentrevista']}&nomePromovente={$_GET['nomePromovente']}&nomePromovido={$_GET['nomePromovido']}
					&nomeDefensor={$GET['nomeDefensor']}&iddefensor={$GET['iddefensor']}&tipoParte={$GET['tipoParte']}
					&mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
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
					header("Location:../public/pessoa.php?cadastro=1&mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
				}
			}
			else
			{
				if(isset($GET['paramentrosPessoa']))
				{
					header("Location:../public/pessoa.php?paramentrosPessoa={$GET['paramentrosPessoa']}
					&idcomarca={$GET['idcomarca']}&idtipoacao={$GET['idtipoacao']}
					&idnaturezaacao={$GET['idnaturezaacao']}&juizo={$GET['juizo']}
					&idpessoaPromovente={$GET['idpessoaPromovente']}&idpessoaPromovido={$GET['idpessoaPromovido']}
					&assuntoentrevista={$GET['assuntoentrevista']}&nomePromovente={$_GET['nomePromovente']}&tipoParte={$GET['tipoParte']}
					&nomeDefensor={$GET['nomeDefensor']}&iddefensor={$GET['iddefensor']}&nomePromovido={$_GET['nomePromovido']}");	
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
				$endereco = new Endereco();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($pessoa, $endereco, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($pessoa, $endereco);						
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
							&nomeDefensor={$POST['nomeDefensor']}&iddefensor={$POST['iddefensor']}&nomePromovido={$POST['nomePromovido']}");
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
							&assunto={$POST['assunto']}&nomeDefensor={$$POST['nomeDefensor']}&iddefensor={$POST['iddefensor']}
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
						$endereco->setIdpessoa($idPessoa);
						$this->deletar($pessoa, $endereco);
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
					$idEndereco = (isset($POST['idEndereco'])?$POST['idEndereco']:null);
					if(!ProjetoUtil::verificaBrancoNulo($idPessoa))
					{
						$pessoa->setIdpessoa($idPessoa);
						$endereco->setIdpessoa($idPessoa);
						$endereco->setIdendereco($idEndereco);
					}
					$this->preencheObjeto($pessoa, $endereco, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($pessoa, $endereco);
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
	
	private function preencheObjeto(Pessoa $pessoa, Endereco $endereco, $POST)
	{
		$pessoa->_setFrom($POST);
		$pessoa->setDatanascimentopessoa($pessoa->toDataNascimentoDB());
		$endereco->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $pessoa->validate(), $endereco->validate());
	}
	
	public function cadastrar(Pessoa $pessoa, Endereco $endereco)
	{
		try {
			$pessoa->setDatacadastropessoa(date("Y-m-d H:i:s"));
			$pessoa->save();
			$endereco->setIdpessoa($pessoa->getIdpessoa());
			$endereco->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	public function deletar(Pessoa $pessoa, Endereco $endereco)
	{
		try {
			if($pessoa->getIdpessoa()!= null)
			{
				$endereco->find(true);
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
	
	public function alterar(Pessoa $pessoa, Endereco $endereco)
	{
		try
		{
			$pessoa->update();
			$endereco->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
}

?>