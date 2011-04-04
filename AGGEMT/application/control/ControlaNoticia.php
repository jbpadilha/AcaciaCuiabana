<?php
require_once ('ControlGeral.php');

class ControlaNoticia extends ControlGeral {

	
	public function permiteAcesso($grupo) {
		/*if($grupo == GruposUsuarios::$GRUPO_ADMIN)
		{
			return true;
		}
		else
		{
			return false;
		}*/
		return true;
	}
	
	public function get($GET) {
		
	}
	
	public function post($POST,$FILES = null) {
		$noticia = null;
		$this->MENSAGEM_ERRO = Array();
		$this->MENSAGEM_SUCESSO = Array();
		try {
			$function = (isset($POST['funcao']))?$POST['funcao']:null;
			if(!ProjetoUtil::verificaBrancoNulo($function))
			{
				$noticia = new Noticias();
				if($POST['funcao'] == "cadastrar")
				{
					$this->preencheObjeto($noticia, $POST, $FILES);
					$this->uploadImagem($noticia,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->cadastrar($noticia);						
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
					$idnoticia = (isset($POST['idnoticia']))?$POST['idnoticia']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idnoticia))
					{
						$noticia->setIdnoticia($idnoticia);
						$this->deletar($noticia);
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
					$idnoticia = (isset($POST['idnoticia']))?$POST['idnoticia']:null;
					if(!ProjetoUtil::verificaBrancoNulo($idnoticia))
					{
						$noticia->setIdnoticia($idnoticia);
						//Teste Img Notícia existente
						$noticiaImg = new Noticias();
						$noticiaImg->setIdnoticia($idnoticia);
						$noticiaImg->find();
						if($noticiaImg->getImagemnoticia()!=null)
						{
							@unlink(PATH_PROJETO_IMAGEM_UPLOAD.$noticiaImg->getImagemnoticia());
						}
					}
					$this->preencheObjeto($noticia, $POST, $FILES);
					$this->uploadImagem($noticia,$FILES);
					if(count($this->MENSAGEM_ERRO)<=0)
					{
						$this->alterar($noticia);
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
	
	private function preencheObjeto(Noticias $noticias, $POST, $FILES)
	{
		$noticias->_setFrom($POST);
		$noticias->setDatanoticia($noticias->toDataNoticiaDB());
		if($noticias->getDestaque() == null)
			$noticias->setDestaque(0);
		$this->MENSAGEM_ERRO = array_merge($this->MENSAGEM_ERRO, $noticias->validate());
	}
	
	public function cadastrar(Noticias $noticias)
	{
		try {
			$noticias->save();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function deletar(Noticias $noticias)
	{
		try {
			if($noticias->getIdnoticia() != null)
			{
				$noticias->delete();
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
	
	public function alterar(Noticias $noticias)
	{
		try
		{
			$noticias->update();
		}
		catch (Exception $e)
		{
			throw new Exception(Mensagens::getMensagem("ERRO_ACESSAR_FUNCIONALIDADE").$e->getMessage());
		}
	}
	
	public function uploadImagem(Noticias $noticias, $FILES)
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
					    $upload->set("dst_dir",PATH_PROJETO_IMAGEM_UPLOAD."noticias"); // Destination directory for uploaded files.
					    $result = $upload->moveFileToDestination(); // $result = bool (true/false). Succeed or not.
					    $noticias->setImagemnoticia("noticias/".$upload->succeed_files_track[0]["new_file_name"]);
					    if(!$result)
					    {
					    	throw new Exception($upload->error);
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