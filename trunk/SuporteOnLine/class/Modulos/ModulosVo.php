<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: ModulosVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o:
// * Data de cria��o: 01/07/2008
//####################################
/*
   Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
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