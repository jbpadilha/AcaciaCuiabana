<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: AnexosVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos dos Anexos entre as camadas.
*/

class AnexosVo extends AbstractVo 
{
	private $idAnexos = null;
	private $nomeAnexos = '';
	private $descricaoAnexos = '';
	private $caminhoAnexos = '';
	private $dataInclusaoAnexos = '';
	
	public function setIdAnexos($id = null)
	{
		$this->idAnexos = $id;
	}
	
	public function getIdAnexos()
	{
		return $this->idAnexos;
	}
	
	public function setNomeAnexos($nome = '')
	{
		$this->nomeAnexos = $nome;
	}
	
	public function getNomeAnexos()
	{
		return $this->nomeAnexos;
	}
	
	public function setDescricaoAnexos($desc = '')
	{
		$this->descricaoAnexos = $desc;
	}
	
	public function getDescricaoAnexos()
	{
		return $this->descricaoAnexos;
	}
	
	public function setCaminhoAnexos($caminho = '')
	{
		$this->caminhoAnexos = $caminho;
	}
	
	public function getCaminhoAnexos()
	{
		return $this->caminhoAnexos;
	}
	
	public function setDataInclusaoAnexos($data = '')
	{
		$this->dataInclusaoAnexos = $data;
	}
	
	public function getDataInclusaoAnexos()
	{
		return $this->dataInclusaoAnexos;
	}
}
?>