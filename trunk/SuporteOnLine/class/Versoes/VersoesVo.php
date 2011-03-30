<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: VersoesVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos das Versoes entre as camadas.
*/

class VersoesVo extends AbstractVo 
{
	private $idVersoes = null;
	private $nomeVersoes = '';
	private $dataEntregaVersoes = '';
	private $dataEntregaVersoesClientes = '';
	private $idAnexos = null;
	private $idProjetos = null;
	
	public function setIdVersoes($id = null)
	{
		$this->idVersoes = $id;
	}
	
	public function getIdVersoes()
	{
		return $this->idVersoes;
	}
	
	public function setNomeVersoes($nome = '')
	{
		$this->nomeVersoes = $nome;
	}
	
	public function getNomeVersoes()
	{
		return $this->nomeVersoes;
	}
	
	public function setDataEntregaVersoes($data)
	{
		$this->dataEntregaVersoes = $data;
	}
	
	public function getDataEntregaVersoes()
	{
		return $this->dataEntregaVersoes;
	}
	
	public function setIdAnexos($id = null)
	{
		$this->idAnexos = $id;
	}
	
	public function getIdAnexos()
	{
		return $this->idAnexos;
	}
		
	public function setDataEntregaVersoesClientes($data = '')
	{
		$this->dataEntregaVersoesClientes = $data;
	}
	
	public function getDataEntregaVersoesClientes()
	{
		return $this->dataEntregaVersoesClientes;
	}
	
	public function setIdProjetos($id = null)
	{
		$this->idProjetos = $id;
	}
	
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
}
?>