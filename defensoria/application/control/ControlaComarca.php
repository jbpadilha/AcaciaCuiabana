<?php
require_once ('ControlGeral.php');
class ControlaComarca extends ControlGeral{
	
	public function cadastrar(Comarca $comarca)
	{
		try {
		if($comarca->getNomecomarca()!=null)
		{
			$comarca->save();
		}
		}
		catch (Exception $e)
		{
			throw new Exception();
		}
	}
	
	public function deletar(Comarca $comarca)
	{
		if($comarca->getIdcomarca()!= null)
		{
			$comarca->delete();
		}
	}
	
	public function alterar(Comarca $comarca)
	{
		if($comarca->getIdcomarca()!= null && $comarca->getNomecomarca()!=null)
		{
			$comarca->update();
		}
	}
	
	/**
	 * @param array $GET
	 */
	public function get($GET) {
		$comarcaPesquisa = new Comarca();
		$comarcaPesquisa->find();
		if($comarcaPesquisa->count()>0)
		{
			session_start();
			$_SESSION['comarcas'] = $comarcaPesquisa->allToObject();
		} 
		header("Location:../public/comarca.php");
	}

	/**
	 * @param array $POST
	 */
	public function post($POST) {
		$comarca = null;
		try {
			$function = (isset($POST['function']))?$POST['function']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$comarca = new Comarca();
				if($POST['function'] == "cadastrar")
				{
					$nome = (isset($POST['nome']))?$POST['nome']:null;
					if(!ProjetoUtil::verificaBrancoNulo($nome))
					{
						$comarca->setNomecomarca($POST['nome']);
						$this->cadastrar($comarca);
						
						$comarcaPesquisa = new Comarca();
						$comarcaPesquisa->find();
						$_SESSION['comarcas'] = $comarcaPesquisa->allToObject();
						
						$this->MENSAGEM_SUCESSO[] = Mensagens::$arrayMensagens["SUCESSO_CADASTRO"];
						header("Location:../public/comarca.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception(Mensagens::$arrayMensagens["CAMPO_OBRIGATORIO"]);
					}
				}
			}
			else
			{
				throw new Exception(Mensagens::$arrayMensagens["ERRO_ACESSAR_FUNCIONALIDADE"]);
			}
		}
		catch (Exception $e)
		{
			$this->MENSAGEM_ERRO[] = $e->getMessage();
			header("Location:../public/comarca.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}

	/**
	 * @param unknown_type unknown_type $grupo
	 */
	public function permiteAcesso($grupo) {
		return true;	
	}


	
}

?>