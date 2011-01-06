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
		$entrevista->_setFrom($POST);
		$processo->_setFrom($POST);
		
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
			$entrevista->setProtocoloatendimento($this->genereteKey());
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
			$key .= chr(mt_rand(33,126));
		}
		return $key;
	}
}

?>