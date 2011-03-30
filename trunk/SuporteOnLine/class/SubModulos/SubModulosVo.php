<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: SubModulosVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 30/06/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
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