<?php

require_once ('ControlGeral.php');

class ControlaUsuarios extends ControlGeral {
	
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
		header("Location:../public/usuarios.php");
	}
	
	public function post($POST) {
		$usuarios = null;
		$pessoa = null;
		$endereco = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$usuarios = new Usuarios();
				$pessoa = new Pessoa();
				$endereco = new Endereco();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($usuarios, $pessoa, $endereco, $POST);
					if(count($this->MENSAGEM_ERRO)>0)
					{
						throw new Exception();
					}
					else
					{
						$this->cadastrar($usuarios, $pessoa, $endereco);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/usuarios.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$this->preencheObjeto($usuarios, $pessoa, $endereco, $POST);
					if(count($this->MENSAGEM_ERRO)>0)
					{
						throw new Exception();
					}
					else
					{
						$this->deletar($usuarios, $pessoa, $endereco);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/usuarios.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$this->preencheObjeto($usuarios, $pessoa, $endereco, $POST);
					if(count($this->MENSAGEM_ERRO)>0)
					{
						throw new Exception();
					}
					else
					{
						$this->deletar($usuarios, $pessoa, $endereco);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:../public/usuarios.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:../public/comarca.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	private function preencheObjeto(Usuarios $usuarios, Pessoa $pessoa, Endereco $endereco, $POST)
	{
		$usuarios->_setFrom($POST);
		$pessoa->_setFrom($POST);
		$pessoa->setDatanascimentopessoa($pessoa->toDataNascimentoDB());
		$endereco->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $usuarios->validate(), $pessoa->validate(), $endereco->validate());
	}
	
	public function cadastrar(Usuarios $usuarios, Pessoa $pessoa, Endereco $endereco)
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
				$endereco->setIdpessoa($pessoa->getIdpessoa());
				$endereco->save();
				$usuarios->setIdpessoa($pessoa->getIdpessoa());
				$usuarios->setSenha(sha1($usuarios->getSenha()));
				$usuarios->save();
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

	public function deletar(Usuarios $usuarios, Pessoa $pessoa, Endereco $endereco)
	{
	try {
			$usuarios->setIdpessoa($pessoa->getIdpessoa());
			$usuarios->delete();
			$endereco->setIdpessoa($pessoa->getIdpessoa());
			$endereco->delete();
			$pessoa->delete();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	public function alterar(Usuarios $usuarios, Pessoa $pessoa, Endereco $endereco)
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
	
}

?>