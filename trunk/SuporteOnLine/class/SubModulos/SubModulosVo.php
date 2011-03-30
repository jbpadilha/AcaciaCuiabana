<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: SubModulosVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 30/06/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usuсrios entre as camadas.
*/

class SubModulosVo extends AbstractVo
{
	private $idSubModulos = null;
	private $nomeSubModulos = '';
	
	public function setIdSubModulos($id = null)
	{
		$this->idSubModulos = $id;
	}
	
	public function getIdSubModulos()
	{
		return $this->idSubModulos;
	}
	
	public function setNomeSubModulos($nome = '')
	{
		$this->nomeSubModulos = $nome;
	}
	
	public function getNomeSubModulos()
	{
		return $this->nomeSubModulos;
	}
}
?>