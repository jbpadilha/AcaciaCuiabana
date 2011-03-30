<?php
//####################################
// * Rafael Henrique Vieira de Moura / Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: Papeis_ProjetosVo.php
// * Criaчуo: Rafael Henrique Vieira de Moura
// * Revisуo:
// * Data de criaчуo: 01/07/2008
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
	 * Mщtodo de modificaчуo de identificaчуo de Papeis_Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdPapeisProjeto($id = null)
	{
		$this->idPapeisProjetos = $id;
	}
	
	/**
	 * Mщtodo de retorno de identificaчуo de Papeis_Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdPapeisProjeto()
	{
		return $this->idPapeisProjetos;
	}
	
	/**
	 * Mщtodo de modificaчуo da identificaчуo de Papeis
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdPapeis($id = null)
	{
		$this->idPapeis = $id;
	}
	
	/**
	 * Mщtodo de retorno de identificaчуo de Papeis
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdPapeis()
	{
		return $this->idPapeis;
	}
	
	/**
	 * Mщtodo de modificaчуo de identificaчуo de Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdProjetos($id = null)
	{
		$this->idProjetos = $id;
	}
	
	/**
	 * Mщtodo de retorno de identificaчуo de Projetos
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdProjetos()
	{
		return $this->idProjetos;
	}
	
	/**
	 * Mщtodo de modificaчуo de identificaчуo de Usuarios
	 * @author Rafael Henrique Vieira de Moura
	 * @param integer $id
	 */
	public function setIdUsuarios($id = null)
	{
		$this->idUsuarios = $id;
	}
	
	/**
	 * Mщtodo de retorno de identificaчуo de Usuarios
	 * @author Rafael Henrique Vieira de Moura
	 * @return integer
	 */
	public function getIdUsuarios()
	{
		return $this->idUsuarios;
	}
}
?>