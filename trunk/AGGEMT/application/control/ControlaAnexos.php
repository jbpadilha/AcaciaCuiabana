<?php

require_once ('ControlGeral.php');

class ControlaAnexos extends ControlGeral {
	
	public function post($POST, $FILES = null) {
		$anexos = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$anexos = new Anexos();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($anexos, $POST, $FILES);
					$this->uploadArquivo($anexos,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($anexos);						
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_CADASTRO");
						header("Location:".PROJETO_CONTEXT."public/admin/inicio.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else
					{
						throw new Exception();
					}
				}
				elseif($POST['funcao'] == "deletar")
				{
					$idanexo = (isset($POST['idanexo']))?$POST['idanexo']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idanexo))
					{
						$anexos->setIdanexo($idanexo);
						$this->deletar($anexos);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/admin/conteudoInicial.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idanexo = (isset($POST['idanexo']))?$POST['idanexo']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idanexo))
					{
						$anexos->setIdanexo($idanexo);
						//Teste Img Notícia existente
						$anexosArq = new Anexos();
						$anexosArq->setIdanexo($idanexo);
						$anexosArq->find();
						if($anexosArq->getCaminhoanexo()!=null)
						{
							@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$anexosArq->getCaminhoanexo());
						}
					}
					$this->preencheObjeto($anexos, $POST, $FILES);
					$this->uploadArquivo($anexos,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($anexos);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_ALTERAR"); 
						header("Location:".PROJETO_CONTEXT."public/admin/inicio.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
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
			header("Location:".PROJETO_CONTEXT."public/admin/inicio.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function get($GET) {
	
	}
	
	public function permiteAcesso($grupo) {
		return true;
	}
	
	private function preencheObjeto(Anexos $anexos, $POST, $FILES)
	{
		$anexos->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $anexos->validate());
	}
	
	public function cadastrar(Anexos $anexos)
	{
		try {
			$anexos->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Anexos $anexos)
	{
		try {
			if($anexos->getIdanexo() != null)
			{
				$anexos->delete();
			}
			else
			{
				throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));	
			}
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function alterar(Anexos $anexos)
	{
		try
		{
			$anexos->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function uploadArquivo(Anexos $anexos, $FILES)
	{
		//Upload da Imagem
		require_once(PATH_PROJETO_APPLICATION."Upload.php");
		$upload = new Upload();
		if($FILES != null)
		{
			try
			{
				foreach($FILES as $key => $file)
				{
					if($file["error"] == 0)
					{
					    $upload->set("name",$file["name"]); // Uploaded file name.
					    $upload->set("type",$file["type"]); // Uploaded file type.
					    $upload->set("tmp_name",$file["tmp_name"]); // Uploaded tmp file name.
					    $upload->set("error",$file["error"]); // Uploaded file error.
					    $upload->set("size",$file["size"]); // Uploaded file size.
					    $upload->set("fld_name",$key); // Uploaded file field name.
					    $upload->set("max_file_size",4194304); // Max size allowed for uploaded file in bytes = 40 KB.
					    $upload->set("supported_extensions",array("gif" => "image/gif" , "jpg" => "image/jpeg", "jpeg" => "image/pjpeg" ,"png" => "image/x-png")); // Allowed extensions and types for uploaded file.
					    $upload->set("randon_name",TRUE); // Generate a unique name for uploaded file? bool(true/false).
					    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
					    $upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).
					    $upload->set("dst_dir",PATH_PROJETO_IMAGEM_UPLOAD."anexos"); // Destination directory for uploaded files.
					    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
					    if(!$result)
					    {
					    	throw new Exception($upload->error);
					    }
					    else {
					    	$anexos->setCaminhoanexo("anexos/".$upload->succeed_files_track[0]["new_file_name"]);
					    }
					}
			  }	
			}
			catch (Exception $e)
			{
				$this->MENSAGEM_ERRO[] = $e->getMessage();
				$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("ERRO_ARQUIVO_NAO_ENVIADO");
			}
		} 
	}
}

?>