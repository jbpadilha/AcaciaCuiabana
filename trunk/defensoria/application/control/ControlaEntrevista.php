<?php

require_once ('ControlGeral.php');

class ControlaEntrevista extends ControlGeral {
	
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
		if(isset($GET['pesquisa']))
		{
			if(($GET['nomePesquisa']!='' && $GET['cpfPesquisa']!='')
			|| ($GET['nomePesquisa']=='' && $GET['cpfPesquisa']!='') ||
			($GET['nomePesquisa']!='' && $GET['cpfPesquisa']==''))
			{
				$pessoa = new Pessoa();
				if($GET['cpfPesquisa']!='')
					$pessoa->setCpfpessoa($GET['cpfPesquisa']);
				if($GET['nomePesquisa']!='')
					$pessoa->where("nomepessoa like '%".trim($GET['nomePesquisa'])."%'");
				
				if($pessoa->find())
				{
					while($pessoa->fetch())
					{
						$parteProcesso = new ParteProcesso();
						$parteProcesso->setIdpessoa($pessoa->getIdpessoa());
						if($parteProcesso->find())
						{
							while($parteProcesso->fetch())
							{
								$entrevista = new Entrevista();
								if($GET['protocoloAtendimento']!='')
									$entrevista->setProtocoloatendimento($GET['protocoloAtendimento']);
								$entrevista->setIdprocesso($parteProcesso->getIdprocesso());
								if($entrevista->find(true))
									$arrayFichas[] = $entrevista->getIdentrevista();
							}
						}
					}
				}
			}
			elseif ($GET['protocoloAtendimento']!='')
			{
				$entrevista = new Entrevista();
				$entrevista->setProtocoloatendimento($GET['protocoloAtendimento']);
				if($entrevista->find(true))
					$arrayFichas[] = $entrevista->getIdentrevista();
			}
			if(count($arrayFichas) > 0)
			{
				session_start();
				$_SESSION['fichaAtendimentoPesquisa'] = $arrayFichas;
				header ( "Location:../public/fichaAtendimento.php");
			}
			else
			{
				$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("ATENDIMENTO_NAO_ENCONTRADO");
				header ( "Location:../public/fichaAtendimento.php?mensagemErro=" . urlencode ( serialize ( $this->MENSAGEM_ERRO ) ) );
			}
		}
		else
		{
			header("Location:../public/entrevista.php");
		}
	}
	
	public function post($POST) {
		$entrevista = null;
		$processo = null;
		$parteProcessoPromovente = null;
		$parteProcessoPromovido = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$entrevista = new Entrevista();
				$processo = new Processo();
				$parteProcessoPromovente = new ParteProcesso();
				$parteProcessoPromovido = new ParteProcesso();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($entrevista,$processo,$parteProcessoPromovente,$parteProcessoPromovido,$POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($entrevista,$processo,$parteProcessoPromovente,$parteProcessoPromovido);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO");
						$this->MENSAGEM_SUCESSO[] = 'O Protocolo de Atendimento é <font color="FF0000"><b>'.$entrevista->getProtocoloatendimento().'</b></font>'; 
						header("Location:../public/entrevista.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
	
	private function preencheObjeto(Entrevista $entrevista, Processo $processo, ParteProcesso $parteProcessoPromovente, ParteProcesso $parteProcessoPromovido, $POST)
	{
		$entrevista->_setFrom($POST);
		$processo->_setFrom($POST);
		
		if(isset($POST['idpessoaPromovente']))
		{
			$parteProcessoPromovente->setIdpessoa($POST['idpessoaPromovente']);
			$parteProcessoPromovente->setTipoparte(1);
			$parteProcessoPromovente->setIddefensor($POST['iddefensor']);
		}
		if(isset($POST['idpessoaPromovido']))
		{
			$parteProcessoPromovido->setIdpessoa($POST['idpessoaPromovido']);
			$parteProcessoPromovido->setTipoparte(2);
		}
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $entrevista->validate(), $processo->validate());
	}
	
	public function cadastrar(Entrevista $entrevista, Processo $processo, ParteProcesso $parteProcessoPromovente, ParteProcesso $parteProcessoPromovido)
	{
		try {
			$processo->save();
			$parteProcessoPromovente->setIdprocesso($processo->getIdprocesso());
			$parteProcessoPromovido->setIdprocesso($processo->getIdprocesso());
			$parteProcessoPromovente->save();
			$parteProcessoPromovido->save();
			$entrevista->setIdprocesso($processo->getIdprocesso());
			$entrevista->setProtocoloatendimento(date("Ymdhis").$this->genereteKey(2));
			$entrevista->setDataentrevista(date("Y-m-d H:i:s"));
			$entrevista->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE")+$e->getMessage());
		}
	}
	
	public function genereteKey($length = 16)
	{
		$key = '';
		for($i = 0; $i < $length; $i ++)
		{
			$key .= mt_rand(33,126);
		}
		return $key;
	}
}

?>