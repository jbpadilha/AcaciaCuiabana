<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: TecnologiasVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 30/06/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usuсrios entre as camadas.
*/

class TecnologiasVo extends AbstractVo 
{
	private $idTecnologias = null;
	private $nomeTecnologias = '';
	
	public function setIdTecnologias($id = null)
	{
		$this->idTecnologias = $id;
	}
	
	public function getIdTecnologias()
	{
		return $this->idTecnologias;
	}
	
	public function setNomeTecnologias($nome = '')
	{
		$this->nomeTecnologias = $nome; 
	}
	
	public function getNomeTecnologias()
	{
		return $this->nomeTecnologias;
	}
}
?>