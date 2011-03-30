<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (�baco Tecnologia)
// * Arquivo: Papeis_ProjetosVo.php
// * Cria��o: Rafael Henrique Vieira de Moura
// * Revis�o:
// * Data de cria��o: 01/07/2008
//####################################

/**
 * Classe Value Object. Serve para transportar os atributos de Papeis/Projetos entre as camadas.
 *
 */
class Papeis_ProjetosVo extends AbstractVo 
{
	private $idPapeisProjetos = null;
	private $idPapeis = null;
	private $idProjetos = null;
	private $idUsuarios = null;
	
	/**
	 * M�todo de modifica��o de identifica��o de Papeis_Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdPapeisProjeto($id = null)
	{
		$this->idPapeisProjetos = $id;
	}
	
	/**
	 * M�todo de retorno de identifica��o de Papeis_Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdPapeisProjeto()
	{
		return $this->idPapeisProjetos;
	}
	
	/**
	 * M�todo de modifica��o da identifica��o de Papeis
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdPapeis($id = null)
	{
		$this->idPapeis = $id;
	}
	
	/**
	 * M�todo de retorno de identifica��o de Papeis
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdPapeis()
	{
		return $this->idPapeis;
	}
	
	/**
	 * M�todo de modifica��o de identifica��o de Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdProjetos($id = null)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * M�todo de retorno de identifica��o de Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * M�todo de modifica��o de identifica��o de Usuarios
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdUsuarios($id = null)
	{
		$this->idUsuarios = $id;
	}
	
	/**
	 * M�todo de retorno de identifica��o de Usuarios
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
}
?>