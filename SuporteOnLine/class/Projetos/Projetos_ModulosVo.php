<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: Projetos_ModulosVo.php
// * Cria��o: Rafael Henrique Vieira de Moura
// * Revis�o:
// * Data de cria��o: 01/07/2008
//####################################
/**
 * Classe Value Object. Serve para transportar os atributos dos usu�rios entre as camadas.
 * @author Rafael Henrique Vieira de Moura
 */
class Projetos_ModulosVo extends AbstractVo 
{
	private $idProjetos_Modulos = null;
	private $idProjetos = null;
	private $idModulos = null;
	
	/**
	 * M�todo que atribui a identifica��o de projetos m�dulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdProjetos_Modulos($id = null)
	{
		$this->idProjetos_Modulos = $id;
	}
	
	/**
	 * M�todo que retorna a identifica��o de Projetos M�dulos
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdProjetos_Modulos()
	{
		return $this->idProjetos_Modulos;
	}
	
	/**
	 * M�todo que atribui a identifica��o de projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdProjetos($id = null)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * M�todo que retorna a identifica��o de projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * M�todo que atribui a identifica��o de m�dulos
	 * @author Rafael Henrique Vieira de Moura
	 * @param int $id
	 */
	public function setIdModulos($id = null)
	{
		$this->idModulos = $id;
	}
	
	/**
	 * M�todo que retorna a identifica��o de m�dulos do projeto
	 * @author Rafael Henrique Vieira de Moura
	 * @return int
	 */
	public function getIdModulos()
	{
		return $this->idModulos;
	}
}
?>