<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: Log_SuporteVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos de Log_Suporte entre as camadas.
*/

class Log_SuporteVo extends AbstractVo 
{
	private $idLog_Suporte = null;
	private $idUsuarios = null;
	private $idFuncionalidades = null;
	private $DomnAcao = null;
	private $dataCriacaoLog_Suporte = '';
	
	public function setIdLog_Suporte($id = null)
	{
		$this->idLog_Suporte = $id;
	}
	
	public function getIdLog_Suporte()
	{
		return $this->idLog_Suporte;
	}
	
	public function setIdUsuarios($id = null)
	{
		$this->idUsuarios = $id;
	}
	
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
	
	public function setIdFuncionalidades($id = null)
	{
		$this->idFuncionalidades = $id;
	}
	
	public function getIdFuncionalidades()
	{
		return $this->idFuncionalidades;
	}
	
	public function setDomnAcao($acao = null)
	{
		$this->DomnAcao = $acao;
	}
	
	public function getDomnAcao()
	{
		return $this->DomnAcao;
	}
	
	public function setDataCriacaoLog_Suporte($data = '')
	{
		$this->dataCriacaoLog_Suporte = $data;
	}
	
	public function getDataCriacaoLog_Suporte()
	{
		return $this->dataCriacaoLog_Suporte;
	}
}
?>