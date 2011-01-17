<?php

require_once ('ControlGeral.php');

class ControlaHipossuficiencia extends ControlGeral {
	
	private $arrayFichas = array();
	
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
						$fichaPesquisada = new Hipossuficiencia();
						$fichaPesquisada->setIdpessoa($pessoa->getIdpessoa());
						if($fichaPesquisada->find(true))
							$arrayFichas[] = $fichaPesquisada->getIdhipossuficiencia();
					}
				}
			}
			if(count($arrayFichas) > 0)
			{
				session_start();
				$_SESSION['fichaHipoPesquisa'] = $arrayFichas;
				header ( "Location:../public/fichaHipo.php");
			}
			else
			{
				$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("HIPO_NAO_ENCONTRADO");
				header ( "Location:../public/fichaHipo.php?mensagemErro=" . urlencode ( serialize ( $this->MENSAGEM_ERRO ) ) );
			}
		}
		else
		{
			header("Location:../public/hipossuficiencia.php");
		}
	}
	
	public function post($POST) {
		$hipossuficiencia = null;
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$hipossuficiencia = new Hipossuficiencia();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($hipossuficiencia, $POST);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($hipossuficiencia);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO"); 
						header("Location:../public/hipossuficiencia.php?gerarFicha=1&idhipossuficiencia={$hipossuficiencia->getIdhipossuficiencia()}&mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
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
			header("Location:../public/hipossuficiencia.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function cadastrar(Hipossuficiencia $hipossuficiencia)
	{
		try {
			if($hipossuficiencia->getIdpessoa()!= null)
			{
				$hipossuficiencia->save();
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
	
	private function preencheObjeto(Hipossuficiencia $hipossuficiencia, $POST)
	{			
		$idPessoa = (isset($POST['idpessoaHipo']))?$POST['idpessoaHipo']:null;
		$hipossuficiencia->setProfhipossuficiencia((isset($POST['profHipo']))?$POST['profHipo']:null);
		$hipossuficiencia->setSalariohipossuficiencia((isset($POST['salarioHipo']))?$POST['salarioHipo']:null);
		$hipossuficiencia->setEmpresahipossuficiencia((isset($POST['empresaHipo']))?$POST['empresaHipo']:null);
		$hipossuficiencia->setTotalrendahipossuficiencia((isset($POST['rendaHipo']))?$POST['rendaHipo']:null);
		$hipossuficiencia->setObservacoeshipossuficiencia((isset($POST['observacoesHipo']))?$POST['observacoesHipo']:null);
		
		if(ProjetoUtil::verificaBrancoNulo($idPessoa))
			$this->MENSAGEM_ERRO[] = "O nome deve ser preenchido.".Mensagens::getMensagem("CAMPO_OBRIGATORIO");
		else
			$hipossuficiencia->setIdpessoa($idPessoa);	

	}
}

?>
