<?php

require_once ('ControlGeral.php');

class ControlaImagensUteis extends ControlGeral {

	public function post($POST, $FILES = null) {
		$imagensUteis = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$imagensUteis = new ImagensUteis();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($imagensUteis, $POST, $FILES);
					$this->uploadArquivo($imagensUteis,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($imagensUteis);						
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
					$idImagensUteis = (isset($POST['idImagensUteis']))?$POST['idImagensUteis']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idImagensUteis))
					{
						$imagensUteis->setIdImagensUteis($idImagensUteis);
						$imagensUteisArq = new ImagensUteis();
						$imagensUteisArq->setIdImagensUteis($idImagensUteis);
						$imagensUteisArq->find();
						if($imagensUteisArq->getLocalImagensUteis()!=null)
						{
							@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$imagensUteisArq->getLocalImagensUteis());
						}
						$this->deletar($imagensUteisArq);
						$this->MENSAGEM_SUCESSO[] = Mensagens::getMensagem("SUCESSO_DELETAR"); 
						header("Location:../public/admin/inicio.php?mensagemSucesso=".urlencode(serialize($this->MENSAGEM_SUCESSO)));
					}
					else	
					{
						throw new Exception(Mensagens::getMensagem("CAMPO_OBRIGATORIO"));
					}
					
				}
				elseif($POST['funcao'] == "alterar")
				{
					$idImagensUteis = (isset($POST['idImagensUteis']))?$POST['idImagensUteis']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idImagensUteis))
					{
						$imagensUteisArq->setIdImagensUteis($idImagensUteis);
						$imagensUteisArq->find(true);
						$imagensUteisArq = new ImagensUteis();
						$imagensUteisArq->setIdImagensUteis($idImagensUteis);
						$imagensUteisArq->find();
						if($imagensUteisArq->getLocalImagensUteis()!=null)
						{
							@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$imagensUteisArq->getLocalImagensUteis());
						}
					}
					$this->preencheObjeto($imagensUteisArq, $POST, $FILES);
					$this->uploadArquivo($imagensUteisArq,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($imagensUteisArq);
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
			header("Location:".PROJETO_CONTEXT."public/admin/conteudoInicial.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
		}
	}
	
	public function get($GET) {
	
	}
	
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
	
	private function preencheObjeto(ImagensUteis $imagensUteisArq, $POST, $FILES)
	{
		$imagensUteisArq->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $imagensUteisArq->validate());
	}
	
	public function cadastrar(ImagensUteis $imagensUteisArq)
	{
		try {
			$imagensUteisArq->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(ImagensUteis $imagensUteisArq)
	{
		try {
			if($imagensUteisArq->getIdImagensUteis() != null)
			{
				$imagensUteisArq->delete();
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
	
	public function alterar(ImagensUteis $imagensUteisArq)
	{
		try
		{
			$imagensUteisArq->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function uploadArquivo(ImagensUteis $imagensUteisArq, $FILES)
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
					    $upload->set("dst_dir",PATH_PROJETO_IMAGEM_UPLOAD."imagensuteis"); // Destination directory for uploaded files.
					    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
					    if(!$result)
					    {
					    	throw new Exception($upload->msg[$upload->error_type]);
					    }
					    else {
					    	$imagensUteisArq->setLocalImagensUteis("imagensuteis/".$upload->succeed_files_track[0]["new_file_name"]);
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