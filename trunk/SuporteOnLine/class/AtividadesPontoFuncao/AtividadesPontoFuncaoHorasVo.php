<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: AtividadesPontoFuncaoHorasVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos de
   AtividadesPontoFuncaoHoras entre as camadas.
*/

class AtividadesPontoFuncaoHorasVo extends AbstractVo 
{
	private $idAtividadePontoFuncaoHoras = null;
	private $idTecnologias = null;
	private $nomeAtividadesPontoFuncaoHoras = '';
	private $pontoFuncaoAtividadesPontoFuncaoHoras = null;
	private $horasAtividadesPontoFuncaoHoras = '';
	
	public function setIdAtividadePontoFuncaoHoras($id = null)
	{
		$this->idAtividadePontoFuncaoHoras = $id;
	}
	
	public function getIdAtividadePontoFuncaoHoras()
	{
		return $this->idAtividadePontoFuncaoHoras;
	}
	
	public function setIdTecnologias($id = null)
	{
		$this->idTecnologias = $id;
	}
	
	public function getIdTecnologias()
	{
		return $this->idTecnologias;
	}
	
	public function setNomeAtividadesPontoFuncaoHoras($nome = '')
	{
		$this->nomeAtividadesPontoFuncaoHoras = $nome;
	}
	
	public function getNomeAtividadesPontoFuncaoHoras()
	{
		return $this->nomeAtividadesPontoFuncaoHoras;
	}
	
	public function setPontoFuncaoAtividadesPontoFuncaoHoras($ponto = null)
	{
		$this->pontoFuncaoAtividadesPontoFuncaoHoras = $ponto;
	}
	
	public function getPontoFuncaoAtividadesPontoFuncaoHoras()
	{
		return $this->pontoFuncaoAtividadesPontoFuncaoHoras;
	}
	
	public function setHorasAtividadesPontoFuncaoHoras($horas = '')
	{
		$this->horasAtividadesPontoFuncaoHoras = $horas;
	}
	
	public function getHorasAtividadesPontoFuncaoHoras()
	{
		return $this->horasAtividadesPontoFuncaoHoras;
	}
}
?>