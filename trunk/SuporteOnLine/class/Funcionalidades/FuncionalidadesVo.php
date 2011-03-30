<?php
//####################################
// * Jo�o Batista Padilha e Silva Analista/Desenvolvedor (�baco Tecnologia)
// * Arquivo: FuncionalidadesVo.php
// * Cria��o: Jo�o Batista Padilha e Silva
// * Revis�o: Rafael Henrique Vieira de Moura
// * Data de cria��o: 30/06/2008
//####################################
/**
 * Classe Value Objet. Serve para transportar os atributos dos usu�rios entre as camadas.
 * @author Jo�o Batista Padilha e Silva
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
	 * M�todo de modifica��o da identifica��o de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $id
	 */
	public function setIdFuncionalidades($id = null)
	{
		$this->idFuncionalidades = $id;
	}
	
	/**
	 * M�todo de retorno da Identifica��o de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getIdFuncionalidades()
	{
		return $this->idFuncionalidades;
	}
	
	/**
	 * M�todo de modifica��o do nome de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $nome
	 */
	public function setNomeFuncionalidades($nome = '')
	{
		$this->nomeFuncionalidades = $nome;
	}
	
	/**
	 * M�todo de retorno do nome de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getNomeFuncionalidades()
	{
		return $this->nomeFuncionalidades;
	}
	
	/**
	 * M�todo de modifica��o de Link de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param var $link
	 */
	public function setLinkFuncionalidades($link = '')
	{
		$this->linkFuncionalidades = $link;
	}
	
	/**
	 * M�todo de retorno de Link de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @return var
	 */
	public function getLinkFuncionalidades()
	{
		return $this->linkFuncionalidades;
	}
	
	/**
	 * M�todo de modifica��o de Dominio Tipo de Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $domn
	 */
	public function setDomnTipoFuncionalidades($domn = null)
	{
		$this->DomnTipoFuncionalidades = $domn;
	}
	
	/**
	 * M�todo de retorno do Dominio tipo Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getDomnTipoFuncionalidades()
	{
		return $this->DomnTipoFuncionalidades;
	}
	
	/**
	 * M�todo de modifica��o da ordem da Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $ordem
	 */
	public function setOrdemFuncionalidades($ordem = null)
	{
		$this->ordemFuncionalidades = $ordem;
	}
	
	/**
	 * M�todo de retorno da ordem da Funcionalidades
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getOrdemFuncionalidades()
	{
		return $this->ordemFuncionalidades;
	}
	
	/**
	 * M�todo de modifica��o do Menu Pai dele na funcionalidade
	 * @author Jo�o Batista Padilha e Silva
	 * @param integer $prec
	 */
	public function setPrecedenteFuncionalidades($prec = null)
	{
		$this->precedenteFuncionalidades = $prec;
	}
	
	/**
	 * M�todo de retorno do Menu pai da funcionalidade
	 * @author Jo�o Batista Padilha e Silva
	 * @return integer
	 */
	public function getPrecedenteFuncionalidades()
	{
		return $this->precedenteFuncionalidades;
	}
}
?>