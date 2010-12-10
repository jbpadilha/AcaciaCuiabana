<?php

require_once ('control\ControlGeral.php');

class ControlaEntrevista extends ControlGeral {
	
	public function permiteAcesso($grupo) {
		return true;
	}
	
	public function get($GET) {
		header("Location:../public/entrevista.php");
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
		if(isset($POST['comarca']))
			$processo->setIdcomarca($POST['comarca']);
		if(isset($POST['tipoAcao']))
			$processo->setIdtipoacao($POST['tipoAcao']);
		if(isset($POST['naturezaAcao']))
			$processo->setIdnaturezaacao($POST['naturezaAcao']);
		if(isset($POST['juizo']))
			$processo->setJuizo($POST['juizo']);
		if(isset($POST['idpessoaPromovente']))
		{
			$parteProcessoPromovente->setIdpessoa($POST['idpessoaPromovente']);
			$parteProcessoPromovente->setTipoparte(1);
			$parteProcessoPromovente->setIddefensor($POST['idDefensor']);
		}
		if(isset($POST['idpessoaPromovido']))
		{
			$parteProcessoPromovido->setIdpessoa($POST['idpessoaPromovido']);
			$parteProcessoPromovido->setTipoparte(2);
		}
		if(isset($POST['assunto']))
			$entrevista->setAssuntoentrevista($POST['assunto']);
				
	}

	
	public function cadastrar(Entrevista $entrevista, Processo $processo, ParteProcesso $parteProcessoPromovente, ParteProcesso $parteProcessoPromovido)
	{
		$erro = false;
		try {
			if($processo->getIdcomarca()!= null && $processo->getIdtipoacao()!= null && $processo->getIdnaturezaacao() != null)
			{
				$processo->save();
				$parteProcessoPromovente->setIdprocesso($processo->getIdprocesso());
				$parteProcessoPromovido->setIdprocesso($processo->getIdprocesso());
				if($parteProcessoPromovente->getIdpessoa()!= null && $parteProcessoPromovente->getTipoparte()!= null)
				{
					$parteProcessoPromovente->save();
					
					if($parteProcessoPromovido->getIdpessoa()!= null && $parteProcessoPromovido->getTipoparte()!= null)
					{
						$parteProcessoPromovido->save();
						
						$entrevista->setIdprocesso($processo->getIdprocesso());
						$entrevista->setProtocoloatendimento($this->genereteKey());
						$entrevista->setDataentrevista(date("Y-m-d H:i:s"));
						
						$entrevista->save();
					}
					else{
						$erro = true;
					}
				}
				else
				{
					$erro = true;
				}
			}
			else
			{
				$erro = true;
			}
			
			if($erro)
			{
				throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
			}
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
			$key .= chr(mt_rand(33,126));
		}
		return $key;
	}
}

?>