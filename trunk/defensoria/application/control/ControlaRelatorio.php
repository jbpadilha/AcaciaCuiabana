<?php

require_once ('ControlGeral.php');

class ControlaRelatorio extends ControlGeral {
	
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
	
	public function get($GET) 
	{
		try
		{
			if(isset($GET['funcao']))
			{
				switch ($GET['funcao'])
				{
					case "FichaHipo":
						{
							header ( "Location:../public/fichaHipo.php");
							break;
						}
					case "FichaAtendimento":
						{
							header ( "Location:../public/fichaAtendimento.php");
							break;
						}
					default:
						{
							throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE"));
							break;
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
			header("Location:../public/conteudoInicial.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function post($POST) {
		$this->get($POST);
	}
	
}

?>