<?php

require_once ('ControlGeral.php');

class ControlaBanners extends ControlGeral {
	
public function post($POST, $FILES = null) {
		$banners = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$banners = new Banners();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($banners, $POST, $FILES);
					$this->uploadArquivo($banners,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($banners);						
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
					$idbanner = (isset($POST['idbanner']))?$POST['idbanner']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idanexo))
					{
						$banners->setIdbanner($idbanner);
						//Teste Img Notícia existente
						$bannersArq = new Banners();
						$bannersArq->setIdbanner($idbanner);
						$bannersArq->find();
						if($bannersArq->getCaminhobanner()!=null)
						{
							@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$bannersArq->getCaminhobanner());
						}
						$this->deletar($banners);
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
					$idbanner = (isset($POST['idbanner']))?$POST['idbanner']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idanexo))
					{
						$banners->setIdbanner($idbanner);
						//Teste Img Notícia existente
						$bannersArq = new Banners();
						$bannersArq->setIdbanner($idbanner);
						$bannersArq->find();
						if($bannersArq->getCaminhobanner()!=null)
						{
							@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$bannersArq->getCaminhobanner());
						}
					}
					$this->preencheObjeto($banners, $POST, $FILES);
					$this->uploadArquivo($banners,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($banners);
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
		if($grupo == GruposUsuarios::$GRUPO_ADMIN)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function preencheObjeto(Banners $banners, $POST, $FILES)
	{
		$banners->_setFrom($POST);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $banners->validate());
	}
	
	public function cadastrar(Banners $banners)
	{
		try {
			$banners->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Banners $banners)
	{
		try {
			if($banners->getIdbanner() != null)
			{
				$banners->delete();
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
	
	public function alterar(Banners $banners)
	{
		try
		{
			$banners->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function uploadArquivo(Banners $banners, $FILES)
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
					    $upload->set("supported_extensions",array("gif" => "image/gif" , "jpg" => "image/jpeg", "jpeg" => "image/pjpeg" ,"png" => "image/x-png", "doc" => "application/msword", "pdf" => "application/pdf")); // Allowed extensions and types for uploaded file.
					    $upload->set("randon_name",TRUE); // Generate a unique name for uploaded file? bool(true/false).
					    $upload->set("replace",FALSE); // Replace existent files or not? bool(true/false).
					    $upload->set("file_perm",0444); // Permission for uploaded file. 0444 (Read only).
					    $upload->set("dst_dir",PATH_PROJETO_IMAGEM_UPLOAD."banners"); // Destination directory for uploaded files.
					    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
					    if(!$result)
					    {
					    	throw new Exception($upload->msg[$upload->error_type]);
					    }
					    else {
					    	$banners->setCaminhobanner("banners/".$upload->succeed_files_track[0]["new_file_name"]);
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