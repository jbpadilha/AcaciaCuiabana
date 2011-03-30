<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: ModulosSubModulosVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 01/07/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
*/

class Modulos_SubModulosVo extends AbstractVo 
{
	private $idModulos_SubModulos = null;
	private $idModulos = null;
	private $idSubModulos = null;
	
	public function setIdModulos_SubModulos($id = null)
	{
		$this->idModulos_SubModulos = $id;
	}
	
	public function getIdModulos_SubModulos()
	{
		return $this->idModulos_SubModulos;
	}
	
	public function setIdModulos($id = null)
	{
		$this->idModulos = $id;
	}
	
	public function getIdModulos()
	{
		return $this->idModulos;
	}
	
	public function setIdSubModulos($id = null)
	{
		$this->idSubModulos = $id;
	}
	
	public function getIdSubModulos()
	{
		return $this->idSubModulos;
	}
}
?>