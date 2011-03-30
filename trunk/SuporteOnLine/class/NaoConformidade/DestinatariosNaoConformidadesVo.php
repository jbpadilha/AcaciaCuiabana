<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: DestinatariosNaoConformidadesVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Object. Serve para transportar os atributos dos usuсrios destinatсrios das nуo
   conformidades entre as camadas.
*/

class DestinatariosNaoConformidadesVo extends AbstractVo 
{
	private $idDestinatariosNaoConformidades = null;
	private $idUsuarios = null;
	private $idProjetos = null;
	
	public function setIdDestinatariosNaoConformidades($id = null)
	{
		$this->idDestinatariosNaoConformidades = $id;
	}
	
	public function getIdDestinatariosNaoConformidades()
	{
		return $this->idDestinatariosNaoConformidades;
	}
	
	public function setIdUsuarios($id = null)
	{
		$this->idUsuarios = $id;
	}
	
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
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