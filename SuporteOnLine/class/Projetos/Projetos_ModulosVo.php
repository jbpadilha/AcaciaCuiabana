<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Бbaco Tecnologia)
// * Arquivo: Projetos_ModulosVo.php
// * Criaзгo: Rafael Henrique Vieira de Moura
// * Revisгo:
// * Data de criaзгo: 01/07/2008
//####################################
/**
 * Classe Value Object. Serve para transportar os atributos dos usuбrios entre as camadas.
 * @author Rafael Henrique Vieira de Moura
 */
class Projetos_ModulosVo extends AbstractVo 
{
	private $idProjetos_Modulos = null;
	private $idProjetos = null;
	private $idModulos = null;
	
	/**
	 * Mйtodo que atribui a identificaзгo de projetos mуdulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdProjetos_Modulos($id = null)
	{
		$this->idProjetos_Modulos = $id;
	}
	
	/**
	 * Mйtodo que retorna a identificaзгo de Projetos Mуdulos
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdProjetos_Modulos()
	{
		return $this->idProjetos_Modulos;
	}
	
	/**
	 * Mйtodo que atribui a identificaзгo de projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdProjetos($id = null)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * Mйtodo que retorna a identificaзгo de projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * Mйtodo que atribui a identificaзгo de mуdulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdModulos($id = null)
	{
		$this->idModulos = $id;
	}
	
	/**
	 * Mйtodo que retorna a identificaзгo de mуdulos do projeto
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdModulos()
	{
		return $this->idModulos;
	}
}
?>