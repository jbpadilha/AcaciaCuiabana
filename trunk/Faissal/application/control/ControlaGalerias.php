<?php

require_once ('ControlGeral.php');

class ControlaGalerias extends ControlGeral {
	
	public function post($POST, $FILES = null) {
		$galerias = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$galerias = new Galerias();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($galerias, $POST, $FILES);
					$this->uploadArquivo($galerias,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($galerias);						
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
					$idGaleria = (isset($POST['idGaleria']))?$POST['idGaleria']:null;
					if(!ProjetoUtil::verificaBrancoNulo(idGaleria))
					{
						$galerias->setIdGaleria($idGaleria);
						$galerias->find();
						if($galerias->getPastaGaleria()!=null)
						{
							//@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$galerias->getPastaGaleria());
						}
						$this->deletar($galerias);
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
					$idGaleria = (isset($POST['idGaleria']))?$POST['idGaleria']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idGaleria))
					{
						$galerias->setIdGaleria($idGaleria);
						$galerias->find(true);
						//Teste Img NotÃ­cia existente
						$galeriasArq = new Galerias();
						$galeriasArq->setIdGaleria($idGaleria);
						$galeriasArq->find();
						if($galeriasArq->getPastaGaleria()!=null)
						{
							//@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$galeriasArq->getPastaGaleria());
						}
					}
					$this->preencheObjeto($galerias, $POST, $FILES);
					$this->uploadArquivo($galerias,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($galerias);
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
			//header("Location:".PROJETO_CONTEXT."public/admin/conteudoInicial.php?mensagemErro=".urlencode(serialize($this->MENSAGEM_ERRO)));
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
	
	private function preencheObjeto(Galerias $galerias, $POST, $FILES)
	{
		$galerias->_setFrom($POST);
		$galerias->setDataGaleria($galerias->toDataGaleriaDB());
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $galerias->validate());
	}
	
	public function cadastrar(Galerias $galerias)
	{
		try {
			$galerias->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Galerias $galerias)
	{
		try {
			if($galerias->getIdGaleria() != null)
			{
				$galerias->delete();
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
	
	public function alterar(Galerias $galerias)
	{
		try
		{
			$galerias->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function uploadArquivo(Galerias $galerias, $FILES)
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
					var_dump($file);
					if($file["error"] == 0)
					{
					    $upload->set("name",$file["name"]); // Uploaded file name.
					    $upload->set("type",$file["type"]); // Uploaded file type.
					    $upload->set("tmp_name",$file["tmp_name"]); // Uploaded tmp file name.
					    $upload->set("error",$file["error"]); // Uploaded file error.
					    $upload->set("size",$file["size"]); // Uploaded file size.
					    $upload->set("fld_name",$key); // Uploaded file field name.
					    $upload->set("max_file_size",4194304); // Max size allowed for uploaded file in bytes = 40 KB.
					    $upload->set("supported_extensions",array("zip" => "application/zip")); // Allowed extensions and types for uploaded file.
					    $upload->set("randon_name",TRUE); // Generate a unique name for uploaded file? bool(true/false).
					    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
					    $upload->set("file_perm",0777); // Permission for uploaded file. 0777 (Read and Write).
					    $upload->set("dst_dir",PATH_PROJETO_IMAGEM_UPLOAD."galerias"); // Destination directory for uploaded files.
					    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not. 
					    if(!$result)
					    {
					    	throw new Exception($upload->msg[$upload->error_type]);
					    }
					    else {
					    	$galerias->setPastaGaleria("galerias/".$upload->succeed_files_track[0]["new_file_name"]);
					    	try {
					    		$dir_name = explode(".",$file["name"]);
								$dir_name = $dir_name[0].date("dmYHis");
								$dir_name = preg_replace("[^a-zA-Z0-9_.]", "", strtr($dir_name, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
					    		$dir_name_aux = PATH_PROJETO_IMAGEM_UPLOAD."/galerias/".$dir_name;
					    		$this->unzip(PATH_PROJETO_IMAGEM_UPLOAD.$galerias->getPastaGaleria(),$dir_name_aux,false);
					    		$galerias->setImgInicioGaleria("capa.jpg");
					    	}
					    	catch (Exception $e)
					    	{
					    		throw new Exception($e->getMessage());
					    	}
					    }
					}
					else {
						throw new Exception($file["error"]);
					}
					
			  }	
			}
			catch (Exception $e)
			{
				$this->MENSAGEM_ERRO[] = $e->getMessage();
				$this->MENSAGEM_ERRO[] = Mensagens::getMensagem("ERRO_ARQUIVO_NAO_ENVIADO");
				throw new Exception($e->getMessage());
			}
		} 
	}
	
	public function unzip($src_file, $dest_dir="./")
	{
		try
	  	{
	  		$zip = new ZipArchive();
			$res = $zip->open($src_file);
			if ($res === TRUE) {
			    $zip->extractTo($dest_dir);
			    $zip->close();
			} else {
			     throw new Exception("Não foi possível descompactar o arquivo.");
			}
	  	}
	  	catch (Exception $e)
	  	{
	    	throw new Exception("Não foi possível descompactar o arquivo.");
		  }
	}
}

?>