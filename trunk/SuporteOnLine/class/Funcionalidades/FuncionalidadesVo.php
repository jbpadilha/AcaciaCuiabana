<?php
//####################################
// * Joуo Batista Padilha e Silva Analista/Desenvolvedor (Сbaco Tecnologia)
// * Arquivo: FuncionalidadesVo.php
// * Criaчуo: Joуo Batista Padilha e Silva
// * Revisуo: Rafael Henrique Vieira de Moura
// * Data de criaчуo: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usuсrios entre as camadas.
 * @author Joуo Batista Padilha e Silva
 */
class FuncionalidadesVo extends AbstractVo 
{
	private $idFuncionalidades = null;
	private $nomeFuncionalidades = '';
	private $linkFuncionalidades = '';
	private $DomnTipoFuncionalidades = null;
	private $ordemFuncionalidades = null;
	private $precedenteFuncionalidades = null;
	
	/**
	 * Mщtodo de modificaчуo da identificaчуo de Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdFuncionalidades($id = null)
	{
		$this->idFuncionalidades = $id;
	}
	
	/**
	 * Mщtodo de retorno da Identificaчуo de Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdFuncionalidades()
	{
		return $this->idFuncionalidades;
	}
	
	/**
	 * Mщtodo de modificaчуo do nome de Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeFuncionalidades($nome = '')
	{
		$this->nomeFuncionalidades = $nome;
	}
	
	/**
	 * Mщtodo de retorno do nome de Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeFuncionalidades()
	{
		return $this->nomeFuncionalidades;
	}
	
	/**
	 * Mщtodo de modificaчуo de Link de Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @param var $link
	 */
	public function setLinkFuncionalidades($link = '')
	{
		$this->linkFuncionalidades = $link;
	}
	
	/**
	 * Mщtodo de retorno de Link de Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @return var
	 */
	public function getLinkFuncionalidades()
	{
		return $this->linkFuncionalidades;
	}
	
	/**
	 * Mщtodo de modificaчуo de Dominio Tipo de Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @param integer $domn
	 */
	public function setDomnTipoFuncionalidades($domn = null)
	{
		$this->DomnTipoFuncionalidades = $domn;
	}
	
	/**
	 * Mщtodo de retorno do Dominio tipo Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @return integer
	 */
	public function getDomnTipoFuncionalidades()
	{
		return $this->DomnTipoFuncionalidades;
	}
	
	/**
	 * Mщtodo de modificaчуo da ordem da Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @param integer $ordem
	 */
	public function setOrdemFuncionalidades($ordem = null)
	{
		$this->ordemFuncionalidades = $ordem;
	}
	
	/**
	 * Mщtodo de retorno da ordem da Funcionalidades
	 * @author Joуo Batista Padilha e Silva
	 * @return integer
	 */
	public function getOrdemFuncionalidades()
	{
		return $this->ordemFuncionalidades;
	}
	
	/**
	 * Mщtodo de modificaчуo do Menu Pai dele na funcionalidade
	 * @author Joуo Batista Padilha e Silva
	 * @param integer $prec
	 */
	public function setPrecedenteFuncionalidades($prec = null)
	{
		$this->precedenteFuncionalidades = $prec;
	}
	
	/**
	 * Mщtodo de retorno do Menu pai da funcionalidade
	 * @author Joуo Batista Padilha e Silva
	 * @return integer
	 */
	public function getPrecedenteFuncionalidades()
	{
		return $this->precedenteFuncionalidades;
	}
}
?>