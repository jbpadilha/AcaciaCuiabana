<?php

require_once ('ControlGeral.php');

class ControlaGerarPDF extends ControlGeral {
	
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
		$this->get();
	}
	
	public function post($POST) {
		try 
		{
			define('FPDF_FONTPATH','/home/www/font/');
			$testeDir = getcwd();
			require('../FPDF.php');
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				if($POST['funcao'] == "FichaHipo")
				{
					require_once('ExportPDF.php');					
					$hipossuficiencia = new Hipossuficiencia();
					$hipossuficiencia->setIdhipossuficiencia($POST['idhipossuficiencia']);
					$hipossuficiencia->find(true);
					
					
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
}
