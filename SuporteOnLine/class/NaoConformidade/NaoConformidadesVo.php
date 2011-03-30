<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: NaoConformidadesVo.php
// * Criaчуo: Joуo Batista Padilha e Silva / Rafael Henrique Vieira de Moura
// * Revisуo: 
// * Data de criaчуo: 30/06/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos das nуo conformidades entre as camadas.
*/

class NaoConformidadesVo extends AbstractVo 
{
	private $idNaoConformidades = null;
	private $idPedidos = null;
	private $justificativaNaoConformidades = '';
	private $dataNaoConformidades = '';
	private $contraMedidaNaoConformidades = '';
	private $domnMotivo = null;
	
	public function setIdNaoConformidades($id = null)
	{
		$this->idNaoConformidades = $id;
	}
	
	public function getIdNaoConformidades()
	{
		return $this->idNaoConformidades;
	}
	
	public function setIdPedidos($id = null)
	{
		$this->idPedidos = $id;
	}
	
	public function getIdPedidos()
	{
		return $this->idPedidos;
	}
	
	public function setJustificativaNaoConformidades($desc = '')
	{
		$this->justificativaNaoConformidades = $desc;
	}
	
	public function getJustificativaNaoConformidades()
	{
		return $this->justificativaNaoConformidades;
	}
	
	public function setDataNaoConformidades($data = '')
	{
		$this->dataNaoConformidades = $data;
	}
	
	public function getDataNaoConformidades()
	{
		return $this->dataNaoConformidades;
	}
	
	public function setContraMedidasNaoConformidades($desc = '')
	{
		$this->contraMedidaNaoConformidades = $desc;
	}
	
	public function getContraMedidasNaoConformidades()
	{
		return $this->contraMedidaNaoConformidades;
	}
	
	public function setDomnMotivo($motivo = null)
	{
		$this->domnMotivo = $motivo;
	}
	
	public function getDomnMotivo()
	{
		return $this->domnMotivo;
	}
}
?>