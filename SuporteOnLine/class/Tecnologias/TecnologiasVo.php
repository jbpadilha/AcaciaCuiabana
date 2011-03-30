<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: TecnologiasVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 30/06/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
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