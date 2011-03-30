<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: ModulosVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo:
// * Data de criaчуo: 01/07/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usuсrios entre as camadas.
*/

class ModulosVo extends AbstractVo
{
	private $idModulos = null;
	private $nomeModulos = ''; 
	
	public function setIdModulos($id = '')
	{
		$this->idModulos = $id;
	}
	
	public function getIdModulos()
	{
		return $this->idModulos;
	}
	
	public function setNomeModulos($nome = '')
	{
		$this->nomeModulos = $nome;
	}
	
	public function getNomeModulos()
	{
		return $this->nomeModulos;
	}
}
?>